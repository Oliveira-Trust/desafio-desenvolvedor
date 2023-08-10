window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('waitme/waitMe.min');
    require('bootstrap');
    require('admin-lte');
    require('magnific-popup');
    require('jquery-mask-plugin');
    require('mark.js/dist/jquery.mark.min');
    require('selectize/dist/js/selectize.min')
    //Pnotify
    require('../../vendor/pnotify/pnotify.custom.js');

    require('./masks/masks')

    require('./helper/helper')

    require('./theme/theme')
    require('./theme_init/theme_init')

    require('./custom/custom')

} catch (e) {
}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
