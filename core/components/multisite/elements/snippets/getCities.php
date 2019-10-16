<?php
/** @var multiSite $multiSite */
$multiSite = $modx->getService('multiSite', 'multiSite', MODX_CORE_PATH . 'components/multisite/model/', []);
$modx->regClientScript($multiSite->config['jsUrl'] . 'web/default.js');
$modx->regClientCSS($multiSite->config['cssUrl'] . 'web/default.css');

/** @var pdoTools $pdo */
$pdo = $modx->getService('pdoTools');
/** @var pdoFetch $fetch */
$fetch = $modx->getService('pdoFetch');
$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl.multiSite.city');
$fetch->setConfig([
    'class' => 'multiSiteCity',
    'limit' => 0,
    'return' => 'data',
]);
$out = ['cities' => $fetch->run()];

if ($_SESSION['city_key']) {
    $out['current_city'] = $fetch->getArray('multiSiteCity', ['city_key' => $_SESSION['city_key']]);
}

return $pdo->getChunk($tpl, $out);