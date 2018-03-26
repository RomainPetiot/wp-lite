var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var imagemin = require('gulp-imagemin');
var cleanCSS = require('gulp-clean-css');
var minify = require('gulp-minify');
var rename = require("gulp-rename");
//var cache = require('gulp-cache');

gulp.task('default', function() {
    var files = [
        	'./assets/css/*.css',
        	'./assets/js/*.js',
        	'**/*.php',
        	'assets/images/**/*.{png,jpg,gif,svg,webp}',
        ];

        browserSync.init(files, {
    	    // Replace with URL of your local site
    	    proxy: "http://localhost/test/",
        });

        //gulp.watch('./assets/scss/**/*.scss', ['sass','minify-css']);
		gulp.watch('./assets/scss/**/*.scss', ['sass']);
        gulp.watch('./assets/js/source/*.js', ['compressJS']).on('change', browserSync.reload);
})

gulp.task('sass', function() {
  return gulp.src(['assets/scss/**/*.scss', 'node_modules/normalize.css/normalize.css']) // Gets all files ending with .scss in app/scss
    .pipe(sass().on('error', sass.logError))
    //.pipe(gulp.dest('assets/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(cleanCSS())
	.pipe(gulp.dest('./assets/css'))
    .pipe(browserSync.reload({
      stream: true
    }))
});

gulp.task('compressJS', function() {
  gulp.src('assets/js/source/*.js')
    .pipe(minify({
        ext:{
            //src:'-debug.js',
            min:'.min.js'
        },
        exclude: ['tasks'],
        ignoreFiles: ['.combo.js', '.min.js']
    }))
    .pipe(gulp.dest('assets/js'))
});

gulp.task('images', function(){
  return gulp.src('assets/image-source/**/*.+(png|jpg|jpeg|gif|svg)')
  .pipe(imagemin({
      interlaced: true
    }))
  .pipe(gulp.dest('assets/images'))
});
