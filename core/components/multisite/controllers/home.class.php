<?php

/**
 * The home manager controller for multiSite.
 *
 */
class multiSiteHomeManagerController extends modExtraManagerController
{
    /** @var multiSite $multiSite */
    public $multiSite;


    /**
     *
     */
    public function initialize()
    {
        $this->multiSite = $this->modx->getService('multiSite', 'multiSite', MODX_CORE_PATH . 'components/multisite/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['multisite:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('multisite');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->multiSite->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/multisite.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        multiSite.config = ' . json_encode($this->multiSite->config) . ';
        multiSite.config.connector_url = "' . $this->multiSite->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "multisite-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="multisite-panel-home-div"></div>';

        return '';
    }
}