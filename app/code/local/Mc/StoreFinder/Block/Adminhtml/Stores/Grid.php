<?php
class Mc_Storefinder_Block_Adminhtml_Stores_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setDefaultSort("id");
        $this->setDefaultDir("ASC");
    }

    public function getRowUrl($row) {
        return $this->getUrl("*/*/edit", array(
            "id" => $row->getId()
        ));
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('storefinder/stores')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $this->addColumn("id", array(
            "header"    => Mage::helper("storefinder")->__("Store Id"),
            "type"      => "number",
            "index"     => "id",
        ));

        $this->addColumn("street", array(
            "header"    => Mage::helper("storefinder")->__("Street"),
            "index"     => "street",
        ));

        $this->addColumn("city", array(
            "header"    => Mage::helper("storefinder")->__("City"),
            "index"     => "city",
        ));
        
        $this->addColumn("county", array(
            "header"    => Mage::helper("storefinder")->__("County"),
            "index"     => "county",
        ));

        $this->addColumn("postcode", array(
            "header"    => Mage::helper("storefinder")->__("Postcode"),
            "index"     => "postcode",
        ));

        $this->addColumn("active", array(
            "header"    => Mage::helper("storefinder")->__("Active"),
            "index"     => "active",
            'renderer'  => 'Mc_Storefinder_Block_Adminhtml_Widgets_Active',
            'type'      => 'options',
            'options'   => array(
                '-' => 'No',
                '1' => 'Yes'
            ),
            'filter_condition_callback' => array($this, '_activeFilter'),
        ));

        // exports
        $this->addExportType('*/*/exportCsv', Mage::helper("storefinder")->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper("storefinder")->__('Excel XML'));

        return parent::_prepareColumns();
    }

    protected function _activeFilter($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }

        if($value == '-') {
            $this->getCollection()->getSelect()->where("active IS NULL");
        } elseif($value == '1') {
            $this->getCollection()->getSelect()->where("active = '1'");
        }
        return $this;
    }

}