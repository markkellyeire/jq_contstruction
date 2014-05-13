var exec       = require( 'child_process' ).exec,
	gulp       = require( 'gulp' ),
	gutil      = require( 'gulp-util' ),
	concat     = require( 'gulp-concat' ),
	sass       = require( 'gulp-ruby-sass' ),
	uglify     = require( 'gulp-uglify' ),
	notify     = require( 'gulp-notify' ),
	livereload = require('gulp-livereload'),
	watchr     = require( 'watchr' ),
	path       = require( 'path' );

var theme  = 'wp-content/themes/sparky/',
	paths = {
		assets: theme + 'assets/',
		css: {
			input:  theme + 'assets/css/**/*.scss',
			output: theme + 'css/'
		},
		js: {
			input:  theme + 'assets/js/**/*.js',
			output: theme + 'js/'
		}
	};

var errorHandler = function( error ) {
	gutil.beep();
	
	var errorString = error.plugin + ' encountered an error';
	if ( error.fileName )   errorString += ' in ' + error.fileName;
	if ( error.lineNumber ) errorString += ' on line ' + error.lineNumber;
	
	console.log( gutil.colors.red( errorString ) );
	console.log( gutil.colors.red( error.message ) );
	
	// For Mac only, ignored on other platforms.
	exec( 'say stylesheet compile error' );
};

gulp.task( 'styles' , function() {
	gulp.src( paths.css.input )
		.pipe( sass({ style: 'compressed' , quiet: true }) )
			.on( 'error' , errorHandler )
		.pipe( concat( 'main.css' ) )
		.pipe( gulp.dest( paths.css.output ) )
		.pipe( notify({ title: 'Stylesheets Compiled' , message: 'Stylesheets have been compiled successfully.' }) );
});

gulp.task( 'scripts' , function() {
	gulp.src( paths.js.input )
		.pipe( uglify() )
		.pipe( concat( 'main.js' ) )
		.pipe( gulp.dest( paths.js.output ) )
		.pipe( notify({ title: 'JavaScript Compiled' , message: 'JavaScript files have been compiled successfully.' }) );
});

gulp.task( 'livereload' , function() {
	gulp.src( theme )
		.pipe( livereload() );
});

/**
 * Use Watchr instead of the default gulp.watch because gulp.watch seems to
 * think that files are constantly changing on my Mac.
 * 
 * If gulp.watch is preferred, uncomment the lines below and comment out the watchr
 * call instead. Simple switch.
 */
gulp.task( 'watch' , function() {
	var timeout;
	
	// watchr.watch({
	// 	path: theme,
	// 	catchupDelay: 100,
	// 	listeners: {
	// 		change: function( type , file , currentStat , previousStat ) {
	// 			var extension = path.extname( file ),
	// 				task      = null;
				
	// 			if ( '.js'   == extension ) task = 'scripts';
	// 			if ( '.scss' == extension ) task = 'styles';
				
	// 			if ( task ) gulp.start( task );
				
	// 			// No matter what file changes, let's trigger livereload, but throttle it
	// 			// so that it doesn't more than once every 2 seconds.
	// 			clearTimeout( timeout );
	// 			timeout = setTimeout(function() {
	// 				gulp.start( 'livereload' );
	// 			}, 2000);
	// 		}
	// 	}
	// });
	
	gulp.watch( theme + 'assets/css/**/*.scss' , [ 'styles' ] );
	gulp.watch( theme + 'assets/js/**/*.js'    , [ 'scripts' ] );
});

gulp.task( 'default' , [ 'styles' , 'scripts' , 'watch' ] );
