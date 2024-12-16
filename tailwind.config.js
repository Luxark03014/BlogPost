/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./views/**/*.php",  // Si usas PHP
    "./public/**/*.html",  // Si usas HTML
    "./src/**/*.js"  // Si usas JS
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
