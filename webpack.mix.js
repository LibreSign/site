const mix = require('laravel-mix');
const fs = require('fs');
require('laravel-mix-jigsaw');

const lineiconsLegacyFontsPath = 'node_modules/lineicons/web-font/fonts';
const lineiconsCurrentFontsGlob = 'node_modules/lineicons/dist/*.{eot,svg,ttf,woff,woff2}';
const lineiconsSource = fs.existsSync(lineiconsLegacyFontsPath)
    ? lineiconsLegacyFontsPath
    : lineiconsCurrentFontsGlob;

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw()
    .js('source/_assets/js/main.js', 'js')
    .css('source/_assets/css/main.css', 'css', [
        require('postcss-import'),
    ])
    .sass('source/_assets/scss/ud-styles.scss', 'css')
    .sass('source/_assets/css/main.scss', 'css')
    .copy(lineiconsSource, 'source/assets/build/css/fonts')
    .options({
        processCssUrls: false,
    })
    .browserSync({
        server: 'build_local',
        files: ['build_*/**'],
    })
    .version();

mix.override((webpackConfig) => {
    // In containerized environments, filesystem events are unreliable.
    // Polling keeps `mix watch` alive instead of exiting after the first build.
    if (process.env.HOST_UID || process.env.DOCKER || process.env.CI) {
        webpackConfig.watchOptions = {
            ...(webpackConfig.watchOptions || {}),
            poll: 1000,
            aggregateTimeout: 300,
            ignored: /node_modules/,
        };
    }

    webpackConfig.plugins = webpackConfig.plugins.filter((plugin) => plugin.constructor.name !== 'WebpackBarPlugin');
});
