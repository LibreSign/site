import jigsaw from '@tighten/jigsaw-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    base: '/assets/build/',
    plugins: [
        jigsaw({
            input: [
                'source/_assets/scss/ud-styles.scss',
                'source/_assets/js/main.js',
            ],
            refresh: {
                ignored: [
                    '**/build_**/**',
                    '**/cache/**',
                    '**/source/**/_tmp/**',
                    '**/source/**/_translated_tmp/**',
                    '**/source/**/_stale_generated_translations/**',
                    '**/source/[a-z][a-z]/**',
                    '**/source/[a-z][a-z]-[A-Z][A-Z]/**',
                ],
            },
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
                loadPaths: ['node_modules'],
            },
        },
    },
});
