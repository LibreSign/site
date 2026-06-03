import jigsaw from '@tighten/jigsaw-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        jigsaw({
            input: [
                'source/_assets/scss/ud-styles.scss',
                'source/_assets/js/main.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                loadPaths: ['node_modules'],
                silenceDeprecations: ['import', 'global-builtin', 'legacy-js-api'],
            },
        },
    },
});
