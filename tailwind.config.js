import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ocean: {
                    50: '#f0f9fb',
                    100: '#daf1f6',
                    200: '#b8e4ed',
                    300: '#8ad0e0',
                    400: '#54b3cb',
                    500: '#2f97b3',
                    600: '#227a97',
                    700: '#1f627a',
                    800: '#1f5165',
                    900: '#1c4456',
                    950: '#0f2b38',
                },
                sand: {
                    50: '#fdfaf4',
                    100: '#faf2e2',
                    200: '#f3e2bd',
                    300: '#e9cc8e',
                    400: '#ddb164',
                    500: '#cf9a49',
                    600: '#b47f3b',
                    700: '#906432',
                    800: '#75512e',
                    900: '#61432a',
                },
                coral: {
                    400: '#ff8a65',
                    500: '#f9663f',
                    600: '#e14c27',
                },
            },
        },
    },

    plugins: [forms],
};
