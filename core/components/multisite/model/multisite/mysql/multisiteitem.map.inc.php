<?php
$xpdo_meta_map['multiSiteItem']= array (
  'package' => 'multisite',
  'version' => '1.1',
  'table' => 'multisite_items',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'InnoDB',
  ),
  'fields' => 
  array (
    'res_id' => 0,
    'city_key' => '',
    'content_key' => '',
    'key_text' => NULL,
  ),
  'fieldMeta' => 
  array (
    'res_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '100',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'city_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'content_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'key_text' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'Resource' => 
    array (
      'class' => 'modResource',
      'local' => 'res_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
