$('#changeCity').change(function () {
    let val = $(this).val(),
        base = $(this).data('base'),
        url = '',
        origin = $(this).data('origin');
    if (window.location.protocol == 'http:') {
        base = base.replace('http://', '');
    } else {
        base = base.replace('https://', '');
    }
    if (!val) {
        url = window.location.protocol + '//' + base + window.location.pathname;
        window.location.href = window.location.protocol + '//' + base + window.location.pathname;
        return;
    }
    if (origin) {
        url = window.location.protocol + '//' + window.location.host.replace(origin, val) + window.location.pathname;
    } else {
        url = window.location.protocol + '//' + val + '.' + window.location.host + window.location.pathname;
    }
    window.location.href = url;
});