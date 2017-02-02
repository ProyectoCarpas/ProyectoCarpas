/* Add Dependecies */
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minifyCSS = require('gulp-minify-css'),
    imagemin = require('gulp-imagemin');

gulp.task('default', ['js', 'css', 'images','watch']);


/////////////////////////// TASKS list  ///////////////////////

gulp.task('js', function () {

	gulp.src([
		'app/webroot/js/primaryLibreries/jquery.min-1.11.js',
		'app/webroot/js/primaryLibreries/bootstrap.js',
		'app/webroot/js/primaryLibreries/formValidation.js',
		'app/webroot/js/primaryLibreries/bootstrap_validation.js',

		'app/webroot/js/secondLibreries/*.js',

		'app/webroot/js/myFiles/*.js',
		])
	
	.pipe(concat('allJsFiles.js'))

	.pipe(uglify())

	.pipe(gulp.dest('app/webroot/js/'));
});


gulp.task('css', function () {

	gulp.src([

		'app/webroot/css/primaryLibreries/bootstrap.css',
		'app/webroot/css/primaryLibreries/*.css',

		'app/webroot/css/myFiles/*.css',
		])

	.pipe(concat('allCssFiles.css'))

	.pipe(minifyCSS())

	.pipe(gulp.dest('app/webroot/css/'));
});


gulp.task('images', function () {

	gulp.src([
		'app/webroot/img/myImages/*.*',
		])

	.pipe(imagemin())

	.pipe(gulp.dest('app/webroot/img/'));
});


gulp.task('watch', function () {
  gulp.watch('app/webroot/css/myFiles/**/*.css', ['css']);
  gulp.watch('app/webroot/js/myFiles/**/*.js', ['js']);
});