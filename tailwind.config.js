import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import aspectRatio from '@tailwindcss/aspect-ratio';

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
                sans: ['SomarSans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    '50': '#faf5f7',
                    '100': '#f6edf0',
                    '200': '#eedce1',
                    '300': '#e1c0c9',
                    '400': '#ce98a6',
                    '500': '#bc7888',
                    '600': '#a15865',
                    '700': '#8d4953',
                    '800': '#753f47',
                    '900': '#63383e',
                    '950': '#3a1d20',
                },

                'myColor': '#a15865',
                'hoverColor': '#9c6972', // اسم اللون حسب اختيارك
            },
        },
    },

    plugins: [forms, typography, aspectRatio],
};
