// Include Our Plugins
var gulp               = require('gulp');
sass                   = require('gulp-sass');
plumber                = require('gulp-plumber');
cleanCSS               = require('gulp-clean-css');
sourcemaps             = require('gulp-sourcemaps');
concatCss              = require('gulp-concat-css');
imagemin               = require('gulp-imagemin');
imageminJpegRecompress = require('imagemin-jpeg-recompress');
imageminPngquant       = require('imagemin-pngquant');
ignore                 = require('gulp-ignore');
rename                 = require('gulp-rename');
minify                 = require('gulp-minify');
notify                 = require('gulp-notify');
psi                    = require('psi');


var projectURL             = '';

// Compile Sass file to CSS
gulp.task('sass', function() {
return gulp.src('includes/scss/*.scss')
.pipe(plumber())
.pipe(sourcemaps.init())
.pipe(sass.sync({
errLogToConsole: true,
outputStyle: 'compressed', // Styles: nested, compact, expanded, compressed
precision: 10,
silenceDeprecations: ['import', 'color-functions', 'global-builtin']
}))
.pipe(sass.sync().on('error', sass.logError))
.pipe(cleanCSS({compatibility: 'ie8'}))
.pipe(sourcemaps.write({includeContent: false}))
.pipe(sourcemaps.init({loadMaps: true}))
.pipe(gulp.dest('includes/css', {mode: '0o777'}))
.pipe(notify({ message: 'Styles task complete', onLast: true }))
});

// Minify Javascript
gulp.task('minify-js', function() {
gulp.src('includes/js/**/*.js')
.pipe(ignore('includes/js/_notes'))
.pipe(minify({
    ext:{
        src:'-debug.js',
        min:'.js'
    }}))
.pipe(gulp.dest('includes/js/min', {mode: '0o777'}))
});

// Minify CSS
gulp.task('minify-css', function() {
return gulp.src('includes/css/dist/*.css')
.pipe(cleanCSS({debug: true}, function(details) {
console.log(details.name + ': ' + details.stats.originalSize);
console.log(details.name + ': ' + details.stats.minifiedSize);
}))
.pipe(gulp.dest('includes/css/min'))
.pipe(notify({ message: 'Done compressing css', onLast: true }))
});

gulp.task('concat-css', function () {
    return gulp.src('includes/css/*.css')
      .pipe(concatCss("screen.css"))
      .pipe(gulp.dest('includes/css/dist/', {mode: '0o777'}));
  });


gulp.task("wordpress-imagemin", function(){
return gulp.src("../../uploads/**/*")
    .pipe(imagemin([
        imagemin.gifsicle({interlaced: true}),
        imageminJpegRecompress({
            progressive: true,
            max: 80,
            min: 70
        }),
        imageminPngquant({quality: '75-85'}),
        imagemin.svgo({plugins: [{removeViewBox: false}]})
    ]))
    .pipe(gulp.dest("../../uploads/", {mode: '0o777'}));
});

// Image Optimization
gulp.task('image-min', function() {
gulp.src('images/**/*')
.pipe(imagemin())
.pipe(gulp.dest('images/', {mode: '0o777'}))
.pipe(notify({ message: 'Done optimizing images', onLast: true }))
});

gulp.task('pagespeed', function() {
psi(projectURL, {strategy: 'desktop'}).then(data => {
console.log('DESKTOP SPEED:', data.ruleGroups.SPEED);
console.log('PAGE STATS:', data.pageStats);
});

psi(projectURL, {strategy: 'mobile'}).then(data => {
console.log('MOBILE SPEED:', data.ruleGroups.SPEED);
console.log('USABILITY:', data.ruleGroups.USABILITY);
console.log('PAGE STATS:', data.pageStats);
});
});

// Watch Files For Changes
gulp.task('watch', function() {
gulp.watch('includes/scss/**/*.scss', ['sass']);
});

gulp.task('minify-styles', ['concat-css', 'minify-css']);

// Minify Task should be run before going live
gulp.task('minify', ['sass', 'minify-css', 'minify-js', 'wordpress-imagemin', 'image-min']);

// Task for development
gulp.task('serve', ['sass', 'watch']);

var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed' // Styles: nested, compact, expanded, compressed
};

/////////////////////////////////////////////
/////  Russ Sass /////////////

gulp.task('sassruss', function() {
    return gulp.src('includes/scssruss/*.scss')
        .pipe(plumber())
        .pipe(sass.sync(sassOptions))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(gulp.dest('includes/css'));

});

// Watch Files For Changes
gulp.task('watchruss', function() {
  gulp.watch('includes/scssruss/**/*.scss', ['sassruss']);
});

// Default Task
gulp.task('serveruss', ['sassruss', 'watchruss']);

///////////////////////////////////////////
///  Availability Sass /////////////

gulp.task('sasssp', function() {
    return gulp.src('includes/scss/siteplan.scss')
        .pipe(plumber())
        .pipe(sass.sync(sassOptions))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(gulp.dest('includes/css'));

});

// Watch Files For Changes
gulp.task('watchsp', function() {
  gulp.watch('includes/scss/**/*.scss', ['sasssp']);
});

// Default Task
gulp.task('servesp', ['sasssp', 'watchsp']);

/////////////////////////////////////////////
/////  Availability and POI Maps /////////////

gulp.task('sassmaps', function() {
    return gulp.src('includes/scssmaps/*.scss')
        .pipe(plumber())
        .pipe(sass.sync(sassOptions))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(gulp.dest('includes/maps/css'));

});

// Watch Files For Changes
gulp.task('watchmaps', function() {
  gulp.watch('includes/scssmaps/**/*.scss', ['sassmaps']);
});

// Default Task
gulp.task('servemaps', ['sassmaps', 'watchmaps']);
