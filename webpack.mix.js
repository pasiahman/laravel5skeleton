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
    'resources/bower/bootstrap/dist/css/bootstrap.min.css', 'Modules/Cms/Resources/vendor/bootstrap/bootstrap-custom.css',
    'resources/bower/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    'resources/bower/bootstrap-social/bootstrap-social.css',
    'resources/bower/fancybox/dist/jquery.fancybox.min.css',
    'resources/bower/font-awesome/css/font-awesome.min.css',
    'resources/bower/kbw-countdown/dist/css/jquery.countdown.css',
    'resources/bower/select2/dist/css/select2.min.css',
    'resources/bower/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
    'resources/bower/toastr/toastr.min.css',

    'resources/bower/admin-lte/dist/css/AdminLTE.min.css',
    'resources/bower/admin-lte/dist/css/skins/_all-skins.min.css',

    'Modules/Cms/Resources/vendor/admin-lte/AdminLTE-custom.css',
    'Modules/Cms/Resources/vendor/nestable/jquery.nestable-custom.css',
    'Modules/Cms/Resources/vendor/tinymce/tinymce-custom.css',
], 'public/css/backend-app.css')
.copy('resources/bower/font-awesome/fonts', 'public/fonts');

mix.combine([
    'resources/bower/jquery/dist/jquery.min.js',

    'resources/bower/admin-lte/dist/js/adminlte.min.js',
    'resources/bower/bootstrap/dist/js/bootstrap.min.js',
    'resources/bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'Modules/Cms/Resources/vendor/bootstrap-datepicker/bootstrap-datepicker-custom.js',
    'resources/bower/fancybox/dist/jquery.fancybox.min.js',
    'resources/bower/fastclick/lib/fastclick.js',
    'resources/bower/jquery-pjax/jquery.pjax.js', 'Modules/Cms/Resources/vendor/jquery-pjax/jquery.pjax-custom.js',
    'resources/bower/kbw-plugin/dist/js/jquery.plugin.min.js',
    'resources/bower/kbw-countdown/dist/js/jquery.countdown.min.js', 'Modules/Cms/Resources/vendor/kbw-countdown/jquery.countdown-custom.js',
    'resources/bower/moment/min/moment-with-locales.min.js',
    'resources/bower/nestable/jquery.nestable.js',
    'resources/bower/select2/dist/js/select2.min.js', 'Modules/Cms/Resources/vendor/select2/select2-custom.js',
    'resources/bower/Sortable/Sortable.min.js', 'Modules/Cms/Resources/vendor/Sortable/Sortable-custom.js',
    'resources/bower/tinymce/tinymce.min.js', 'Modules/Cms/Resources/vendor/tinymce/tinymce-custom.js',
    'resources/bower/toastr/toastr.min.js',
    'resources/bower/vanilla-lazyload/dist/lazyload.min.js', 'Modules/Cms/Resources/vendor/vanilla-lazyload/lazyload-custom.js',

    'Modules/Cms/Resources/assets/js/core.js',
    'Modules/Cms/Resources/vendor/laracasts/flash/custom.js',
], 'public/js/backend-app.js');

mix.styles([
    'resources/bower/bootstrap/dist/css/bootstrap.min.css', 'Modules/Cms/Resources/vendor/bootstrap/bootstrap-custom.css',
    'resources/bower/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    'resources/bower/bootstrap-social/bootstrap-social.css',
    'resources/bower/fancybox/dist/jquery.fancybox.min.css',
    'resources/bower/font-awesome/css/font-awesome.min.css',
    'resources/bower/select2/dist/css/select2.min.css',
    'resources/bower/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
], 'public/css/frontend-app.css')
.copy('resources/bower/bootstrap/fonts', 'public/fonts')
.copy('resources/bower/codemirror', 'public/bower/tinymce/plugins/codemirror/codemirror')
// .copy('resources/bower/fine-uploader', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/edit.gif', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/fine-uploader-gallery.min.css', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/fine-uploader.min.js', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/loading.gif', 'public/bower/fine-uploader')
.copy('resources/bower/fine-uploader/dist/retry.gif', 'public/bower/fine-uploader')
.copy('resources/bower/font-awesome/fonts', 'public/fonts')
.copy('resources/bower/kbw-countdown/dist/js/jquery.countdown-id.js', 'public/bower/kbw-countdown/dist/js')
.copy('resources/bower/tinymce', 'public/bower/tinymce');

mix.combine([
    'resources/bower/jquery/dist/jquery.min.js',

    'resources/bower/bootstrap/dist/js/bootstrap.min.js',
    'resources/bower/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'Modules/Cms/Resources/vendor/bootstrap-datepicker/bootstrap-datepicker-custom.js',
    'resources/bower/fancybox/dist/jquery.fancybox.min.js',
    'resources/bower/jquery-pjax/jquery.pjax.js', 'Modules/Cms/Resources/vendor/jquery-pjax/jquery.pjax-custom.js',
    'resources/bower/select2/dist/js/select2.min.js', 'Modules/Cms/Resources/vendor/select2/select2-custom.js',
    'resources/bower/vanilla-lazyload/dist/lazyload.min.js', 'Modules/Cms/Resources/vendor/vanilla-lazyload/lazyload-custom.js',
    'Modules/Cms/Resources/assets/js/core.js',
    'Modules/Cms/Resources/vendor/laracasts/flash/custom.js',
], 'public/js/frontend-app.js');
