let multiSite = function (config) {
    config = config || {};
    multiSite.superclass.constructor.call(this, config);
};
Ext.extend(multiSite, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('multiSite', multiSite);

multiSite = new multiSite();