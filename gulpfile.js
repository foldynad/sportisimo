const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const del = require('del');
const minify = require("gulp-minify");

gulp.task('clean', () => {
    return del([
        'www/css/main.css',
        'www/css/materialize.css',
    ]);
});

gulp.task('styles', () => {
    return gulp.src('www/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('www/css/'));
});

// gulp.task('minifyCss', () => {
//     return gulp.src('www/css/main.css', { allowEmpty: true })
//         .pipe(minify({noSource: true}))
//         .pipe(gulp.dest('www/css/'))
// });

gulp.task('default', gulp.series(['clean', 'styles']));