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

mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css');
mix.js('Modules/Admin/Resources/assets/js/app.js', 'js/admin.js');

mix.sass('resources/sass/admin.scss', 'public/css');
mix.copy('Modules/Admin/Resources/assets/css/customAdmin.css/', 'public/css/customAdmin.css');
mix.copy('Modules/Admin/Resources/assets/css/login.css/', 'public/css/login.css');
mix.copy('Modules/Admin/Resources/assets/css/animate.min.css/', 'public/css/animate.min.css');
mix.copy('public/images', 'Modules/Front/Resources/assets/images');

mix.styles([
    'public/css/admin.css',
    'node_modules/bootstrap-multiselect/dist/css/bootstrap-multiselect.css',
    'node_modules/sweetalert2/dist/sweetalert2.min.css'
], 'public/css/all.css')


mix.autoload({
    jquery: ['$', 'jQuery', 'jquery'],
});

mix.scripts([
    'node_modules/bootstrap-multiselect/dist/js/bootstrap-multiselect.js',
    'node_modules/sweetalert2/dist/sweetalert2.all.min.js'
], 'public/js/all.js');

mix.copy('node_modules/fine-uploader/', 'public/admin/fine-uploader'); //
mix.copy('node_modules/jquery.fancytree/dist/skin-lion/', 'public/admin/css/fancytree/skin-lion/');
mix.copy('node_modules/jquery-ui-dist/', 'public/admin/jquery-ui/');
mix.copy('node_modules/ui-contextmenu/', 'public/admin/ui-contextmenu');
mix.copy('node_modules/jquery-form/dist/jquery.form.min.js', 'public/admin/js/jquery-form/dist/jquery.form.min.js');
//mix.copy( 'node_modules/bootstrap-multiselect/dist', 'public/admin/bootstrap-multiselect');
//mix.copy( 'node_modules/jsquery.fancytree/dist/skin-lion/ui.fancytree.css', 'public/admin/css/fancytree/skin-lion/ui.fancytree.css');

// CMS content editor stuff

mix.copy('node_modules/jquery.cookie/jquery.cookie.js', 'public/admin/js/jquery.cookie.js');
mix.copy('node_modules/jquery.fancytree/dist/modules/jquery.fancytree.dnd.js', 'public/admin/js/jquery.fancytree.dnd.js');
mix.copy('node_modules/jquery.fancytree/dist/jquery.fancytree-all.min.js', 'public/admin/js/jquery.fancytree-all.min.js');
mix.copy('node_modules/jquery.fancytree/dist/jquery.fancytree-all.js', 'public/admin/js/jquery.fancytree-all.js');
mix.copy('node_modules/jquery.fancytree/dist/jquery.fancytree-all-deps.js', 'public/admin/js/jquery.fancytree-all-deps.js');
mix.copy('node_modules/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js.map', 'public/admin/js/jquery.fancytree-all-deps.min.js.map');
mix.copy('node_modules/ui-contextmenu/jquery.ui-contextmenu.js', 'public/admin/js/jquery.ui-contextmenu.js');
//mix.copy( 'node_modules/jquery.fancytree/dist/modules/jquery.fancytree.dnd5.js', 'public/admin/js/jquery.fancytree.dnd5.js');

// END cms stuff

mix.version();