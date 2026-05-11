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
        sans: ['"Helvetica Neue"', 'Helvetica', 'Arial', 'sans-serif'],
        serif: ['"Instrument Serif Modified"', 'serif'],
        peckham: ['"PeckhamPress"', 'sans-serif'],
      },
      colors: {
        brand: {
          orange: 'var(--color-autumn-leaf)',
          navy: 'var(--color-regal-navy)',
          tintOrange: 'var(--color-tint-orange)',
          tintNavy: 'var(--color-tint-navy)',
          bg: 'var(--color-bg)',
          genreBg: 'var(--color-genre-bg)',
          gradient1: 'var(--gradient-1)',
          gradient2: 'var(--gradient-2)',
          gradient3: 'var(--gradient-3)',
          gradient4: 'var(--gradient-4)',
        }
      }
    },
  },
  plugins: [],
}
