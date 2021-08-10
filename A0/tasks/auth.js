const mix = require('laravel-mix');

mix
    .setPublicPath('./public/resources/auth/')
    .setResourceRoot('/resources/auth/')
    .js('resources/auth_assets/js/app.js', 'public/resources/auth/js')
    .sass('resources/auth_assets/sass/app.scss', 'public/resources/auth/css')
    .webpackConfig({
        output: {
            publicPath: '/resources/auth/',
            chunkFilename: 'js/chunks/[name]-[chunkhash].js',
        },
    });
