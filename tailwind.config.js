module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/css/**/*.css',
    './app/Helper/Helper.php',
  ],
  safelist: [
    'visible',
    'invisible',
    'opacity-0',
    'opacity-100',
    'pointer-events-none',
    'pointer-events-auto'
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Kumbh Sans"', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
