multiSite.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'multiSite-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>Управление городами</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: 'Города',
                layout: 'anchor',
                items: [{
                    html: 'Добавление и удаление городов',
                    cls: 'panel-desc',
                }, {
                    xtype: 'multiSite-grid-citys',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    multiSite.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(multiSite.panel.Home, MODx.Panel);
Ext.reg('multiSite-panel-home', multiSite.panel.Home);