'use strict';

var gulp = require("gulp"),
    autoPrefix = require("gulp-autoprefixer"),
    cssComb = require("gulp-csscomb"),
    image = require("gulp-image"),
    compileSass = require("gulp-sass"),
    rigger = require("gulp-rigger"),
    rimraf = require("rimraf"),
    jsMinify = require("gulp-minify"),
    zip = require("gulp-zip");

var path = {

    src: {
        html: [
            'src/*.html',
            'src/*.php'
        ],
        css: 'src/styles/*.scss',
        php: 'src/scripts/php/*.php',
        img: 'src/images/*.png',
        svg: 'src/SVG/*.svg',
        font: 'src/fonts/*.ttf',
        js: 'src/scripts/js/*.js',
        PHPExcel: [
            'src/scripts/php/PHPExcelLibrary/*',
            'src/scripts/php/PHPExcelLibrary/**/*',
            'src/scripts/php/PHPExcelLibrary/**/**/*',
            'src/scripts/php/PHPExcelLibrary/**/**/**/*',
            'src/scripts/php/PHPExcelLibrary/**/**/**/**/*',
            'src/scripts/php/PHPExcelLibrary/**/**/**/**/**/*',
            'src/scripts/php/PHPExcelLibrary/**/**/**/**/**/**/*'
        ],
        zip: [
            'build/*',
            'build/**/*',
            'build/**/**/*'
        ]
    },

    build: {
        html: 'build/',
        css: 'build/styles/',
        php: 'build/scripts/php/',
        img: 'build/images/',
        svg: 'build/SVG/',
        font: 'build/fonts/',
        js: 'build/scripts/js/',
        PHPExcel: 'build/scripts/php/PHPExcelLibrary/',
        zip: 'zip/'
    },

    watch: {
        pages: [
            'src/*.html',
            'src/modules/*.html',
            'src/modules/*.php',
            'src/*.php',
            'src/fonts/*.ttf',
            'src/admin/*.html',
            'src/admin/*.php'
        ],
        scripts: [
            'src/scripts/php/*.php',
            'src/scripts/js/*.js',
            'src/admin/scripts/php/*.php',
            'src/admin/scripts/js/*.js'
        ],
        styles: [
            'src/styles/*.scss',
            'src/styles/templates/*.scss',
            'src/admin/styles/*.scss',
            'src/admin/styles/templates/*.scss'
        ],
        images: 'src/images/*.png',
        svg: 'src/SVG/*.svg'
    },

    admin: {
        src: {
            html: [
                'src/admin/*.html',
                'src/admin/*.php'
            ],
            css: 'src/admin/styles/*.scss',
            php: 'src/admin/scripts/php/*.php',
            js: 'src/admin/scripts/js/*.js'
        },
        
        build: {
            html: 'build/admin/',
            css: 'build/admin/styles/',
            php: 'build/admin/scripts/php/',
            js: 'build/admin/scripts/js/'
        }
    },

    clean: 'build*'
};

//Збірка html
gulp.task('html:build', function () {
    gulp.src(path.src.html)
        .pipe(rigger())
        .pipe(gulp.dest(path.build.html));
    gulp.src(path.admin.src.html)
        .pipe(rigger())
        .pipe(gulp.dest(path.admin.build.html));
});

//Збірка php
gulp.task('php:build', function () {
    gulp.src(path.src.php)
        .pipe(rigger())
        .pipe(gulp.dest(path.build.php));
    gulp.src(path.admin.src.php)
        .pipe(rigger())
        .pipe(gulp.dest(path.admin.build.php));
});

//Збірка JS
gulp.task('js:build', function () {
    gulp.src(path.src.js)
        .pipe(jsMinify({
            ext: {
                min: '.js'
            },
            noSource: '*.js'
        }))
        .pipe(gulp.dest(path.build.js));
    gulp.src(path.admin.src.js)
        .pipe(jsMinify({
            ext: {
                min: '.js'
            },
            noSource: '*.js'
        }))
        .pipe(gulp.dest(path.admin.build.js));
});

//Збірка СSS
gulp.task('css:build', function () {
    gulp.src(path.src.css)
        .pipe(compileSass().on('error', compileSass.logError))
        .pipe(cssComb())
        .pipe(autoPrefix({
            browsers: ['last 40 versions', '> 90%'],
            remove: false
        }))
        .pipe(gulp.dest(path.build.css));
    gulp.src(path.admin.src.css)
        .pipe(compileSass().on('error', compileSass.logError))
        .pipe(cssComb())
        .pipe(autoPrefix({
            browsers: ['last 40 versions', '> 90%'],
            remove: false
        }))
        .pipe(gulp.dest(path.admin.build.css));
});

//Збірка картинок
gulp.task('img:build', function () {
    gulp.src(path.src.img)
        .pipe(image())
        .pipe(gulp.dest(path.build.img));
});

gulp.task('svg:build', function () {
    gulp.src(path.src.svg)
        .pipe(gulp.dest(path.build.svg));
});

//Збірка шрифтів
gulp.task('fonts:build', function () {
    gulp.src(path.src.font)
        .pipe(gulp.dest(path.build.font));
});

//Збірка сайту в архів для хостингу
gulp.task('zip:build', function () {
    gulp.src(path.src.zip)
        .pipe(zip('build.zip'))
        .pipe(gulp.dest(path.build.zip));
});

//Збірка PHPExcel
gulp.task('PHPExcel:build', function () {
    gulp.src(path.src.PHPExcel)
        .pipe(gulp.dest(path.build.PHPExcel));
});

//Загальна збірка
gulp.task('project:build', [
    'html:build',
    'js:build',
    'css:build',
    'img:build',
    'svg:build',
    'php:build',
    'fonts:build'
]);

gulp.task('watch', function () {
    gulp.watch(path.watch.pages, [
        'html:build',
        'fonts:build'
    ]);
    gulp.watch(path.watch.styles, ['css:build']);
    gulp.watch(path.watch.scripts, [
        'js:build',
        'php:build'
    ]);
    gulp.watch(path.watch.images, ['img:build']);
    gulp.watch(path.watch.svg, ['svg:build']);
});

//Очистка
gulp.task('clean', function (callback) {
    rimraf(path.clean, callback);
});

//Запуск роботи з проектом
gulp.task('default', ['project:build', 'watch']);