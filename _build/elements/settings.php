<?php

return [
    'url' => [
        'xtype' => 'textfield',
        'value' => MODX_SITE_URL,
        'area' => 'multisite_main',
    ],
    'depth_url' => [
        'xtype' => 'numberfield',
        'value' => 4,
        'area' => 'multisite_main',
    ],
    'context' => [
        'xtype' => 'textfield',
        'value' => 'web',
        'area' => 'multisite_main',
    ],
    'pattern' => [
        'xtype' => 'textfield',
        'value' => '/\[\w+\]/',
        'area' => 'multisite_main',
    ],
    'replace_empty' => [
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'multisite_main',
    ],
];