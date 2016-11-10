<?php

define('LANG', 'screen');
defined( 'THEME_URI' ) || define( 'THEME_URI', get_stylesheet_directory_uri() );
defined( 'THEME_PATH' ) || define( 'THEME_PATH', realpath( __DIR__ ) );

get_template_part('functions/config');
get_template_part('functions/styles');
get_template_part('functions/scripts');
get_template_part('functions/post-type');
get_template_part('functions/taxonomy');
get_template_part('functions/admin');
get_template_part('functions/metabox');
get_template_part('functions/functions');


