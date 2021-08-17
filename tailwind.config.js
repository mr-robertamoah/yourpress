module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      minHeight: {
        '1/2': '50%',
        'content': 'content'
      },
      maxWidth: {
        '80': '320px',
      },
      height: {
        'content': 'content'
      },
      width: {
        'content': 'content'
      },
      transitionProperty: {
        "width": 'width',
        "alert": 'width, visibility, opacity, left',
      }
    },
  },
  variants: {
    extend: {
      borderWidth: ['focus']
    },
  },
  plugins: [],
}
