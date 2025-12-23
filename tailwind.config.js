/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#3B6FA5',
        'primary-dark': '#2E5A8A',
      },
      transitionProperty: {
        'width': 'width',
      }
    },
  },
  plugins: [],
}