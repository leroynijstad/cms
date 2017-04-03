const { mix } = require('laravel-mix');

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

mix.sass('resources/assets/sass/album.scss', 'public/css/frontend');
mix.sass('resources/assets/sass/carousel.scss', 'public/css/frontend');
mix.sass('resources/assets/sass/navbar.scss', 'public/css/frontend');
mix.sass('resources/assets/sass/backend.scss', '/css/backend/algemeen.css');
mix.sass('resources/assets/sass/frontend.scss', '/css/frontend/algemeen.css');
mix.browserSync('project.dev');
