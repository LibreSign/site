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
    .sass('source/assets/scss/ud-styles.scss', 'css')
    .options({
        processCssUrls: false,
    })
    .version()
    .browserSync({
        server: 'build_local',
        files: ['build_*/**'],
    });
