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
        'content': 'full-content'
      },
      maxWidth: {
        '1/4': '25%',
        '80': '320px',
      },
      height: {
        '9/12': '75%',
        'content': 'full-content'
      },
      width: {
        'content': 'full-content'
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
