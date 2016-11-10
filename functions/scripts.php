<?php 

// custom_scripts
function custom_scripts_() {
	wp_deregister_script( 'jquery' );

	wp_register_script( 'jquery',    get_stylesheet_directory_uri().'/js/jquery.js', false, '2', false );
	wp_register_script( 'bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), '3', true );
	wp_register_script( 'wow',       get_stylesheet_directory_uri().'/js/wow.js', array( 'jquery' ), '1', true );
	wp_register_script( 'parallax',  get_stylesheet_directory_uri().'/js/parallax.js', array( 'jquery' ), '1', true );
	wp_register_script( 'parallax-blur',  get_stylesheet_directory_uri().'/js/parallax-blur.js', array( 'jquery' ), '1', true );
	wp_register_script( 'bxslider',  get_stylesheet_directory_uri().'/js/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '1', true );
	wp_register_script( 'angular', get_stylesheet_directory_uri().'/js/angular.min.js', array( 'jquery' ), '1', true );
	wp_register_script( 'particles', get_stylesheet_directory_uri().'/js/particles/particles.min.js', array( 'jquery' ), '1', true );
	wp_register_script( 'demo', get_stylesheet_directory_uri().'/js/particles/demo/js/app.js', array( 'jquery' ), '1', true );
	wp_register_script( 'stats', get_stylesheet_directory_uri().'/js/particles/demo/js/lib/stats.js', array( 'jquery' ), '1', true );
	wp_register_script( 'functions', get_stylesheet_directory_uri().'/js/functions.js', array( 'jquery' ), '1', true );
	wp_register_script( 'sweet', get_stylesheet_directory_uri().'/js/sweetalert/dist/sweetalert.min.js', array( 'jquery' ), '1', true );
	wp_register_script( 'masonry', 'https://npmcdn.com/masonry-layout@4.1/dist/masonry.pkgd.min.js', array( 'jquery' ), '1', true );
	wp_register_script( 'count-to', get_stylesheet_directory_uri().'/js/count-to/jquery.countTo.js', array( 'jquery' ), '1', true );
	wp_register_script( 'waypoints', get_stylesheet_directory_uri().'/js/waypoints/lib/jquery.waypoints.min.js', array( 'jquery' ), '1', true );
	

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap' );
	wp_enqueue_script( 'wow' );
	wp_enqueue_script( 'parallax' );
	wp_enqueue_script( 'bxslider' );
	wp_enqueue_script( 'masonry' );
	// wp_enqueue_script( 'angular' );
	// wp_enqueue_script( 'particles' );
	// wp_enqueue_script( 'demo' );
	// wp_enqueue_script( 'sweet' );
	// wp_enqueue_script( 'stats' );
	wp_enqueue_script( 'functions' );

	if (is_home()) {
		// wp_enqueue_script( 'parallax-blur' );
		// wp_enqueue_script( 'count-to' );
		// wp_enqueue_script( 'waypoints' );
	}
}

function custom_admin_scripts_() {

	wp_register_script( 'custom_admin',    get_stylesheet_directory_uri().'/js/admin/custom_admin.js', false, '2', false );
	wp_enqueue_script( 'custom_admin' );
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'custom_scripts_' );
add_action( 'admin_enqueue_scripts', 'custom_admin_scripts_' );

