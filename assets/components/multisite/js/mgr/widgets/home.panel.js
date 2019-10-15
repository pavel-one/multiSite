multiSite.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'multisite-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('multisite') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('multisite_items'),
                layout: 'anchor',
                items: [{
                    html: _('multisite_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'multisite-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    multiSite.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(multiSite.panel.Home, MODx.Panel);
Ext.reg('multisite-panel-home', multiSite.panel.Home);
