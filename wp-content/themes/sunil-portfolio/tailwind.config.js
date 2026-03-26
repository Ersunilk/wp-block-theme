/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.html',
    './parts/**/*.html',
    './patterns/**/*.php',
    './blocks/**/*.js',
    './*.php',
  ],
  theme: {
    extend: {
      colors: {
        brandStart: '#F6A86E',
        brandEnd:   '#F86CA7',
      },
      fontFamily: {
        sans:  ['Inter', 'sans-serif'],
        serif: ['Playfair Display', 'serif'],
      },
    },
  },
  plugins: [],
}