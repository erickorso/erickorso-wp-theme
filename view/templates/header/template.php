<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php wp_head(); ?>
    <?php 
        /*
        chat free plugin https://chatra.io/es/
        for include just uncomment de line
        */
        // get_template_part('view/chatra/chatra');
    ?>
</head>
<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar" data-offset="150">
    <?php 
        /*
        preload view
        for include just uncomment de line
        */
        get_template_part('view/widgets/preload/preloader'); 
    ?>
    <header class="main-header navbar-fixed-top">
            <?php
            /*
            top logo / nav
            */
            get_template_part('view/templates/header/logo-nav-header');
        ?>
    </header>
    
            