<?php

class multiSite
{
    /** @var modX $modx */
    public $modx;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
        $corePath = MODX_CORE_PATH . 'components/multisite/';
        $assetsUrl = MODX_ASSETS_URL . 'components/multisite/';

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',

            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'res_id' => $this->modx->resource->id,
        ], $config);

        $this->modx->addPackage('multisite', $this->config['modelPath']);
        $this->modx->lexicon->load('multisite:default');
    }

}