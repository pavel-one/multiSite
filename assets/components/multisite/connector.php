<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var multiSite $multiSite */
$multiSite = $modx->getService('multiSite', 'multiSite', MODX_CORE_PATH . 'components/multisite/model/');
$modx->lexicon->load('multisite:default');

// handle request
$corePath = $modx->getOption('multisite_core_path', null, $modx->getOption('core_path') . 'components/multisite/');
$path = $modx->getOption('processorsPath', $multiSite->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);