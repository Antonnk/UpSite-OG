const mix = require('laravel-mix');
let Path = require('path');

let tailwind = require('tailwindcss');


require('laravel-mix-tailwind');


mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/render.js', 'public/js')
    .js('resources/js/landing.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/themes/cafe/style.scss', 'public/css/cafe.css')
    .sass('resources/themes/barber/style.scss', 'public/css/barber.css')
   .tailwind();

Mix.listen('configReady', function (config) {
    [
        {
            resourcePath: 'resources/themes/cafe/style.scss',
            tailwindPath: 'resources/themes/cafe/tailwind.js'
        },
        {
            resourcePath: 'resources/themes/barber/style.scss',
            tailwindPath: 'resources/themes/barber/tailwind.js'
        },
    ].forEach(addition => {

        let postCss = config.module
            .rules.filter(rule => rule.test === Path.resolve(__dirname, addition.resourcePath))[0]
            .use.filter(block => block.loader === 'postcss-loader')[0];

        postCss.options.plugins = [tailwind(addition.tailwindPath)].concat(postCss.options.plugins || []);
    });
});

