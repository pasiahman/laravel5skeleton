let mix = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
mix.js([
    'resources/assets/js/app.js',
    'resources/bower/bootstrap/dist/js/bootstrap.min.js',
    'resources/bower/jquery-pjax/jquery.pjax.js',
    'resources/vendor/jquery-pjax/jquery.pjax-custom.js',
    'resources/vendor/laracasts/flash/custom.js'
], 'public/js');

// .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'resources/bower/jquery/dist/jquery.min.js',
    'resources/bower/bootstrap/dist/css/bootstrap.min.css',
    'resources/bower/bootstrap-social/bootstrap-social.css',
    'resources/bower/font-awesome/css/font-awesome.min.css',
], 'public/css/app.css')
.copy('resources/bower/font-awesome/fonts', 'public/fonts');
