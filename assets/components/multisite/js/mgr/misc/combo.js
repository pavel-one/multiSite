multiSite.combo.Search = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        xtype: 'twintrigger',
        ctCls: 'x-field-search',
        allowBlank: true,
        msgTarget: 'under',
        emptyText: _('search'),
        name: 'query',
        triggerAction: 'all',
        clearBtnCls: 'x-field-search-clear',
        searchBtnCls: 'x-field-search-go',
        onTrigger1Click: this._triggerSearch,
        onTrigger2Click: this._triggerClear,
    });
    multiSite.combo.Search.superclass.constructor.call(this, config);
    this.on('render', function () {
        this.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
            this._triggerSearch();
        }, this);
    });
    this.addEvents('clear', 'search');
};
Ext.extend(multiSite.combo.Search, Ext.form.TwinTriggerField, {

    initComponent: function () {
        Ext.form.TwinTriggerField.superclass.initComponent.call(this);
        this.triggerConfig = {
            tag: 'span',
            cls: 'x-field-search-btns',
            cn: [
                {tag: 'div', cls: 'x-form-trigger ' + this.searchBtnCls},
                {tag: 'div', cls: 'x-form-trigger ' + this.clearBtnCls}
            ]
        };
    },

    _triggerSearch: function () {
        this.fireEvent('search', this);
    },

    _triggerClear: function () {
        this.fireEvent('clear', this);
    },

});
Ext.reg('multisite-combo-search', multiSite.combo.Search);
Ext.reg('multisite-field-search', multiSite.combo.Search);


multiSite.combo.CitySelect = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'cat_id',
        fieldLabel: config.label || 'city_key',
        hiddenName: config.hiddenName || 'city_key',
        displayField: config.display || 'city_name',
        valueField: config.value || 'city_key',
        anchor: '99%',
        fields: ['city_key', 'city_name'],
        pageSize: 999999,
        typeAhead: false,
        editable: true,
        allowBlank: true,
        url: multiSite.config['connector_url'],
        baseParams: {
            action: 'mgr/city/getlist',
            combo: true,
        },
        tpl: new Ext.XTemplate('\
            <tpl for=".">\
                <div class="x-combo-list-item">\
                    <span>\
                        <b>{city_name}</b>\
                        <small>({city_key})</small>\
                    </span>\
                </div>\
            </tpl>',
            {compiled: true}
        ),
    });
    multiSite.combo.CitySelect.superclass.constructor.call(this, config);
};
Ext.extend(multiSite.combo.CitySelect, MODx.combo.ComboBox);
Ext.reg('multiSite-combo-CitySelect', multiSite.combo.CitySelect);