Ext.override(MODx.panel.Resource, {
    parentGetFields: MODx.panel.Resource.prototype.getFields,
    getFields: function (config) {
        var parentFields = this.parentGetFields.call(this, config);
        if (!config.id) {
            config.id = 'modx-panel-resource';
        }

        if (config.record.id) {
            for (var i = 0; i < parentFields.length; i++) {
                var field = parentFields[i];
                if (field.id == 'modx-resource-tabs') {
                    field.items.push({
                        title: 'Мультисайтовость',
                        layout: 'anchor',
                        items: [{
                            html: 'Для разных городов но одинаковых ключей, поле "ключ" должно быть одинаково',
                            cls: 'panel-desc',
                        }, {
                            xtype: 'multisite-grid-items',
                            cls: 'main-wrapper',
                        }]
                    });
                }
            }
        }
        return parentFields;
    }
});

if (typeof (ResExt) == 'undefined') {
    var ResExt = {combo: {}};
}

ResExt.combo.brand = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'id1'
        , fieldLabel: 'Merk'
        , hiddenName: 'brand'
        , displayField: 'title'
        , valueField: 'id'
        , anchor: '99%'
        , fields: ['id', 'title']
        , pageSize: 20
        , url: '/assets/components/resourceextender/connector.php'
        , editable: true
        , allowBlank: true
        , emptyText: '- Selecteer een type -'
        , baseParams: {
            action: 'mgr/brand/getlist'
            , combo: 1
        }
        , tpl: new Ext.XTemplate(
            '<tpl for=".">\
                <div class="x-combo-list-item">\
                    <strong>{title}</strong> <sup>({id})</sup>\
                </div>\
            </tpl>'
            , {compiled: true}
        )
    });
    ResExt.combo.brand.superclass.constructor.call(this, config);
};
Ext.extend(ResExt.combo.brand, MODx.combo.ComboBox);
Ext.reg('resext-combo-brand', ResExt.combo.brand);