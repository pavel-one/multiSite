<?php
$xpdo_meta_map['multiSiteCity']= array (
  'package' => 'multisite',
  'version' => '1.1',
  'table' => 'multisite_city',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'city_key' => '',
    'city_name' => '',
  ),
  'fieldMeta' => 
  array (
    'city_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'city_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
);
