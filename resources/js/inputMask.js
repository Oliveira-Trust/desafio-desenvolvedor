window.$ = window.jQuery = require('jquery');
require('inputmask');

var im = new Inputmask('decimal', {
    'alias': 'numeric',
    'rightAlign': false,
    'digits': 2,
    'digitsOptional': false,
    'allowMinus': false
});

im.mask($("#price"));

