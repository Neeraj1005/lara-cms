const mix = require('laravel-mix');

mix.js('resources/js/cms_bootstrap.js', 'public/laracms/js')
   .sass('resources/sass/cms_app.scss', 'public/laracms/css');