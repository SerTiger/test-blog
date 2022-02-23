const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
// mix for default theme
mix.copyDirectory('themes/default/assets/img', 'public/themes/default/img');
mix.copyDirectory('themes/default/assets/fonts', 'public/themes/default/fonts');
// js
mix.js(['themes/default/assets/js/app.js'], 'public/themes/default/js/app.min.js')
//sass
mix.sass('themes/default/assets/sass/app.scss', 'public/themes/default/css/app.min.css')
// mix for admin theme
mix.copyDirectory('themes/default/assets/img', 'public/themes/default/img');
mix.copyDirectory('themes/default/assets/fonts', 'public/themes/default/fonts');
// js
mix.js(['themes/default/assets/js/app.js'], 'public/themes/default/js/app.min.js')
//sass
mix.sass('themes/default/assets/sass/app.scss', 'public/themes/default/css/app.min.css')
