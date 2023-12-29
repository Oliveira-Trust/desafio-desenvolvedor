import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    build: {
        outDir: 'public/build-coin',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            input: [
                path.resolve(__dirname,'Modules/Coin/resources/assets/sass/app.css'),
                path.resolve(__dirname,'Modules/Coin/resources/assets/js/app.js')
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname,'Modules/Coin/resources/assets/js/app.js'),
            '~': path.resolve(__dirname,'Modules/Coin/resources/assets/sass/app.css'),
            '~bootstrap_css': path.resolve(__dirname,'node_modules/bootstrap/dist/css/bootstrap.css'),
            '~bootstrap_js': path.resolve(__dirname,'node_modules/bootstrap/dist/js/bootstrap.js'),
            '~jquery': path.resolve(__dirname,'Modules/Coin/resources/assets/js/jquery/jquery-3.7.1.min.js'),
            '~jquery_mask': path.resolve(__dirname,'Modules/Coin/resources/assets/js/jquery/jquery.maskMoney.js')
        },
    },
});

export const paths = [
    'Modules/Coin/resources/assets/sass/app.scss',
    'Modules/Coin/resources/assets/js/app.js',
];