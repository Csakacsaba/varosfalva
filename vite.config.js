import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/js/nav.js',
                'resources/css/fooldal.css',
                'resources/css/footer.css',
                'resources/css/email.css',
                'resources/js/comments.js',
                'resources/css/helytortenet.css',
                'resources/css/kepek.css',
                'resources/js/nav.js',
                'resources/js/admin.js',
                'resources/css/nav.css',
                'resources/css/gallerynav.css',
                'resources/css/contact.css',
                'resources/css/register.css',
                'resources/css/egyhaz.css',
                'resources/css/admin.css',
                'resources/css/user_update.css',
                'resources/css/link-paginate.css',
                'resources/css/news_admin.css',
                'resources/css/news_user.css',

            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
