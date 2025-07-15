/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php", // Memindai semua file Blade di folder views
        "./resources/**/*.js", // Memindai semua file JavaScript
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
