const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    // prettier-ignore
    './resources/**/*.blade.php',
    './resources/**/*.js'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      white: colors.white,
      orange: colors.orange,
      blue: colors.blue,
      green: colors.green,
      red: colors.red,
      gray: colors.blueGray,
      indigo: {
        100: '#e6e8ff',
        300: '#b2b7ff',
        400: '#7886d7',
        500: '#6574cd',
        600: '#5661b3',
        800: '#2f365f',
        900: '#191e38',
      },
    },
    extend: {
      borderColor: theme => ({
        DEFAULT: theme('colors.gray.200', 'currentColor'),
      }),
      fontFamily: {
        sans: ['Gilroy', ...defaultTheme.fontFamily.sans],
      },
      boxShadow: theme => ({
        outline: '0 0 0 2px ' + theme('colors.indigo.500'),
        default: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
        solid: '0 0 0 2px currentColor',
        light: '0 2px 4px 0 rgba(0, 0, 0, 0.08)',
        xs: '0 0 0 1px rgba(0, 0, 0, 0.05)'
      }),
      fill: theme => theme('colors'),
    },
  },
  variants: {
    extend: {
      fill: ['focus', 'group-hover'],
    },
  },
  corePlugins: {
    gradientColorStops: false,
    placeholderColor  : false,
    verticalAlign     : false,
    float: false,
    clear: false,
    placeholderOpacity: false,
    gap: false,
    columnGap: false,
    rowGap: false,
    gridColumn: false,
    gridColumnEnd: false,
    gridColumnStart: false,
    gridRow: false,
    gridRowEnd: false,
    gridRowStart: false,
    gridTemplateColumns: false,
    gridTemplateRows: false,
    gridAutoFlow: false,
    gridAutoRows: false,
    gridAutoColumns: false,
    gridRowSpan: false,
    gridColumnSpan: false,
    sepia: false,
    backdropFilter: false,
    backdropBrightness: false,
    backdropContrast: false,
    backdropGrayscale: false,
    backdropHueRotate: false,
    backdropInvert: false,
    backdropOpacity: false,
    backdropSaturate: false,
    backdropSepia: false,
    saturate: false,
    grayscale: false,
    invert: false,
    hueRotate: false,
    contrast: false,
    brightness: false,
    blur: false,
    backgroundBlendMode: false
  },
  plugins: [],
}
