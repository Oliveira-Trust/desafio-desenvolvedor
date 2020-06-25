// statusHelper
function getEnable(value) {
    return '<h4><span class="badge badge-pill badge-' + getStatusClass(value) + '">' + lang.enable[value] + '</span></h4>';
}

function getStatus(value) {
    return '<h4><span class="badge badge-pill badge-' + getStatusClass(value) + '">' + lang.status[value] + '</span></h4>';
}

function getStatusClass(value) {
    switch (value) {
        case 1:
            return 'success';
            break;
        case 2:
            return 'warning';
            break;
        case 3:
            return 'success';
            break;
        case 4:
            return 'danger';
            break;
        default:
            return 'danger'
    }
}
