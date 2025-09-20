import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets/js/app.js",
                "resources/assets/scss/app.scss",
                "resources/assets/admin/js/app.js",
                "resources/assets/admin/scss/app.scss"
            ],
            refresh: true,
        }),
    ],

    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: [
                    'import',
                    //'mixed-decls',
                    'color-functions',
                    'global-builtin',
                ],
            },
        },
    },
});
