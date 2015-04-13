<?php
class Mc_StoreFinder_Model_Stores extends Mage_Core_Model_Abstract {

    protected function _construct(){
       $this->_init("storefinder/stores");
    }

    public function searchLocations($search_term) {
    	$stores = $this->getCollection();
		if($search_term) {
			$stores->addFieldToFilter(
   				array('street', 'city', 'county', 'postcode'),
			    array(
			       	array('like' => '%'.$search_term.'%'),
			       	array('like' => '%'.$search_term.'%'),
			       	array('like' => '%'.$search_term.'%'),
			        array('like' => '%'.$search_term.'%')
			    )
			);	
		}
		return $stores;
    }

    public function getPostCodes($search_term) {
    	$stores = $this->searchLocations($search_term);
		$results = array();
		foreach ($stores as $store) {
			$results[] = $store->getPostcode();
		}
		return $results;
    }

}
	 