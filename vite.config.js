import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/assets/export-vite',
        rollupOptions: {
            output: {
                entryFileNames: 'js/app.js',
                assetFileNames: 'css/app.css',
                chunkFileNames: 'js/[name].js',
            }
        }
    }
});

/*
** Default setting if you need with npm run dev and @vite(['resources/sass/app.scss', 'resources/js/app.js'])

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
*/
