<?php
class Mc_Storefinder_Block_Adminhtml_Widgets_Active extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
 
	public function render(Varien_Object $row) {
		$value =  $row->getData($this->getColumn()->getIndex());
		return $value ? 'Yes' : 'No'; 
	}
 
}
