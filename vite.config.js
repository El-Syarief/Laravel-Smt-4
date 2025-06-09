import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/landing-page.css",
                "resources/css/login.css",
                "resources/css/register.css",
                "resources/css/manajemen-stok.css",
                "resources/css/laporan.css",
                "resources/css/dashboard.css",
                "resources/css/profile.css", // Ditambahkan
                "resources/css/history.css", // Ditambahkan
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
