const mix = require('laravel-mix');
let Path = require('path');

let tailwind = require('tailwindcss');


require('laravel-mix-tailwind');

// mix.webpackConfig({
// 	output: {
// 		publicPath: '/',
// 		chunkFilename: 'js/[name].[chunkhash].js',
// 	},
// });

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/landing.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/themes/cafe/style.scss', 'public/css/cafe.css')
   .sass('resources/themes/bakery/style.scss', 'public/css/bakery.css')
   .tailwind();

Mix.listen('configReady', function (config) {
    [
        {
            resourcePath: 'resources/themes/cafe/style.scss',
            tailwindPath: 'resources/themes/cafe/tailwind.js'
        },
        {
            resourcePath: 'resources/themes/bakery/style.scss',
            tailwindPath: 'resources/themes/bakery/tailwind.js'
        },
    ].forEach(addition => {

        let postCss = config.module
            .rules.filter(rule => rule.test === Path.resolve(__dirname, addition.resourcePath))[0]
            .use.filter(block => block.loader === 'postcss-loader')[0];

        postCss.options.plugins = [tailwind(addition.tailwindPath)].concat(postCss.options.plugins || []);
    });
});

