const mix = require('laravel-mix');
const tailwindCss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
  .alias({'@': 'resources/js'})
  .sass('resources/css/app.scss', 'public/css').options({
  postCss: [tailwindCss('./tailwind.config.js')]
});

mix.browserSync('interview-calendar.test');

if (mix.inProduction()) {
  mix.version().sourceMaps();
}
