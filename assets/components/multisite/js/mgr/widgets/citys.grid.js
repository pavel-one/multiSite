multiSite.grid.Citys = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'multiSite-grid-citys';
    }
    Ext.applyIf(config, {
        url: multiSite.config.connector_url,
        fields: this.getFields(config),
        columns: this.getColumns(config),
        tbar: this.getTopBar(config),
        sm: new Ext.grid.CheckboxSelectionModel(),
        baseParams: {
            action: 'mgr/city/getlist'
        },
        listeners: {
            rowDblClick: function (grid, rowIndex, e) {
                var row = grid.store.getAt(rowIndex);
                this.updateItem(grid, e, row);
            }
        },
        viewConfig: {
            forceFit: true,
            enableRowBody: true,
            autoFill: true,
            showPreview: true,
            scrollOffset: 0,
            getRowClass: function (rec) {
                return !rec.data.active
                    ? 'multiSite-grid-row-disabled'
                    : '';
            }
        },
        paging: true,
        remoteSort: true,
        autoHeight: true,
    });
    multiSite.grid.Citys.superclass.constructor.call(this, config);

    // Clear selection on grid refresh
    this.store.on('load', function () {
        if (this._getSelectedIds().length) {
            this.getSelectionModel().clearSelections();
        }
    }, this);
};
Ext.extend(multiSite.grid.Citys, MODx.grid.Grid, {
    windows: {},

    getMenu: function (grid, rowIndex) {
        let ids = this._getSelectedIds(),
            row = grid.getStore().getAt(rowIndex),
            menu = multiSite.utils.getMenu(row.data['actions'], this, ids);

        this.addContextMenuItem(menu);
    },

    createItem: function (btn, e) {
        let w = MODx.load({
            xtype: 'multiSite-city-window-create',
            id: Ext.id(),
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        });
        w.reset();
        w.setValues({active: true});
        w.show(e.target);
    },

    updateItem: function (btn, e, row) {
        if (typeof (row) != 'undefined') {
            this.menu.record = row.data;
        } else if (!this.menu.record) {
            return false;
        }
        let id = this.menu.record.id;

        MODx.Ajax.request({
            url: this.config.url,
            params: {
                action: 'mgr/city/get',
                id: id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        let w = MODx.load({
                            xtype: 'multiSite-city-window-update',
                            id: Ext.id(),
                            record: r,
                            listeners: {
                                success: {
                                    fn: function () {
                                        this.refresh();
                                    }, scope: this
                                }
                            }
                        });
                        w.reset();
                        w.setValues(r.object);
                        w.show(e.target);
                    }, scope: this
                }
            }
        });
    },

    removeItem: function () {
        let ids = this._getSelectedIds();
        if (!ids.length) {
            return false;
        }
        MODx.msg.confirm({
            title: ids.length > 1
                ? 'Удалить города?'
                : 'Удалить город?',
            text: ids.length > 1
                ? `Вы уверены что хотите удалить эти города? (${ids.length})`
                : 'Вы уверены что хотите удалить город?',
            url: this.config.url,
            params: {
                action: 'mgr/city/remove',
                ids: Ext.util.JSON.encode(ids),
            },
            listeners: {
                success: {
                    fn: function () {
                        this.refresh();
                    }, scope: this
                }
            }
        });
        return true;
    },

    getFields: function () {
        return ['id', 'city_key', 'city_name', 'actions'];
    },

    getColumns: function () {
        return [{
            header: 'ID',
            dataIndex: 'id',
            sortable: true,
            width: 70
        }, {
            header: 'Ключ города',
            dataIndex: 'city_key',
            sortable: true,
            width: 200,
        }, {
            header: 'Название города',
            dataIndex: 'city_name',
            sortable: false,
            width: 250,
        }, {
            header: 'Действия',
            dataIndex: 'actions',
            renderer: multiSite.utils.renderActions,
            sortable: false,
            width: 100,
            id: 'actions'
        }];
    },

    getTopBar: function () {
        return [{
            text: '<i class="icon icon-plus"></i>&nbsp; Добавить город',
            handler: this.createItem,
            scope: this
        }, '->', {
            xtype: 'multisite-field-search',
            width: 250,
            listeners: {
                search: {
                    fn: function (field) {
                        this._doSearch(field);
                    }, scope: this
                },
                clear: {
                    fn: function (field) {
                        field.setValue('');
                        this._clearSearch();
                    }, scope: this
                },
            }
        }];
    },

    onClick: function (e) {
        let elem = e.getTarget();
        if (elem.nodeName == 'BUTTON') {
            let row = this.getSelectionModel().getSelected();
            if (typeof (row) != 'undefined') {
                let action = elem.getAttribute('action');
                if (action == 'showMenu') {
                    let ri = this.getStore().find('id', row.id);
                    return this._showMenu(this, ri, e);
                } else if (typeof this[action] === 'function') {
                    this.menu.record = row.data;
                    return this[action](this, e);
                }
            }
        }
        return this.processEvent('click', e);
    },

    _getSelectedIds: function () {
        let ids = [],
            selected = this.getSelectionModel().getSelections();

        for (let i in selected) {
            if (!selected.hasOwnProperty(i)) {
                continue;
            }
            ids.push(selected[i]['id']);
        }

        return ids;
    },

    _doSearch: function (tf) {
        this.getStore().baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
    },

    _clearSearch: function () {
        this.getStore().baseParams.query = '';
        this.getBottomToolbar().changePage(1);
    },
});
Ext.reg('multiSite-grid-citys', multiSite.grid.Citys);