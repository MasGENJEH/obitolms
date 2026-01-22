import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                "obito-black": "#0A0723",
                "obito-green": "#2F6A62",
                "obito-grey": "#EAECEE",
                "obito-red": "#EF372B",
                "obito-text-grey": "#87898C",
                "obito-light-green": "#E0EAE8",
                "obito-light-red": "#FFE3E1",
                "obito-text-secondary": "#6A6F7C",
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                slide: {
                    "0%": { transform: "translateX(0%)" },
                    "100%": { transform: "translateX(-100%)" },
                },
            }
        },
    },

    plugins: [forms],
};
