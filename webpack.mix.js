const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw()
    .js('source/_assets/js/main.js', 'js')
    .css('source/_assets/css/main.css', 'css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .sass('source/_assets/scss/ud-styles.scss', 'css')
    .sass('source/_assets/css/main.scss', 'css')
    .copy('node_modules/lineicons/web-font/fonts', 'source/assets/build/css/fonts')
    .options({
        processCssUrls: false,
    })
    .browserSync({
        server: 'build_local',
        files: ['build_*/**'],
    })
    .version();
