// ---- Обьявляем модули ---- //
var path = require('path');
const gulp = require('gulp'),
      sass = require('gulp-sass'),
      browserSync = require('browser-sync'),
      concat = require('gulp-concat'),
      uglify = require('gulp-uglify'),
      cssnano = require('gulp-cssnano'),
      cleanCSS = require('gulp-clean-css'),
      rename = require('gulp-rename'),
      del = require('del'),
      imagemin = require('gulp-imagemin'),
      autoprefixer = require('gulp-autoprefixer'),
      rsync = require('gulp-rsync'),
      babel = require('gulp-babel'),
      notify = require('gulp-notify'),
      cache = require('gulp-cache'),
      eslint = require('gulp-eslint'),
      minifyJS = require('gulp-minify'),
      sourcemaps = require('gulp-sourcemaps');

const params = {
  proxy: 'wp-gulp-start-template', // Если работа ведется с использованием сервера и php
  projectName: 'wp-gulp-template'
}

// ---- esLint ---- //
/*
 * прверяем правильность написаия кода, его стиля и граммотности
 */
gulp.task('esLint', () => {
    return gulp.src(['partials/components/**/*.js', 'partials/common/js/my-libs/**/*.js'])
    // eslint() attaches the lint output to the "eslint" property
    // of the file object so it can be used by other modules.
        .pipe(eslint())
        // eslint.format() outputs the lint results to the console.
        // Alternatively use eslint.formatEach() (see Docs).
        .pipe(eslint.format())
        // To have the process exit with an error code (1) on
        // lint error, return the stream and pipe to failAfterError last.
        .pipe(eslint.failAfterError())
})

// ---- BrowserSync ---- //

gulp.task('browser-sync-php', function () {
    browserSync.init({
        proxy: params.proxy,
        notify: false
    })
})

// ---- Js ---- //

/*
 * Обрабатывем стороние библиотеки
 */

gulp.task('js-libs', function () {
    return gulp.src([
        'partials/js/libs/*.js'
    ])
        .pipe(concat('libs.js'))
        .pipe(gulp.dest('partials/common/js/'))
})

/*
 * Обрабатываем собственные библиотеки
 */

gulp.task('js-myLibs-dev', function () {
    return gulp.src([
        'partials/js/my-libs/*.js'
    ])
			  .pipe(sourcemaps.init())
        .pipe(concat('my-libs.js'))
			  .pipe(sourcemaps.write())
        .pipe(gulp.dest('partials/common/js/'))
})

gulp.task('js-myLibs', function () {
    return gulp.src([
        'partials/js/my-libs/*.js'
    ])
        .pipe(concat('my-libs.js'))
        .pipe(gulp.dest('partials/common/js/'))
})

/*
 * Обрабатываем Js в компонентах
 */

gulp.task('js-components-dev', function () {
    return gulp.src([
        'partials/components/**/*.js'
    ])
        .pipe(sourcemaps.init())
        .pipe(concat('components.js'))
			  .pipe(sourcemaps.write())
        .pipe(gulp.dest('partials/common/js/'))
})

gulp.task('js-components', function () {
    return gulp.src([
        'partials/components/**/*.js'
    ])
        .pipe(concat('components.js'))
        .pipe(gulp.dest('partials/common/js/'))
})

/*
 * Обрабатываем весь Js
 */

gulp.task('dev-js', ['js-libs', 'js-myLibs-dev', 'js-components-dev'], function () {
    return gulp.src([
        'partials/common/js/*.js',

    ])

       .pipe(concat('scripts.min.js'))

			 .pipe(sourcemaps.init({loadMaps: true}))
       .pipe(babel({
            presets: ['env']
        }))
			  .pipe(sourcemaps.write('.', {sourceRoot: path.join(__dirname)}))
        .pipe(gulp.dest('assets/js/'))
        .pipe(browserSync.reload({ stream: true }))
})

gulp.task('dist-js', ['js-libs', 'js-myLibs', 'js-components'], function () {
    return gulp.src([
        'partials/common/js/libs.js',
        'partials/common/js/my-libs.js',
        'partials/common/js/components.js',

    ])
        .pipe(concat('scripts.min.js'))
        .pipe(babel({
            presets: ['env']
        }))
			  .pipe(uglify())
        .pipe(gulp.dest('assets/js/'))
})

// ---- SASS ---- //

/*
 * Обрабатывем SASS главного экрана
 */

gulp.task('dev-sass-common-screen', function () {
    return gulp.src([
        'partials/common/sass/common-screen.+(scss|sass)'
    ])
        .pipe(concat('common-screen.sass'))
        .pipe(sass({ outputStyle: 'expand' }).on('error', notify.onError()))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(rename({ suffix: '.min', prefix: '' }))
        .pipe(cssnano())
        .pipe(gulp.dest('assets/css'))
})

gulp.task('dist-sass-common-screen', function () {
    return gulp.src([
        'partials/common/sass/common-screen.+(scss|sass)'
    ])
        .pipe(concat('common-screen.sass'))
        .pipe(sass({ outputStyle: 'expand' }).on('error', notify.onError()))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(rename({ suffix: '.min', prefix: '' }))
        .pipe(cssnano())
        .pipe(cleanCSS())
        .pipe(gulp.dest('assets/css'))
})

/*
 * Обрабатываем Общие стили
 */

gulp.task('dev-sass-common', function () {
    return gulp.src([
        'partials/common/sass/common.+(scss|sass)'
    ])
        .pipe(sass({ outputStyle: 'expand' }).on('error', notify.onError()))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(rename({ suffix: '.min', prefix: '' }))
        .pipe(cssnano())
        .pipe(gulp.dest('assets/css'))
})

gulp.task('dist-sass-common', function () {
    return gulp.src([
        'partials/common/sass/common.+(scss|sass)'
    ])
        .pipe(sass({ outputStyle: 'expand' }).on('error', notify.onError()))
        .pipe(autoprefixer(['last 15 versions']))
        .pipe(rename({ suffix: '.min', prefix: '' }))
        .pipe(cssnano())
        .pipe(cleanCSS())
        .pipe(gulp.dest('assets/css'))
})

/*
 * Обрабатываем все SASS стили
 */

gulp.task('dev-sass', ['dev-sass-common-screen', 'dev-sass-common'], function () {
    return gulp.src([
        'assets/css/common.min.css',
        'assets/css/common-screen.min.css'
    ])
        .pipe(browserSync.reload({ stream: true }))
})

gulp.task('prod-sass', ['prod-sass-common-screen', 'prod-sass-common'])

gulp.task('dist-sass', ['dist-sass-common-screen', 'dist-sass-common'])

/*
 * Обрабатываем стороние Css библиотеки
 */

gulp.task('css-libs', function () {
    return gulp.src('assets/css-libs/**/*.css')
        .pipe(concat('libs.min.css'))
        .pipe(cssnano())
        .pipe(cleanCSS())
        .pipe(gulp.dest('assets/css'))
})

// ---- Минимизация изображений ---- //

gulp.task('dist-imagemin', function () {
    return gulp.src([
        'assets/img/**/*'
    ])
        .pipe(cache(imagemin()))
        .pipe(gulp.dest('assets/minified-images'))
})

// ------------------------------------------------------ //

// --- Отслеживание --- //

gulp.task('dev-watch', ['dev-sass', 'dev-js', 'css-libs', 'browser-sync-php'], function () {
    gulp.watch(['assets/sass/**/*.+(scss|sass)', 'partials/components/**/*.+(scss|sass)'], ['dev-sass'])
    gulp.watch(['partials/common/js/libs/**/*.js', 'partials/common/js/myLibs/**/*.js', 'partials/components/**/*.js'], ['dev-js'])
    gulp.watch('src/assets/cssLibs/**/*.css', ['css-libs'])
    gulp.watch('**/*.php', browserSync.reload)
})

// ------------------------------------------------------ //

// --- Deploy --- //

/*
 * Создаем папку dist
 */

gulp.task('dist-build', [ 'dist-imagemin', 'dist-sass', 'dist-js'])
/*
 * Создаем папку prod - окончательная версия проекта
 */

// removes

gulp.task('clearcache', function () { return cache.clearAll() })

// -- Делаем выборку компонентов для деплоя в коллекцию-- //
