<?php 
	global $option;
	$logo = $option['header-identity'][0]['logo'];
	$logo_sec = $option['header-identity'][0]['logo-secundario'];
	get_template_part('class/header-logo-class');
	$logos = new logoHeader($logo, $logo_sec, 'Configura el logo');
?>