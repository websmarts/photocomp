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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/entries_form.js', 'public/js')
   .js('resources/assets/js/show_entries.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .version();

mix.copy('resources/assets/images/logo.jpg', 'public/images/logo.jpg');