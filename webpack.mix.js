const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.browserSync({
    proxy: process.env.APP_URL,
    notify: false
});

mix.js('resources/js/app.js', 'public/js').vue({version: 3});

mix.postCss('resources/css/app.css', 'public/css', [
    require("tailwindcss"),
]);

if (mix.inProduction()) {
    mix.version();
}
