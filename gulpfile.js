var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

elixir(function(mix){

    mix.coffee('custom.coffee', 'resources/assets/js/custom.js');

    mix.styles([
        // bootstrap 3.3.5
        'bootstrap.min.css',
        // select2
        'select2.min.css',
        // theme style
        'AdminLTE.min.css',
        // adminlte skin
        'skin-blue-light.min.css',
        // labelauty
        'jquery-labelauty.css',
        // morris
        'morris.min.css'
    ], 'public/css/all.css');

    mix.scripts([
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
        // app.js
        'app.min.js',
        // javascript de la aplicacion
        'custom.js'
    ], 'public/js/all.js');

    mix.version([
        'public/css/all.css',
        'public/js/all.js'
    ]);

    // comentado pero funciona para copiar archivos
    mix.copy('resources/assets/images/input-checked.png', 'public/build/css');
    mix.copy('resources/assets/images/input-unchecked.png', 'public/build/css');
    mix.copy('resources/assets/js/morris.min.js', 'public/build/js');

    mix.browserSync({
        proxy: 'tesis.app',
        open: false
    });
});