multiSite.window.CreateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'multisite-item-window-create';
    }
    Ext.applyIf(config, {
        title: _('multisite_item_create'),
        width: 550,
        autoHeight: true,
        url: multiSite.config.connector_url,
        action: 'mgr/item/create',
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
            xtype: 'hidden',
            name: 'res_id',
            id: config.id + '-res_id',
        },{
            xtype: 'textfield',
            fieldLabel: 'Ключ города',
            name: 'city_key',
            id: config.id + '-city_key',
            anchor: '99%',
            allowBlank: true,
        }, {
            xtype: 'textfield',
            fieldLabel: 'Ключ в контенте',
            name: 'content_key',
            id: config.id + '-content_key',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: 'Содержимое',
            name: 'key_text',
            id: config.id + '-key_text',
            height: 150,
            anchor: '99%'
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('multisite-item-window-create', multiSite.window.CreateItem);


multiSite.window.UpdateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'multisite-item-window-update';
    }
    Ext.applyIf(config, {
        title: _('multisite_item_update'),
        width: 550,
        autoHeight: true,
        url: multiSite.config.connector_url,
        action: 'mgr/item/update',
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
            xtype: 'hidden',
            name: 'res_id',
            id: config.id + '-res_id',
        }, {
            xtype: 'textfield',
            fieldLabel: 'Ключ города',
            name: 'city_key',
            id: config.id + '-city_key',
            anchor: '99%',
            allowBlank: true,
        }, {
            xtype: 'textfield',
            fieldLabel: 'Ключ в контенте',
            name: 'content_key',
            id: config.id + '-content_key',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: 'Содержимое',
            name: 'key_text',
            id: config.id + '-key_text',
            height: 150,
            anchor: '99%'
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('multisite-item-window-update', multiSite.window.UpdateItem);