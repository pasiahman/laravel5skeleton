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
//     .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'resources/bower/bootstrap/dist/css/bootstrap.min.css',
    'resources/bower/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    'resources/bower/bootstrap-social/bootstrap-social.css',
    'resources/bower/fancybox/dist/jquery.fancybox.min.css',
    'resources/bower/font-awesome/css/font-awesome.min.css',
    'resources/bower/select2/dist/css/select2.min.css',
    'resources/bower/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
    'resources/bower/toastr/toastr.min.css',

    'resources/bower/admin-lte/dist/css/AdminLTE.min.css',
    'resources/bower/admin-lte/dist/css/skins/_all-skins.min.css',
    'resources/vendor/admin-lte/AdminLTE-custom.css',
], 'public/css/backend-app.css')
.copy('resources/bower/font-awesome/fonts', 'public/fonts');

mix.combine([
    'resources/bower/jquery/dist/jquery.min.js',
    'resources/bower/bootstrap/dist/js/bootstrap.min.js',
    'resources/bower/admin-lte/dist/js/adminlte.min.js',

    'resources/bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'resources/bower/fancybox/dist/jquery.fancybox.min.js',
    'resources/bower/fastclick/lib/fastclick.js',
    'resources/bower/jquery-pjax/jquery.pjax.js',
    'resources/bower/select2/dist/js/select2.min.js',
    'resources/bower/Sortable/Sortable.min.js',
    'resources/bower/toastr/toastr.min.js',
    'resources/vendor/bootstrap-datepicker/bootstrap-datepicker-custom.js',
    'resources/vendor/jquery-pjax/jquery.pjax-custom.js',
    'resources/vendor/laracasts/flash/custom.js',
    'resources/vendor/select2/select2-custom.js',
    'resources/assets/js/core.js',
], 'public/js/backend-app.js');

mix.styles([
    'resources/bower/bootstrap/dist/css/bootstrap.min.css',
    'resources/bower/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    'resources/bower/bootstrap-social/bootstrap-social.css',
    'resources/bower/font-awesome/css/font-awesome.min.css',
    'resources/bower/select2/dist/css/select2.min.css',
    'resources/bower/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
], 'public/css/app.css')
// .copy('resources/bower/fine-uploader', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/edit.gif', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/fine-uploader-gallery.min.css', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/fine-uploader.min.js', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/loading.gif', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/retry.gif', 'public/bower/fine-uploader')
.copy('resources/bower/font-awesome/fonts', 'public/fonts');

mix.combine([
    'resources/bower/jquery/dist/jquery.min.js',
    'resources/bower/bootstrap/dist/js/bootstrap.min.js',

    'resources/bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    'resources/bower/jquery-pjax/jquery.pjax.js',
    'resources/bower/select2/dist/js/select2.min.js',
    'resources/vendor/bootstrap-datepicker/bootstrap-datepicker-custom.js',
    'resources/vendor/jquery-pjax/jquery.pjax-custom.js',
    'resources/vendor/laracasts/flash/custom.js',
    'resources/vendor/select2/select2-custom.js',
    'resources/assets/js/core.js',
], 'public/js/app.js');
