multiSite.window.CreateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'multiSite-city-window-create';
    }
    Ext.applyIf(config, {
        title: _('multiSite_item_create'),
        width: 550,
        autoHeight: true,
        url: multiSite.config.connector_url,
        action: 'mgr/city/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    multiSite.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(multiSite.window.CreateItem, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'textfield',
            fieldLabel: 'Ключ города',
            name: 'city_key',
            id: config.id + '-city_key',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textfield',
            fieldLabel: 'Название города',
            name: 'city_name',
            id: config.id + '-city_name',
            anchor: '99%',
            allowBlank: false,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('multiSite-city-window-create', multiSite.window.CreateItem);


multiSite.window.UpdateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'multiSite-city-window-update';
    }
    Ext.applyIf(config, {
        title: 'Изменить город',
        width: 550,
        autoHeight: true,
        url: multiSite.config.connector_url,
        action: 'mgr/city/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    multiSite.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(multiSite.window.UpdateItem, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'textfield',
            fieldLabel: 'Ключ города',
            name: 'city_key',
            id: config.id + '-city_key',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textfield',
            fieldLabel: 'Название города',
            name: 'city_name',
            id: config.id + '-city_name',
            anchor: '99%',
            allowBlank: false,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('multiSite-city-window-update', multiSite.window.UpdateItem);