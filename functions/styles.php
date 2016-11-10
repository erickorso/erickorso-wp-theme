
<?php
// custom_scripts
function custom_styles_() {
	wp_deregister_style( 'bootstrap' );
	wp_deregister_style( 'font-awesome' );
	wp_register_style( 'bootstrap',    get_stylesheet_directory_uri().'/css/bootstrap.min.css', false, '3', false );
	wp_register_style( 'font-awesome',    get_stylesheet_directory_uri().'/font/font-awesome/css/font-awesome.min.css', false, '3', false );
	wp_register_style( 'animate',    get_stylesheet_directory_uri().'/css/animate.min.css', false, '3', false );
	wp_register_style( 'hover',    get_stylesheet_directory_uri().'/css/hover.css', false, '3', false );
	wp_register_style( 'bxslider',    get_stylesheet_directory_uri().'/js/bxslider/jquery.bxslider.css', false, '3', false );
	wp_register_style( 'parallax-blur',    get_stylesheet_directory_uri().'/css/parallax-blur.css', false, '3', false );
	wp_register_style( 'style',    get_stylesheet_directory_uri().'/css/style.css', false, '3', false );
	// wp_register_style( 'sweet',    get_stylesheet_directory_uri().'/js/sweetalert/dist/sweetalert.css', false, '3', false );

	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'animate' );
	wp_enqueue_style( 'hover' );
	wp_enqueue_style( 'bxslider' );
	// wp_enqueue_style( 'sweet' );
	wp_enqueue_style( 'style' );

	// if (!is_home()) {
		wp_enqueue_style( 'parallax-blur' );
	// }

}

// Hook into the 'wp_enqueue_styles' action
add_action( 'wp_enqueue_scripts', 'custom_styles_' ); 

// agregar estilos y librerias css al head
add_action( 'wp_head', function(){
	?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link href="https://fonts.googleapis.com/css?family=Bad+Script|Farsan|Open+Sans:300,400,700" rel="stylesheet">  
	<?php
}, 99);