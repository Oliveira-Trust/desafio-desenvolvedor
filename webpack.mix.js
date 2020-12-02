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

mix.js('resources/js/app.js', 'public/assets/js')
    .sass('resources/sass/app.scss', 'public/assets/css')
    .sourceMaps();

mix.styles(['resources/css/dashboard.css'], 'public/assets/css/dashboard.css');

mix.js('resources/js/custom.js', 'public/assets/js')
    .sourceMaps();

mix.js('resources/js/customers/product.js', 'public/assets/js/customers')
    .sourceMaps();
