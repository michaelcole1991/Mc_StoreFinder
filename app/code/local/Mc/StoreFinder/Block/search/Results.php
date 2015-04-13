<?php   
class Mc_StoreFinder_Block_Search_Results extends Mage_Core_Block_Template {   
	
	public function getStores() {
		return Mage::getModel('storefinder/stores')->searchLocations($this->getRequest()->getParam('search_term'));
	}
}