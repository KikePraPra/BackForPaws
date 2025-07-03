/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'verde-oscuro': '#14532d', // Cambia por tu color real
        'verde-claro': '#bbf7d0',  // Cambia por tu color real
      },
      borderRadius: {
        '4xl': '2rem', // O el valor que necesites
      },
      fontFamily: {
        'main-font': ['Montserrat', 'sans-serif'], // Cambia por tu fuente real
        'fredoka': ['Fredoka', 'sans-serif'],      // Cambia por tu fuente real
      },
      zIndex: {
        '1': '1',
        '0': '0',
      },
      spacing: {
        '4.5': '1.125rem', // Para mt-4.5
      }
    },
  },
  plugins: [],
}