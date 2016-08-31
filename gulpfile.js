const elixir = require('laravel-elixir');
const webp = require('gulp-webp');
var Task = Elixir.Task;
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

/*
 | Create a new task that will convert all image file
 */
Elixir.extend('convertImages', function(srcDir) {
    // An array of file type to convert to webp
    let imagesTypes = [
        'jpg',
        'png',
        'gif',
        'jpeg'
    ];
    // A gulp.src path for all the image file
    const srcFiles = srcDir +'/**/*{' + imagesTypes.join(',') + '}';

    new Task('convertImages', function () {
        // Iterate through the image files, convert them and put back in the srcDir
        return gulp
            .src(srcFiles)
            .pipe(webp())
            .pipe(gulp.dest(srcDir));
    })
    // If the watch flag has been passed then watch the source files
    .watch(srcFiles);
});

elixir(function(mix) {
    mix
        .sass([
            '../../../bower_components/sweetalert/dev/sweetalert.scss'
        ], './public/css/plugins.css')
        .sass([
            'app.scss'
        ], './public/css/app.css')
        .copy('resources/images', 'public/images/')

        .webpack([
            '../../../bower_components/sweetalert/dist/sweetalert.min.js'
        ], './public/js/plugins.js')
        .webpack([
            'Config.es6.js',
            'App.es6.js'
        ], './public/js/app.js')
        .convertImages('public/images');

});

// gulp.task('default', () =>
//     gulp.src('src/image.jpg')
//         .pipe(webp())
//         .pipe(gulp.dest('dist'))



