<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <?php wp_head(); //required for plugins and the admin bar to work  ?> 
</head>
<body <?php body_class(); ?>>
     <div class="site">
    <header class="header" style="background-image:url(<?php header_image(); ?>)">
        
        <div class="branding">
            <?php the_custom_logo(); ?>
            <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            <h2 class="site-description"><?php bloginfo('description'); ?></h2>
        </div>
    <div class="navigation">
        <?php 
        //Main Navigation
        wp_nav_menu( array(
            'theme_location'  => 'main_menu', //registered in functions.php
            'fallback_cb'     => false,
            'container'       => 'nav',       //wrap with <nav> instead of <div>
            'container_class' => 'main-menu',
        ) ); 
        ?>  
    </div>
        <div class="utilities">
            <!-- woocommerce cart total -->
            <div class="cart-preview">
                <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
            </div>
            <!-- end woocommerce cart total -->
            <?php 
            //Social Icons menu
            wp_nav_menu( array(
                'theme_location'  => 'social_icons',
                'fallback_cb'     => false,
                'container_class' => 'social-navigation',
                'link_before'     => '<span class="screen-reader-text">',
                'link_after'      => '</span>',
            ) );
            ?>
        </div>
        <?php get_search_form(); //include searchform.php or do the default if it doesn't exist ?>
    </header>
   