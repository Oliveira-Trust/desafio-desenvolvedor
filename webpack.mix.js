const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/delete.js','public/js/deleteJs.js')
    .js('resources/js/user-table.js','public/js/table-user.js')
    .js('resources/js/product-table.js','public/js/table-product.js')
    .js('resources/js/purchase-table.js','public/js/table-purchase.js')
    .js('resources/js/purchase-create.js','public/js/purchase-create.js')
    .js('resources/js/purchase-edit.js','public/js/purchase-edit.js')
    .js('resources/js/purchase-show.js','public/js/purchase-show.js')
    .js('resources/js/user-show.js','public/js/user-show.js')
    .js('resources/js/inputMask.js','public/js/inputMask.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
