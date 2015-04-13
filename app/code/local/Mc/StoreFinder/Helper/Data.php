<?php
class Mc_StoreFinder_Helper_Data extends Mage_Core_Helper_Abstract {
	
	public function getApiKey() {
		return Mage::getStoreConfig('storefinder/general/api_key');
	}

	public function getMapSettings() {
		$lat = Mage::getStoreConfig('storefinder/defaults/latitude');
		$lng = Mage::getStoreConfig('storefinder/defaults/longitude');
		$type = Mage::getStoreConfig('storefinder/defaults/map_type');
		$zoom = Mage::getStoreConfig('storefinder/defaults/map_zoom');
		$zoom_control = Mage::getStoreConfig('storefinder/defaults/zoomControl');
		
		$settings = array(
			'center' => 'new google.maps.LatLng('.$lat.','.$lng.')',
			'mapTypeId' => $type, 
			'zoom' => $zoom,
			'zoomControl' => $zoom_control ? 'true' : 'false',
		);

		$html = '<script type="text/javascript">var MapSettings = {';
		foreach ($settings as $key => $val) {
			$html .= $key.':'.$val.',';
		}
		$html .='zoomControl: true, mapTypeControl: true';
		$html .= '};</script>';
		return $html;
	}

	public function getMapScripts() {
		if($key = $this->getApiKey()) {
			$html = '<script src="https://maps.googleapis.com/maps/api/js?key='.$key.'"></script>';
			$html .= '<script src="'.Mage::getDesign()->getSkinBaseDir().'/storefinder/js/storefinder.js'.'" type="text/javascript"></script>';
			return $html;
		}
	}
}
	 