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
    // Scripts JS
    .scripts([
        'resources/js/bootstrap.js',
        'resources/js/jquery.js',
        'resources/js/jquery.mask.min.js',
        'resources/js/scripts.js',
    ], 'public/assets/js/app.js')

    // Styles Sass and CSS
    .sass('resources/sass/app.scss', 'public/assets/css/app.css')
    .styles('resources/css/styles.css', 'public/assets/css/styles.css')
    .version();
