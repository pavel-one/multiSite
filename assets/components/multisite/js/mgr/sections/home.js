multiSite.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'multisite-panel-home',
            renderTo: 'multisite-panel-home-div'
        }]
    });
    multiSite.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(multiSite.page.Home, MODx.Component);
Ext.reg('multisite-page-home', multiSite.page.Home);