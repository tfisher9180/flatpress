var basePaths = {
	scss: './sass/',
	css: './css/',
	js: './js/',
	img: './images/',
	fonts: './fonts/',
	node: './node_modules/',
	src: './src/',
};

var gulp = require('gulp')
var autoprefixer = require('autoprefixer');
var postcss = require('gulp-postcss');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var del = require('del');
var merge = require('merge-stream');
var replace = require('gulp-replace');
var fontello = require('gulp-fontello');

gulp.task('css', function() {
	var scss = gulp.src(basePaths.scss + '**/*.scss')
		.pipe(sass({
			outputStyle: 'expanded',
			indentType: 'tab',
			indentWidth: '1'
		}).on('error', sass.logError))
	;

	var fontello = gulp.src(basePaths.css + 'fontello.css')
		.pipe(replace(/url\(['"]?[\.]+\/font/g, 'url(\'fonts')) 
	;

	var mergedStream = merge(scss, fontello)
		.pipe(concat('style.css'))
		.pipe(postcss([
			autoprefixer('last 2 versions', '> 1%')
		]))
		.pipe(gulp.dest('./'))

	return mergedStream;
});

gulp.task('js', function() {
	var scripts = [
		basePaths.js + 'skip-link-focus-fix.js'
	];
	return gulp.src(scripts)
		.pipe(concat('theme.js'))
		.pipe(gulp.dest(basePaths.js));
});

gulp.task('fontello', function() {
	return gulp.src(basePaths.fonts + 'config.json')
		.pipe(fontello())
		.pipe(gulp.dest(basePaths.src + 'fontello/'))
});

gulp.task('copy-assets', ['clean-src', 'clean-fonts', 'fontello'], function() {
	var stream = gulp.src(basePaths.src + 'fontello/font/**/*.{ttf,woff,woff2,eof,svg}')
		.pipe(gulp.dest(basePaths.fonts));

	gulp.src(basePaths.src + 'fontello/css/fontello.css')
		.pipe(gulp.dest(basePaths.css));

	return stream;
});

gulp.task('watch', function() {
	gulp.watch(['./**/*.css', './**/*.scss'], ['css']);
	gulp.watch([basePaths.js + '**/*.js', '!theme.js'], ['js']);
});

gulp.task('clean-src', function() {
	return del([basePaths.src + '**/*']);
});

gulp.task('clean-fonts', function() {
	return del([basePaths.fonts + '**/*', '!' + basePaths.fonts + 'config.json']);
});

gulp.task('default', ['watch', 'js']);
