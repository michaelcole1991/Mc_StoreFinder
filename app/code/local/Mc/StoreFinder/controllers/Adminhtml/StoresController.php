<?php
class Mc_StoreFinder_Adminhtml_StoresController extends Mage_Adminhtml_Controller_Action {
   
    protected function _initAction(){
        $this->loadLayout()
        ->_setActiveMenu("storefinder/stores")
        ->_addBreadcrumb(Mage::helper("adminhtml")
        ->__("Storefinder Stores"),Mage::helper("adminhtml")->__("Stores"));
        return $this;
    }

    public function indexAction() {
        $this->_title($this->__("Storefinder"));
        $this->_initAction();
        $this->renderLayout();
    }

    public function newAction() {
        $this->_title($this->__("Add Store"));
        Mage::register("storefinder_data", $model);
        $this->loadLayout();
        $this->_setActiveMenu("storefinder/stores");
        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock("storefinder/adminhtml_stores_edit"));
        $this->renderLayout();
    }


    public function editAction() {
        $this->_title($this->__("Edit Store"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("storefinder/stores")->load($id);

        if ($model->getId()) {
            Mage::register("storefinder_data", $model);
            $this->loadLayout();
            $this->_setActiveMenu("storefinder/stores");
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("storefinder/adminhtml_stores_edit"));
            $this->renderLayout();
        }
        else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("storefinder")->__("Store does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function saveAction(){
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('storefinder/stores');
            if ($id = $this->getRequest()->getParam('id')) { 
                $model->load($id);
            }
            $model->addData($data);
            try{
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess('Store Saved');
                $this->_redirect('*/*/'); 
            }
            catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError('Store Not Saved. Error:'.$e->getMessage());
                Mage::getSingleton('adminhtml/session')->setExampleFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id'        => $mode->getId(),
                    '_current'  => true)
                ); 
            }
        }        
    }

    public function deleteAction() {
        if($id = $this->getRequest()->getParam("id")) {
            try {
                $model = Mage::getModel('storefinder/stores');
                $model->setId($id)->delete();
                Mage::getSingleton("adminhtml/session")
                ->addSuccess(Mage::helper("adminhtml")->__("Store was successfully deleted"));
                $this->_redirect("*/*/");
            }
            catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        $this->_redirect("*/*/");
    }

    public function exportCsvAction() {
        $fileName   = 'stores_export.csv';
        $content    = $this->getLayout()->createBlock('storefinder/adminhtml_stores_grid')
        ->getCsvFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction() {
        $fileName   = 'stores_export.xml';
        $content    = $this->getLayout()->createBlock('storefinder/adminhtml_stores_grid')
        ->getCsvFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

}
