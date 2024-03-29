<?php
/** @var modX $modx */
$eventName = $modx->event->name;
switch ($eventName) {
    case 'OnWebPagePrerender':
        $resource = &$modx->resource->_output;
        /** @var multiSite $multiSite */
        $multiSite = $modx->getService('multiSite', 'multiSite', MODX_CORE_PATH . 'components/multisite/model/', []);

        $output = &$modx->resource->_output;
        $currentCity = $_SESSION['city_key'];
        $tagsArray = [];
        preg_match_all($modx->getOption('multisite_pattern', [], '/\[\w+\]/'), $output, $tagsArray);


        if (count($tagsArray)) {
            foreach ($tagsArray[0] as $tag) {
                $tag = str_replace(['[', ']'], '', $tag);
                /** @var multiSiteItem $find */
                $find = $modx->getObject('multiSiteItem', [
                    'city_key' => $currentCity,
                    'res_id' => $modx->resource->id,
                    'content_key' => $tag
                ]);
                if (!$find) {
                    if ($modx->getOption('multisite_replace_empty', [], true)) {
                        $output = str_replace("[$tag]", '', $output);
                    }
                    continue;
                }
                $output = str_replace("[$tag]", $find->get('key_text'), $output);
            }
        }

        break;
    case 'OnHandleRequest':
        $context = $modx->context->key;
        if ($context != $modx->getOption('multisite_context', [], 'web')) break;

        $request = &$_REQUEST;
        $host = explode('.', $_SERVER['HTTP_HOST']);

        if (count($host) < $modx->getOption('multisite_depth_url', [], 4)) {
            $_SESSION['city_key'] = '';
            break;
        } else {
            $_SESSION['city_key'] = $host[0];
        }
        /** @var multiSite $multiSite */
        $multiSite = $modx->getService('multiSite', 'multiSite', MODX_CORE_PATH . 'components/multisite/model/', []);

        $count = $modx->getCount('multiSiteCity', [
            'city_key' => $_SESSION['city_key']
        ]);

        if (!$count) {
            $_SESSION['city_key'] = '';
            $info = explode('.', $_SERVER['HTTP_HOST']);
            unset($info[0]);
            $link = $_SERVER['REQUEST_SCHEME'] . '://' . join('.', $info) . '/' . $_SERVER['REQUEST_URI'];
            $modx->sendRedirect($link);
        }

        break;
    case 'OnDocFormPrerender':
        /** @var multiSite $multiSite */
        $multiSite = $modx->getService('multiSite', 'multiSite', MODX_CORE_PATH . 'components/multisite/model/', []);

        $modx->controller->addLastJavascript(MODX_ASSETS_URL . 'components/multisite/js/mgr/multisite.js');
        $modx->controller->addLastJavascript(MODX_ASSETS_URL . 'components/multisite/js/mgr/misc/combo.js');
        $modx->controller->addLastJavascript(MODX_ASSETS_URL . 'components/multisite/js/mgr/misc/utils.js');
        $modx->controller->addLastJavascript(MODX_ASSETS_URL . 'components/multisite/js/mgr/widgets/items.grid.js');
        $modx->controller->addLastJavascript(MODX_ASSETS_URL . 'components/multisite/js/mgr/widgets/items.windows.js');
        $modx->controller->addCss(MODX_ASSETS_URL . 'components/multisite/css/mgr/main.css');
        $modx->controller->addHtml('<script type="text/javascript">
        let multiSite = function (config) {
            config = config || {};
            multiSite.superclass.constructor.call(this, config);
        };
        Ext.extend(multiSite, Ext.Component, {
            page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
        });
        Ext.reg(\'multiSite\', multiSite);
        
        multiSite = new multiSite();
        
        multiSite.config = ' . json_encode($multiSite->config) . ';
        multiSite.config.connector_url = "' . $multiSite->config['connectorUrl'] . '";
        </script>');
        break;
}