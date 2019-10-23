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

mix.styles(
    [
        'resources/assets/css/bst-admin.css',
        'resources/assets/css/bootstrap-select.css',
        'resources/assets/css/custom.css',
    ],
    'public/css/all.css'
).scripts(
    [
        'resources/assets/js/jquery-3.4.1.min.js',
        'resources/assets/js/bootstrap.bundle.js',
        'resources/assets/js/bst-admin.js',
        'resources/assets/js/bootstrap-select.js',
        'resources/assets/js/axios.min.js',
    ],
    'public/js/all.js'
);


// mix.sass(
//     [
//         'resources/assets/sass/public-home.scss',
//     ],
//     'public/css/public-home.css'
// );
// // ).scripts(
// //     [
// //         'resources/assets/js/public-home.js',
// //     ],
// //     'public/js/public-home.js'
// // );

mix.browserSync('http://inv.v');
