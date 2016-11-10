<?php
	/*
		theme options works whits cmb2 wp_plugin
	*/ 
	global $option;
 	$option  = get_option('screen_options'); 
	get_template_part('view/templates/header/template');
