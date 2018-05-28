const elixir = require('laravel-elixir');

elixir((mix) => {
    mix.sass(['app.scss', 'blog.scss']);  

    mix.scripts([
    	'node_modules/jquery/dist/jquery.js',
    	'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
    	'resources/assets/js/app.js'
    ], 'public/js/all.js', './');

    mix.browserSync({
    	proxy: 'practica-laravel-basico.test/'
    });

    // mix.styles([
    // 	'a.css',
    // 	'b.css',
    // 	'c.css'
    // ], 'public/css/d.css', 'public/css');     
});
