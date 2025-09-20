import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets/js/app.js",
                "resources/assets/css/app.scss",
                "resources/assets/admin/js/app.js",
                "resources/assets/admin/scss/app.scss"
            ],
            refresh: true,
        }),
    ],
});
