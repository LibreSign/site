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

mix.jigsaw({
    watch: {
        // Watch only stable source files and stable underscore-prefixed directories.
        // Avoid broad `source/_*/` because Jigsaw/listeners may create/remove transient
        // underscore directories during build (e.g. _redirect, _team), which can cause
        // watch → build → write/remove → watch loops.
        files: [
            'config.php',
            'bootstrap.php',
            'listeners/**/*.php',
            'source/*.md',
            'source/*.php',
            'source/*.html',
        ],
        dirs: ['source/_layouts/', 'source/_partials/', 'source/_posts/'],
        notDirs: ['source/_assets/', 'source/assets/', 'source/_redirect/', 'source/_team/'],
    },
})
    .js('source/_assets/js/main.js', 'js')
    .css('source/_assets/css/main.css', 'css', [
        require('postcss-import'),
    ])
    .sass('source/_assets/scss/ud-styles.scss', 'css')
    .sass('source/_assets/css/main.scss', 'css')
    .copy(lineiconsSource, 'source/assets/build/css')
    .options({
        processCssUrls: false,
    })
    .browserSync({
        server: 'build_local',
        files: ['build_*/**'],
    })
    .version();

mix.override((webpackConfig) => {
    // Always ignore dependency dirs and Jigsaw-generated transient dirs.
    // `_translated_tmp` lives under `source/_posts/` and is created/removed during build.
    // `_redirect` and `_team` may also be generated/removed by listeners.
    // Use path-segment boundaries so we match directory names (not arbitrary substrings).
    const alwaysIgnored = /(^|[\\/])(node_modules|_translated_tmp|_redirect|_team)([\\/]|$)/;

    if (process.env.HOST_UID || process.env.DOCKER || process.env.CI) {
        // In containerized environments, filesystem events are unreliable.
        // Polling keeps `mix watch` alive instead of exiting after the first build.
        webpackConfig.watchOptions = {
            ...(webpackConfig.watchOptions || {}),
            poll: 1000,
            aggregateTimeout: 300,
            ignored: alwaysIgnored,
        };
    } else {
        webpackConfig.watchOptions = {
            ...(webpackConfig.watchOptions || {}),
            ignored: alwaysIgnored,
        };
    }

    webpackConfig.plugins = webpackConfig.plugins.filter((plugin) => plugin.constructor.name !== 'WebpackBarPlugin');
});
