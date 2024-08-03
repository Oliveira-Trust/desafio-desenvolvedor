import { fileURLToPath, URL } from 'node:url';

import Vue from '@vitejs/plugin-vue';
import path from 'node:path';
import { visualizer } from 'rollup-plugin-visualizer';
import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import Vuetify, { transformAssetUrls } from 'vite-plugin-vuetify';

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        Vue({
            template: transformAssetUrls,
        }),
        Vuetify({
            styles: {
                configFile: 'src/assets/styles/settings.scss',
            },
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'web.config',
                    dest: '',
                },
                {
                    src: 'config.json',
                    dest: '',
                },
            ],
        }),
        visualizer(),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url)),
        },
    },
    build: {
        outDir: 'src/public',
        manifest: true,
        chunkSizeWarningLimit: 750,
        rollupOptions: {
            input: [path.resolve(__dirname, 'src/main.ts'), path.resolve(__dirname, 'index.html')],
            output: {
                manualChunks(id: string) {
                    if (id.includes('node_modules')) {
                        if (id.includes('@vue') || id.includes('vue-router') || id.includes('vuetify') || id.includes('pinia')) {
                            return 'vendor-vue';
                        }

                        if (id.includes('jspdf') || id.includes('html2canvas')) {
                            return 'vendor-jspdf';
                        }

                        return 'vendor';
                    }
                },
            },
        },
    },
    server: {
        strictPort: true,
        port: 5173,
    },
});
