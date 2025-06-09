import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/landing-page.css",
                "resources/css/manajemen-stok.css",
                "reources/css/transaksi.css",
                "resources/css/laporan.css",

                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
