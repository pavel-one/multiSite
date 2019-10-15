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
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/city/multisite.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/widgets/citys.grid.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/widgets/citys.windows.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/city/widgets/home.panel.js');
        $this->addJavascript($this->multiSite->config['jsUrl'] . 'mgr/city/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        multiSite.config = ' . json_encode($this->multiSite->config) . ';
        multiSite.config.connector_url = "' . $this->multiSite->config['connectorUrl'] . '";
        Ext.onReady(function() {
            MODx.load({ 
                xtype: "multiSite-page-home"
            });
        });
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="multiSite-panel-home-div"></div>';

        return '';
    }
}