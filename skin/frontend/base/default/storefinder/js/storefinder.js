var geocoder;
var map;
var markers = [];

initialize();

function initialize() {

    geocoder = new google.maps.Geocoder();
    // from settings in admin
    var myOptions = MapSettings;
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
}

// run a search
function searchStores(elem) {
    // clear markers for next search
    deleteMarkers();
    markers = [];
    var form = $('map-search');
    var url = form.action;
    var search_term = $(form['search_term']).getValue();
    if(search_term.length > 0) {
        new Ajax.Request(url, {
            method: 'post',
            parameters: {
                search_term: search_term
            },
            onSuccess: function(rsp) {
                try {
                    var data = rsp.responseText.evalJSON();
                    $("map-results").update(data.html);
                    updatePostcodes(data.postcodes);
                } catch(err){
                    //console.log(err);
                }
            }
        });
    }
}

// loop to add all new markers
function updatePostcodes(postcodes) {
    postcodes.each(function(postcode) {
        addMarker(postcode);
    });
}

// add in markers via postcode
function addMarker(postcode) {
    geocoder.geocode( { 'address': postcode}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                name: postcode,
                animation: google.maps.Animation.DROP,
                clickable: true
            });
            // push into markers array
            markers.push(marker);

            // setting content for a info bubble, address from google
            marker.info = new google.maps.InfoWindow({
                content: '<em>'+results[0].formatted_address+'</em>'
            });

            // adding a click event to show that bubble
            google.maps.event.addListener(marker, 'click', function() {
                // close all other windows before opening new one
                closeInfoWindows();
                marker.info.open(map, marker);
            }); 

            map.setZoom(10);       

        } else {
            //console.log("Geocode was not successful for the following reason: " + status);
        }
    });
}

// Scroll to the marker from results by postcocde
function scrollToMarker(postcode, id) {
    closeInfoWindows();
    geocoder.geocode( { 'address': postcode}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.panTo(results[0].geometry.location);
            // open the clicked info window
            google.maps.event.trigger(markers[(id-1)], 'click');
        } else {
            //console.log("Geocode was not successful for the following reason: " + status);
        }
    });
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
}

// close all InfoWindows
function closeInfoWindows(){
    for (var i = 0; i < markers.length; i++) {
        markers[i].info.close();
    }
}     

