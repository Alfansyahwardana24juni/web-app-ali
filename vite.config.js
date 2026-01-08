import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // Tambahkan bagian ini:
    server: {
        host: '0.0.0.0', // Memungkinkan akses dari alamat IP lokal
        hmr: {
            host: '192.168.1.71' // Ganti dengan alamat IP laptop/PC Anda
        },
    },
});