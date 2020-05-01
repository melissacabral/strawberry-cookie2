<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

  <?php wp_head(); //required for plugins and the admin bar to work  ?>

</head>
<body <?php body_class(); ?>>

	<header class="header" style="background-image:url(<?php header_image(); ?>)">
  <div class="header-bar">

    <?php the_custom_logo(); ?>

    <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
    <h2><?php bloginfo('description'); ?></h2>
    
    <?php 
    //Main Navigation
    wp_nav_menu( array(
      'theme_location'  => 'main_menu', //registered in functions.php
      'fallback_cb'     => false,
      'container'       => 'nav',       //wrap with <nav> instead of <div>
      'container_class' => 'main-menu',
    ) ); ?>  


    <?php 
    //Social Icons
    wp_nav_menu( array(
      'theme_location'  => 'social_icons',
      'fallback_cb'     => false,
      'container_class' => 'social-navigation',
      'link_before'     => '<span class="screen-reader-text">',
      'link_after'      => '</span>',
    ) );
     ?>


   <?php get_search_form(); //include searchform.php or do the default if it doesn't exist ?>
    
  </div>
</header>
<div class="wrapper">