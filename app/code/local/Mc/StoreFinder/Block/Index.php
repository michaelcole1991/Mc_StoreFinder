<?php   
class Mc_StoreFinder_Block_Index extends Mage_Core_Block_Template {   

	public function pageTitle() {
		return 'Store Finder';
	}

	public function getMapSrc() {
		if($key = Mage::helper('storefinder')->getApiKey()) {
			$html = '<script src="https://maps.googleapis.com/maps/api/js?key='.$key.'"></script>';
			$html .= Mage::helper('storefinder')->getMapSettings();
			$html .= '<script src="'.$this->getSkinUrl('storefinder/js/storefinder.js').'" type="text/javascript"></script>';
			return $html;
		}
	}
}