<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name'); ?></title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

  <?php wp_head(); //required for plugins and the admin bar to work  ?>

</head>
<body <?php body_class(); ?>>

	<header class="header">
  <div class="header-bar">
    <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
    <h2><?php bloginfo('description'); ?></h2>
    <nav>
      <ul class="nav">
       <?php 
       //temporary nav until we learn about the menu system
       wp_list_pages( array(
          'title_li' => '',
       ) ); ?>
      </ul>
    </nav>  

   <?php get_search_form(); //include searchform.php or do the default if it doesn't exist ?>
    
  </div>
</header>
<div class="wrapper">