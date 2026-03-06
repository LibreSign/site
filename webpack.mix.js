const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/compiled');

mix.jigsaw({
    watch: ['source/**/*.md', 'source/**/*.php', 'source/**/*.scss', '!source/**/_tmp/**']
})
    .js('source/_assets/js/main.js', 'js')
    .sass('source/_assets/scss/ud-styles.scss', 'css')
    .options({
        processCssUrls: false,
    })
    .webpackConfig({
        watchOptions: {
            ignored: /(_tmp|node_modules)/
        }
    })
    .browserSync({
        server: 'build_local',
        files: ['build_local/**'],
        ignore: ['**/_tmp/**', '**/node_modules/**'],
        watchOptions: {
            ignoreInitial: true,
            ignored: ['**/_tmp/**', '**/node_modules/**']
        }
    })
    .version();