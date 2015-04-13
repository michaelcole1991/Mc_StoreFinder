<?php
class Mc_Storefinder_Block_Adminhtml_Stores_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
    
    protected function _prepareForm() {

        $form = new Varien_Data_Form(array(
            "id"        => "edit_form",
            "action"    => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
            "method"    => "post",
            "enctype"   => "multipart/form-data",
        ));

        $this->setForm($form);

        $fieldset = $form->addFieldset("storefinder_form", array(
            "legend" => Mage::helper("storefinder")->__("Store information")
        ));

        $fieldset->addField("street", "text", array(
            "label"     => Mage::helper("storefinder")->__("Street"),
            "name"      => "street",
            'required'  => true,
        ));

        $fieldset->addField("city", "text", array(
            "label"     => Mage::helper("storefinder")->__("City"),
            "name"      => "city",
            'required'  => true,
        ));

        $fieldset->addField("county", "text", array(
            "label"     => Mage::helper("storefinder")->__("County"),
            "name"      => "county",
            'required'  => true,
        ));

        $fieldset->addField("postcode", "text", array(
            "label"     => Mage::helper("storefinder")->__("Postcode"),
            "name"      => "postcode",
            'required'  => true,
        ));

        $fieldset->addField("telephone", "text", array(
            "label"     => Mage::helper("storefinder")->__("Telephone"),
            "name"      => "telephone",
            'required'  => true,
        ));

        $fieldset->addField("description", "editor", array(
            "label"     => Mage::helper("storefinder")->__("Description"),
            "name"      => "description",
            'style'     => 'height:300px;width:100%;',
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            'wysiwyg'   => true,
            'required'  => true,
            'after_element_html' => '<small style="font-style:italic;">Used for description of store, opening times e.t.c.</small>',
        ));

        $fieldset->addField("active", "select", array(
            "label"     => Mage::helper("storefinder")->__("Active"),
            "name"      => "active",
            'value'     => '1',
            'values'    => array(
                array('value' => '-1', 'label' => 'Please Select...'),
                array('value' => '', 'label' => 'No'),
                array('value' => '1', 'label' => 'Yes'),
            ),
            'required'  => true,
        ));

        if(Mage::registry("storefinder_data")) {
            $form->setValues(Mage::registry("storefinder_data")->getData());
        }

        $form->setUseContainer(true);
        return parent::_prepareForm();
    }
}
