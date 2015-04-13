<?php
$installer = $this;
$installer->startSetup();
$sql= "
create table storefinder_stores (
	id int not null auto_increment,
	street varchar(200),
	city varchar(200),
	county varchar(100),
	postcode varchar(100), 
	telephone varchar(100),
	description text,
	active int(11) DEFAULT NULL,
	primary key(id)
);";

$installer->run($sql);

$installer->endSetup();
	 