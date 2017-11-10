var elixir = require('laravel-elixir');
var bowerDir = './resources/assets/vendor/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // mix.sass('app.scss');
    mix.copy('./resources/assets/images', 'public/assets/images');
    mix.copy(bowerDir + 'bootstrap/fonts', 'public/assets/fonts');
    mix.less('vendor.less', 'public/assets/css/vendor.css');
    mix.less('admin.less', 'public/assets/css/admin.css');
    mix.less('frontend.less', 'public/assets/css/frontend.css');
    mix.less('style.less', 'public/assets/css/style.css');
    /* scripts */
    mix.scripts([
        bowerDir + 'jquery/dist/jquery.min.js',
        bowerDir + 'bootstrap/dist/js/bootstrap.min.js',
        bowerDir + 'angular/angular.min.js',
        bowerDir + 'angular-bootstrap/ui-bootstrap.min.js',
        bowerDir + 'angular-bootstrap/ui-bootstrap-tpls.min.js',
        bowerDir + 'angular-loading-bar/build/loading-bar.min.js',
        bowerDir + 'ng-file-upload/ng-file-upload.min.js',
        bowerDir + 'ng-file-upload/ng-file-upload.min.js',
        bowerDir + 'angular-lazy-img/release/angular-lazy-img.min.js',
    ], 'public/assets/js/vendor.js');

    /* scripts */
    mix.scripts([
        bowerDir + 'angular/angular.min.js',
        bowerDir + 'angular-bootstrap/ui-bootstrap.min.js',
        bowerDir + 'angular-loading-bar/build/loading-bar.min.js',
        bowerDir + 'angular-bootstrap/ui-bootstrap-tpls.min.js',
        bowerDir + 'angular-loading-bar/build/loading-bar.min.js',
        bowerDir + 'angular-lazy-img/release/angular-lazy-img.min.js',
        bowerDir + 'ngInfiniteScroll/build/ng-infinite-scroll.min.js',
        bowerDir + 'lightbox2/src/js/lightbox.js'
    ], 'public/assets/js/vendor-frontend.js');

    mix.scripts([
        bowerDir + 'AdminLTE/dist/js/app.min.js',
        bowerDir + 'textAngular/dist/textAngular-rangy.min.js',
        bowerDir + 'textAngular/dist/textAngular-sanitize.min.js',
        bowerDir + 'textAngular/dist/textAngular.min.js',
        bowerDir + 'ng-tags-input/ng-tags-input.min.js',
        bowerDir + 'angular-ui-select/dist/select.min.js',
        bowerDir + 'angular-ckeditor/angular-ckeditor.min.js',
    ], 'public/assets/js/admin.js');

    mix.scripts([
        'angular/backend/app.js',
    ], 'public/assets/js/backend/app.js');

    mix.scripts([
        'angular/frontend/app.js',
    ], 'public/assets/js/frontend/app.js');

    // mix.scripts(
    //         'angular/frontend/app.js', 'public/assets/js/frontend/app.js'
    //     );
});