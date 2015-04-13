<?php
class Mc_Storefinder_Model_System_Maptypes {
	
	public function toOptionArray() {
		return array(
			array(
				'value' => 'google.maps.MapTypeId.ROADMAP', 
				'label' => 'Roadmap'
			),
			array(
				'value' => 'google.maps.MapTypeId.SATELLITE',
				'label' => 'Satellite'
			),
			array(
				'value' => 'google.maps.MapTypeId.HYBRID',
				'label' => 'Hybrid'
			),
			array(
				'value' => 'google.maps.MapTypeId.TERRAIN',
				'label' =>	'Terrain'
			),
		);
	}
}