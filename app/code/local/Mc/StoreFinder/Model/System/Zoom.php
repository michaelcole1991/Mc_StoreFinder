<?php
class Mc_Storefinder_Model_System_Zoom {
	
	public function toOptionArray() {
		$opts = array();
		for ($i = 1; $i < 21; $i++) { 
			$opts[] = array('value' => $i, 'label' => $i);
		}
		return $opts;
	}
}