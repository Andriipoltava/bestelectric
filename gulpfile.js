"use strict";

/* plugins */
const axeA11y = require('gulp-axe-webdriver');
const browsersync = require('browser-sync').create();
const cheerio = require('gulp-cheerio');
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const del = require('del');
const fileinclude = require('gulp-file-include');
const gulp = require('gulp');
const gulpFilter = require('gulp-filter');
const gulpIf = require('gulp-if');
const imagemin = require('gulp-imagemin');
const newer = require('gulp-newer');
const order = require("gulp-order");
const plumber = require('gulp-plumber');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const svgSymbols = require('gulp-svg-symbols');
const sourcemaps = require('gulp-sourcemaps');
const terser = require('gulp-terser');
const zip = require('gulp-zip');


/* paths */

const paths = {
    src: 'src/',
    dist: 'assets/'
};


const assets = {
    js: paths.src + 'js',
    jsWidget: paths.src + 'js/widget/',
    css: paths.src + 'css',
    scss: paths.src + 'scss',
    components: paths.src + 'scss/components',
    img: paths.src + 'img',
    sprites: paths.src + 'sprites',
    fonts: paths.src + 'fonts',
    inc: paths.src + 'inc',
    html: paths.src + 'html',
    css_img_path: '../img'
};

const distAssets = {
    js: paths.dist + 'js',
    css: paths.dist + 'css',
    cssWidget: paths.dist + 'css/widgets',
    jsWidget: paths.dist + 'js/widgets',
    img: paths.dist + 'img',
    sprites: paths.dist + 'sprites',
    fonts: paths.dist + 'fonts'
};

/*
 * Tasks
 * 1/ sass
 * 2/ scripts
 * 3/ images
 * 4/ sprites
 * 5/ extend
 * 6/ fonts
 * 7/ delivery
 * 8/ acessibility check
 * 9/ browsersync
 * 10/ watch
 * 
 */

/* remove print css from concatenation + Concatenate & Minify CSS */
function css() {
    // const filterPrint = gulpFilter(['**', '!' + assets.scss + '/print.scss'], { 'restore': true });
    const cssWidget = (file) => {
        return gulp.src([assets.scss + '/9-E-Widgets/' + file + '.scss',])
            .pipe(plumber())
            // .pipe(filterPrint)
            .pipe(sass().on('error', sass.logError))
            .pipe(sourcemaps.init())
            .pipe(concat(file + '.css'))
            // .pipe(gulp.dest(assets.css))
            .pipe(gulp.dest(distAssets.cssWidget))
            .pipe(cleanCSS())
            .pipe(rename({suffix: '.min'}))
            .pipe(sourcemaps.write('./'))
            // .pipe(gulp.dest(assets.css))
            .pipe(gulp.dest(distAssets.cssWidget))
            .pipe(browsersync.stream());
    }

    const bootstrap = gulp.src([assets.scss + '/bootstrap.scss'])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('bootstrap.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(browsersync.stream());


    const style = gulp.src([assets.scss + '/style.scss'])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('style.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(browsersync.stream());

    const woocommerceLayout = gulp.src([assets.scss + '/8-Plugins/woocommerce-layout.scss'])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('woocommerce-layout.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(browsersync.stream());

    const woocommerceGeneral = gulp.src([assets.scss + '/8-Plugins/woocommerce-general.scss'])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('woocommerce-general.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(browsersync.stream());

    const woocommerceProduct = gulp.src([assets.scss + '/8-Plugins/woocommerce-product.scss',
        assets.scss + '/8-Plugins/woocommerce/product/*.scss'])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('woocommerce-product.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(browsersync.stream());

    const calculator = gulp.src([assets.scss + '/calculator.scss',
        assets.scss + '/8-Plugins/calculator/*.scss'])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('calculator.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.css))
        .pipe(browsersync.stream());

    const calcBanner = gulp.src([assets.scss + '/9-E-Widgets/calc-banner.scss',])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('calc-banner.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.cssWidget))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.cssWidget))
        .pipe(browsersync.stream());
    const sliderKsp = gulp.src([assets.scss + '/9-E-Widgets/slider-ksp.scss',])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('slider-ksp.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.cssWidget))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.cssWidget))
        .pipe(browsersync.stream());

    const singleFrom = gulp.src([assets.scss + '/9-E-Widgets/woo-single-form.scss',])
        .pipe(plumber())
        // .pipe(filterPrint)
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(concat('woo-single-form.css'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.cssWidget))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('./'))
        // .pipe(gulp.dest(assets.css))
        .pipe(gulp.dest(distAssets.cssWidget))
        .pipe(browsersync.stream());

    const searchForm = cssWidget('search-form');
    const compareRange = cssWidget('woo-compare-range');
    const wooFeaturesColumns = cssWidget('woo-features-columns');

    const wooBasket = cssWidget('woo-basket');
    const megaMenu = cssWidget('mega-menu');
    const singleGalley = cssWidget('woo-single-gallery');
    const wooSummary = cssWidget('woo-summary')
    const wooFeaturesLists = cssWidget('woo-features-lists');

    const wooVideo = cssWidget('woo-video')
    const wooMore = cssWidget('woo-single-more')
    const wooTech = cssWidget('woo-single-tech-tabs')
    const wooCompare = cssWidget('woo-compare')
    const wooHeader = cssWidget('woo-product-header')


    //return all, print;
    return style,
        calcBanner,
        sliderKsp,
        wooHeader,
        singleFrom,
        singleGalley,
        wooSummary,
        wooVideo,
        wooMore,
        wooTech,
        wooCompare,
        searchForm,
        wooFeaturesLists,
        wooFeaturesColumns,
        wooBasket,
        megaMenu,
        compareRange,
        bootstrap,
        woocommerceGeneral,
        woocommerceLayout,
        woocommerceProduct,
        calculator;
};

/* Concatenate & Minify JS */
function scripts() {

    const jsWatcherWidget = (name) => {
        return gulp.src([
            assets.jsWidget  + name + '.js'
        ])
            .pipe(plumber())
            .pipe(sourcemaps.init())
            .pipe(concat(name + '.js'))
            .pipe(gulp.dest(distAssets.jsWidget))
            .pipe(rename({suffix: '.min'}))
            .pipe(terser({
                ecma: 5,
                safari10: true,
                keep_fnames: false,
                mangle: false,
                compress: {
                    defaults: false
                }
            }))
            .pipe(sourcemaps.write('/'))
            // .pipe(gulp.dest(assets.js))
            .pipe(gulp.dest(distAssets.jsWidget))
            .pipe(browsersync.stream());

    }
    const globalScripts = gulp.src([
        assets.js + '/global/*.js'
    ])
        //manage order
        .pipe(order([
            'old.js',
            'global.js',
        ]))
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(concat('globalScripts.js'))
        // .pipe(gulp.dest(assets.js))
        .pipe(gulp.dest(distAssets.js))
        .pipe(rename({suffix: '.min'}))
        .pipe(terser({
            ecma: 5,
            safari10: true,
            keep_fnames: false,
            mangle: false,
            compress: {
                defaults: false
            }
        }))
        .pipe(sourcemaps.write('/'))
        // .pipe(gulp.dest(assets.js))
        .pipe(gulp.dest(distAssets.js))
        .pipe(browsersync.stream());
    const productScripts = gulp.src([
        assets.js + '/product/*.js'
    ])
        //manage order
        .pipe(order([
            'wvs-mods.js',

            'single-product.js',
            'tech-specs-accordion.js',
            'product-tabs.js',
        ]))
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(concat('productScripts.js'))
        // .pipe(gulp.dest(assets.js))
        .pipe(gulp.dest(distAssets.js))
        .pipe(rename({suffix: '.min'}))
        .pipe(terser({
            ecma: 5,
            safari10: true,
            keep_fnames: false,
            mangle: false,
            compress: {
                defaults: false
            }
        }))
        .pipe(sourcemaps.write('/'))
        // .pipe(gulp.dest(assets.js))
        .pipe(gulp.dest(distAssets.js))
        .pipe(browsersync.stream());
    const calculatorScripts = gulp.src([
        assets.js + '/calculator/*.js'
    ])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(concat('calculatorScripts.js'))
        // .pipe(gulp.dest(assets.js))
        .pipe(gulp.dest(distAssets.js))
        .pipe(rename({suffix: '.min'}))
        .pipe(terser({
            ecma: 5,
            safari10: true,
            keep_fnames: false,
            mangle: false,
            compress: {
                defaults: false
            }
        }))
        .pipe(sourcemaps.write('/'))
        // .pipe(gulp.dest(assets.js))
        .pipe(gulp.dest(distAssets.js))
        .pipe(browsersync.stream());
    const calcComp = jsWatcherWidget('calc-compare')
    const megaMenu = jsWatcherWidget('mega-menu')
    const wooCompRang = jsWatcherWidget('product-compare-range')
    const wooFeatures = jsWatcherWidget('product-features')
    const wooFeaturesList = jsWatcherWidget('product-features-list')
    const wooGallery = jsWatcherWidget('product-gallery')
    const wooForm = jsWatcherWidget('product-single-form')
    const wooTechTabs = jsWatcherWidget('product-tech-tabs')
    const searchForm = jsWatcherWidget('search-form')
    const hereSlider= jsWatcherWidget('slider3image')
    const kspSlider= jsWatcherWidget('slider-icon-list')
    const wooBasket= jsWatcherWidget('woo-basket')
    const wooHeader = jsWatcherWidget('product-header')

    return globalScripts,wooHeader, productScripts, calculatorScripts, calcComp,megaMenu,wooFeaturesList,wooCompRang,wooFeatures,wooGallery,wooBasket,kspSlider,hereSlider,searchForm,wooTechTabs,wooForm;
};


/* Optimize images */
function images() {

    return gulp.src([assets.img + '/**/*'])

        .pipe(newer(assets.img + '/**/*')) //parse only new or updated files
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.jpegtran({progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: false},
                    {cleanupIDs: false}
                ]
            })
        ]))

        .pipe(gulp.dest(distAssets.img));
};

/* sprites management 
 * generate svg file for inline use
 */

function sprites() {

    return gulp.src([assets.sprites + '/**/*.svg'])
        .pipe(plumber())
        .pipe(cheerio({
            run: function ($) {
                $('[fill]').removeAttr('fill');
            },
            parserOptions: {xmlMode: true}
        }))
        .pipe(svgSymbols({
                svgAttrs: {
                    class: `hidden`
                }
            }
        ))
        .pipe(gulpIf(/[.]svg$/, gulp.dest(assets.img + '/global')))
        .pipe(gulpIf(/[.]svg$/, gulp.dest(distAssets.img + '/global')))
        .pipe(gulpIf(/[.]css$/, gulp.dest(assets.components)));
};

/* rename generated css file for sprites */
function renameSprites() {
    return gulp.src([assets.components + '/*.css'])
        .pipe(plumber())
        .pipe(rename({
            basename: '_sprites',
            extname: '.scss'
        }))
        .pipe(gulp.dest(assets.components))
};

/* clean css generated file for sprites */
function cleanSprites() {
    return del([assets.components + '/*.css'], {force: true});
}

/* include html patterns in main files */
function includeHTML() {
    return gulp.src([assets.html + '/*.html'])
        .pipe(plumber())
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .pipe(gulp.dest(paths.dist))
        .pipe(browsersync.stream());
};

/* include fonts in dist */
function fonts() {
    return gulp.src([assets.fonts + '/**/*'])
        .pipe(plumber())
        .pipe(gulp.dest(distAssets.fonts));
};


/* Create an archive with the current date containing all files needed
 * we exlude unecessary files for the customer like scss and sprite source
 */
function zipDelivery() {
    var date = new Date().toLocaleDateString().replace(/[^0-9]/g, '');
    return gulp.src(['*.html',
        assets.css + '/**',
        assets.img + '/**',
        assets.js + '/**'], {base: "."})
        .pipe(plumber())
        .pipe(zip('delivery-' + date + '.zip'))
        .pipe(gulp.dest(paths.dist));
};


/* accessibility task */
function axeCheck(done) {
    var options = {
        saveOutputIn: 'a11yResult.json',
        browser: 'phantomjs',
        urls: ['*.html']
    };
    return axeA11y(options, done);
};

// BrowserSync
function browserSync(done) {
    browsersync.init({
        proxy: "bestelectricradiators.local"
    });
    done();
}

/* watch */
function watchFiles() {
    gulp.watch(assets.scss + '/**/*.scss', css);
    gulp.watch(assets.js + '/**/*.js', scripts);
    gulp.watch(assets.img + '/**/*', images);
    gulp.watch(assets.sprites + '/**', gulp.series(sprites, renameSprites, cleanSprites));
    gulp.watch([assets.html + '/*.html', assets.inc + '/**/*.html'], includeHTML);
}


/* chained tasks */
const spritesBuild = gulp.series(sprites, renameSprites, cleanSprites);
const build = gulp.parallel(css, scripts, images, fonts, spritesBuild);
const watch = gulp.parallel(watchFiles);

// export tasks
exports.images = images;
exports.css = css;
exports.scripts = scripts;
exports.spritesBuild = spritesBuild;

exports.build = build;
exports.delivery = zipDelivery;
exports.a11y = axeCheck;
exports.default = watch;