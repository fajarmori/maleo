import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        // './storage/framework/views/*.php',
        // './resources/views/**/*.blade.php',
        './src/**/*.{html,js}',
        './components/**/*.{html,js}',
        './pages/**/*.{html,js}',
        "./contents/**/*.{html,js}",
        "./modules/**/*.{html,js}",
        './resources/**/*.{html,js)',
        './resources/**/*.blade.php',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
