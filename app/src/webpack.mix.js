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

mix
    .sass('resources/sass/app.scss', 'css/app.css')
    .sass('resources/sass/pages/_auth.scss', 'css/pages/auth.css')
    .sass('resources/sass/pages/_home.scss', 'css/pages/home.css')
    .sass('resources/sass/pages/_history.scss', 'css/pages/history.css')

    .js('resources/js/app.js', 'js/app.js')
    .js('resources/js/pages/home.js', 'js/pages/home.js')
    .js('resources/js/pages/history.js', 'js/pages/history.js')

    .version()
