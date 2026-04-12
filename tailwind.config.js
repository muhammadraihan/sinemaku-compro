module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
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
