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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles('resources/css/mystyle.css', 'public/css/mystyle.css')
   .scripts('resources/js/filmliste.js', 'public/js/filmliste.js')
   .scripts('resources/js/watchlist.js', 'public/js/watchlist.js')
   .scripts('resources/js/diary.js', 'public/js/diary.js');

