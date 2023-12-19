/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./views/**/*','public/css/styles.css'],
  theme: {
    extend: {
        fontFamily: {
            'nunito': ['Nunito', 'sans-serif'],
            'rubik': ['Rubik', 'sans-serif'],
            'poppins': ['Poppins', 'sans-serif'],
        },
    },
  },
  plugins: [],
}