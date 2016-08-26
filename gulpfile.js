var elixir = require('laravel-elixir');
// require('laravel-elixir-copy-fonts');

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
    mix
        .sass([
            '../../../bower_components/sweetalert/dev/sweetalert.scss'
        ], 'public/css/plugins.css')
        .scripts([
            '../../../bower_components/sweetalert/dist/sweetalert.min.js'
        ], 'public/js/plugins.js')
        .babel([
            'Config.es6.js',
            'App.es6.js'
        ], 'public/js/app.js')
        .sass('app.scss')
        .copy('./resources/images', './public/images/');
});


