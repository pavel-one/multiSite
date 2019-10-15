multiSite.page.Home = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        components: [{
            xtype: 'multiSite-panel-home',
            renderTo: 'multiSite-panel-home-div'
        }]
    });
    multiSite.page.Home.superclass.constructor.call(this, config);
    console.log(this);
};
Ext.extend(multiSite.page.Home, MODx.Component);
Ext.reg('multiSite-page-home', multiSite.page.Home);