<?php 
define('SCREEN_LANG', 'screen');

// Menus
	register_nav_menus(
		array(
			'main_nav'  =>__('Principal Menu', LANG),
			'footer_nav'=>__('Fotter Menu', LANG)
			)
		);
// admin bar hide
add_filter ('show_admin_bar', '__return_false');

// Full theme supports
add_action('after_setup_theme', function () {
	// Add theme support for Featured Images
	add_theme_support('post-thumbnails');
	// Add theme support for HTML5 Semantic Markup
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
	// Add theme support for document Title tag
	add_theme_support('title-tag');
});

// eliminar opciones del admin menu
add_action('admin_menu', 'my_remove_menu_pages');
function my_remove_menu_pages() {
        // remove_menu_page('edit.php'); // Entradas
        // remove_menu_page('upload.php'); // Multimedia
        // remove_menu_page('link-manager.php'); // Enlaces
        // remove_menu_page('edit.php?post_type=page'); // Páginas
        // remove_menu_page('edit-comments.php'); // Comentarios
        // remove_menu_page('themes.php'); // Apariencia
        // remove_menu_page('plugins.php'); // Plugins
        // remove_menu_page('users.php'); // Usuarios
        // remove_menu_page('tools.php'); // Herramientas
        // remove_menu_page('options-general.php'); // Ajustes
}
add_action('after_setup_theme', 'my_theme_setup');

function my_theme_setup(){
    load_theme_textdomain(LANG, get_template_directory() . '/languages');
}

// rewrite url
// add_action( 'init',
	// function () {
	// 	$rewrite = array(
	// 		'slug'                => 'news',
	// 		'with_front'          => true,
	// 		'pages'               => true,
	// 		'feeds'               => true,
	// 	);
	// 	$args = array(
	// 		'public'              => true,
	// 		'has_archive'         => 'news',
	// 		'rewrite'             => $rewrite,
	// 	);
	// }
	// , 0 );
