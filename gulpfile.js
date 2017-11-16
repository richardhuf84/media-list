'use-strict';

var gulp = require('gulp'),
  sass = require('gulp-sass'),
  browsersync = require('browser-sync').create(),
  concat = require('gulp-concat'),
  rename = require('gulp-rename'),
  uglify = require('gulp-uglify'),
  del = require('del');

//script paths
var jsFiles = 'js/**/*.js',
  jsDest = 'dist/js',
  scssFiles = 'css/**/*.scss',
  cssDest = 'dist/css';

gulp.task('sass', function() {
  return gulp
    .src('css/**/*.scss')
    .pipe(sass()) // Using gulp-sass
    .pipe(gulp.dest(cssDest))
    .pipe(
      browsersync.reload({
        stream: true
      })
    );
});

gulp.task('watch', ['browsersync', 'sass', 'scripts'], function() {
  gulp.watch('css/**/*.scss', ['sass']);
  gulp.watch('*.php', browsersync.reload);
  gulp.watch('js/**/*.js', browsersync.reload);
});

gulp.task('browsersync', function() {
  browsersync.init({
    proxy: 'media-list.dev'
  });
});

gulp.task('scripts', function() {
  return gulp
    .src(jsFiles)
    .pipe(concat(jsFiles))
    .pipe(gulp.dest(jsDest))
    .pipe(rename('scripts.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(jsDest));
});

gulp.task('clean:dist', function() {
  return del.sync('dist/**/*');
});
