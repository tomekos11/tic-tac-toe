import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tsconfigPaths from 'vite-tsconfig-paths'

export default defineConfig({
    plugins: [
        laravel({
            input: [
              'resources/css/app.css',
              'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
        tsconfigPaths()
    ],
    resolve:{
      alias:{
        '@': '/resources',
      }
    }
});
