import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue', // Incluye archivos de Vue.js si los usas
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Puedes añadir colores personalizados aquí si quieres mantener una paleta de colores uniforme
                'custom-blue': '#1D4ED8', // Ejemplo de un color azul personalizado
                'custom-gray': '#374151',
            },
            spacing: {
                // Agrega espaciados personalizados si necesitas valores específicos
                '128': '32rem',
                '144': '36rem',
            },
            boxShadow: {
                // Personaliza sombras para un efecto más profesional
                'custom': '0 4px 14px 0 rgba(0, 118, 255, 0.39)',
            }
        },
    },

    plugins: [
        forms, // Este plugin mejora los estilos de los formularios
    ],
};
