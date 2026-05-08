import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        allowedHosts: [
          'd2a5-186-231-48-157.ngrok-free.app', // Add your ngrok URL here
          'localhost', // Optionally add localhost or other trusted hosts
        ],
      },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),

    ],
});
