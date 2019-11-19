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

mix.sass(
    'resources/assets/sass/front/_home.scss','public/css'
).scripts(
    [
        'resources/assets/js/jquery-3.4.1.min.js',
        'resources/assets/js/axios.min.js',
        'resources/assets/js/home.js'
    ],
    'public/js/home.js'
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
