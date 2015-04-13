<?php

class MC_Storefinder_Block_Adminhtml_Stores extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct() {
        $this->_controller = "adminhtml_stores";
        $this->_blockGroup = "storefinder";
        $this->_headerText = Mage::helper("storefinder")->__("Stores");
        parent::__construct();
	
	}

}