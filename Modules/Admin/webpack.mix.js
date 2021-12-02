const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/admin.js') ;
    //.sass('../../resources/sass/admin.scss', 'public/css');
    //.sass( '/resources/assets/sass/admin.scss', 'css/admin.css');

if (mix.inProduction()) {
    mix.version();
}
