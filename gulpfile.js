var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix
        .copy('node_modules/font-awesome/fonts', 'public/build/fonts/font-awesome')
        .copy('resources/assets/images/input-checked.png', 'public/build/css')
        .copy('resources/assets/images/input-unchecked.png', 'public/build/css')
        .copy('resources/assets/js/morris.min.js', 'public/build/js')

        .coffee('custom.coffee', 'resources/assets/js/custom.js')

        .less([ // Process back-end stylesheets
            'AdminLTE.less',
            'plugin/toastr/toastr.less',
            'skins/skin-blue-light.less'
        ], 'resources/assets/css/adminlte.css')
        .styles([
            // bootstrap 3.3.5
            'bootstrap.min.css',
            // select2
            'select2.min.css',
            // theme style
            'adminlte.css',
            // labelauty
            'jquery-labelauty.css',
            // daterange
            'daterange.css',
            // morris
            'morris.min.css'
        ], 'public/css/all.css')

        .scripts([
            // jquery 2.1.4
            'jQuery-2.1.4.min.js',
            // raphael
            'raphael.min.js',
            // bootstrap js
            'bootstrap.min.js',
            // slimscroll
            'jquery.slimscroll.min.js',
            // fastclick
            'fastclick.min.js',
            // selec2
            'select2.full.min.js',
            // labelauty
            'jquery-labelauty.js',
            // moment
            'moment.js',
            // daterangepicker
            'daterangepicker.js',
            // inputmask
            'jquery.inputmask.bundle.min.js',
            // app.js
            'app.min.js',
            // javascript de la aplicacion
            'custom.js'
        ], 'public/js/all.js')

        .version(['public/css/all.css', 'public/js/all.js']);

    mix.browserSync({
        proxy: 'tesis.app',
        open: false
    });
});
