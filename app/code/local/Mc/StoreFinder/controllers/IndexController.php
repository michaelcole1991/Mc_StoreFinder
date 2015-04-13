<?php
class Mc_StoreFinder_IndexController extends Mage_Core_Controller_Front_Action {
    
    public function IndexAction() {
      
        $this->loadLayout();   
        $this->getLayout()
        ->getBlock("head")
        ->setTitle($this->__("Store Finder"));

        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
        $breadcrumbs->addCrumb("home", array(
            "label" => $this->__("Home Page"),
            "title" => $this->__("Home Page"),
            "link"  => Mage::getBaseUrl()
        ));

        $breadcrumbs->addCrumb("store finder", array(
            "label" => $this->__("Store Finder"),
            "title" => $this->__("Store Finder")
        ));

        $this->renderLayout();   
    }


    public function viewAction() {
        $store_id = $this->getRequest()->getParam('store');
        if($store = Mage::getModel('storefinder/stores')->load($store_id)) {

            $this->loadLayout();   
            $this->getLayout()
            ->getBlock("head")
            ->setTitle($this->__("Store - ".$store->getStreet()));

            $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
            $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
            ));

            $breadcrumbs->addCrumb("store finder", array(
                "label" => $this->__("Store Finder"),
                "title" => $this->__("Store Finder"),
                "link"  => Mage::getBaseUrl().'storefinder'
            ));

            $breadcrumbs->addCrumb("store", array(
                "label" => $this->__($store->getStreet()),
                "title" => $this->__($store->getStreet())
            ));

            $this->renderLayout(); 
        }
    }
}