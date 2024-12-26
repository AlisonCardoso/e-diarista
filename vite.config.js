import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    server: {
        hmr: {
            host: 'cardoso',
        },
        host: 'cardoso',
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
