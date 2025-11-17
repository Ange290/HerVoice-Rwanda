const defaultTheme = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
export default {
 content: [
    "./index.html",
    "./src//*.{html,js}",
    "./src/sections/**/*.{html,js}",
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