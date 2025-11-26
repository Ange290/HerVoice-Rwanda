const defaultTheme = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
export default {
 content: [
    "./index.php",
    "./src//*.{html,js,php}",
    "./src/sections/**/*.{html,js,php}",
  ],
  theme: {
    extend: {
      fontFamily: {
        outfit: ['"Outfit"', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [],
}