<?php
class Mc_StoreFinder_SearchController extends Mage_Core_Controller_Front_Action {

    public function IndexAction() {
		$resp['params'] = $this->getRequest()->getParams();
		$resp['postcodes'] = Mage::getModel('storefinder/stores')->getPostCodes($this->getRequest()->getParam('search_term'));
		$resp['html'] = $this->getLayout()->createBlock('storefinder/search_results')->setTemplate('storefinder/search/results.phtml')->toHtml();
		$this->getResponse()->setBody(Zend_Json::encode($resp));
		return;
    }
}