<?php
class Mc_Storefinder_Block_Adminhtml_Stores_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();
        $this->_objectId = "id";
        $this->_blockGroup = "storefinder";
        $this->_controller = "adminhtml_stores";

        $this->_updateButton('save', 'label', Mage::helper('storefinder')->__('Save Store'));
        $this->_updateButton('delete', 'label', Mage::helper('storefinder')->__('Delete Store'));

        $this->_addButton('save_and_continue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                 editForm.submit($('edit_form').action+'back/edit/');
            }
        ";

    }

    public function getHeaderText() {
        if(Mage::registry("storefinder_data") && Mage::registry("storefinder_data")->getId()){
            return Mage::helper("storefinder")->__("Edit Store '%s'", $this->htmlEscape(Mage::registry("storefinder_data")->getPostcode()));
        } else {
            return Mage::helper("storefinder")->__("Add Item");
        }
    }

    protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
}