const mix = require('laravel-mix');

mix.js('resources/js/cms.js', 'public/laracms/js')
   .sass('css/cms.css', 'public/laracms/css');