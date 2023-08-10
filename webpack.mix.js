const mix = require('laravel-mix');

mix.js('resources/js/_admin/app.js', 'public/_admin/js');
mix.sass('resources/sass/_admin/app.scss', 'public/_admin/css');

if (mix.inProduction()) {
    mix.version();
}
