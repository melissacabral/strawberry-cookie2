<?php 
//max width for embeds like youtube videos
if ( ! isset( $content_width ) ) $content_width = 640;

//add an image size for wide banner images 
add_image_size( 'sc_wide', 800, 300, true );


//activate "sleeping features"

//SEO-friendly titles on every page (you should not have <title> tag in header.php)
add_theme_support( 'title-tag' );

//turn on "Featured Images"
add_theme_support( 'post-thumbnails' );

//Custom Background image and color
add_theme_support( 'custom-background' );

//makes RSS blog feeds better
add_theme_support( 'automatic-feed-links' );

//Custom Header step 1 of 2 (display in the theme header with header_image())
$args = array(
	'width' => 1000,
	'height' => 600,	
	'default-image' => get_template_directory_uri() . '/images/header-bg.png',
);
add_theme_support( 'custom-header', $args );

//Custom Logo - step 1 of 2 ( display in your theme with the_custom_logo() )
$args = array(
	'width' 	=> 300,
	'height' 	=> 300,
	'flex-width' => true,
	'flex-height'=> true,
	'header-text' => array( 'site-title', 'site-description' ),
);
add_theme_support( 'custom-logo', $args );

//turn on HTML5 on built in code
//array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' )
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );



//Simple Hook Example - change the length of the excerpt
function sc_ex_length(){
	return 30; //words
}
add_filter( 'excerpt_length', 'sc_ex_length' );



//improve the [...] after excerpts
function sc_readmore(){
	return '&hellip; <a href="' . get_the_permalink() . '" class="button button-outline">Read More</a>';
}
add_filter( 'excerpt_more', 'sc_readmore' );


//Action example
//add a JS file to improve comment replies
function sc_better_replies(){
	wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'sc_better_replies' );


//Set up Menu Locations
function sc_menu_setup(){
	register_nav_menus( array(
		'main_menu' 	=> 'Main Menu',
		'social_icons' 	=> 'Social Media Icons',
	) );
}
add_action( 'init', 'sc_menu_setup' );

//attach any needed stylesheets
function sc_styles(){
	
	//genericons for social menu
	$url = get_stylesheet_directory_uri() . '/genericons/genericons.css';
	wp_enqueue_style( 'genericons', $url );

	//style.css
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'sc_styles' );


//Set up Widget Areas AKA Dynamic Sidebars
add_action( 'widgets_init', 'sc_widget_areas' );
function sc_widget_areas(){
	register_sidebar( array(
		'name'	=> 'Blog Sidebar',
		'id' => 'blog-sidebar',
		'description' => 'Displays next to blog posts and archives',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' => '</section>',
	) );

	register_sidebar( array(
		'name'	=> 'Footer Area',
		'id' => 'footer-area',
		'description' => 'Displays at the bottom of everything',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' => '</section>',
	) );

	register_sidebar( array(
		'name'	=> 'Page Aside',
		'id' => 'page-aside',
		'description' => 'Displays next to static pages',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' => '</section>',
	) );
	
	register_sidebar( array(
		'name'	=> 'Shop Sidebar',
		'id' => 'shop-aside',
		'description' => 'Displays next to WooCommerce shop pages',
		'before_widget' => '<section class="widget %2$s" id="%1$s">',
		'after_widget' => '</section>',
	) );

}


//Count all real comments on a post
add_filter( 'get_comments_number', 'sc_comments_count' );
function sc_comments_count(){
	//post id
	global $id;
	$comments = get_approved_comments( $id );
	$count = 0;

	//go through the comments array, counting each real comment
	foreach( $comments AS $comment ){
		if( $comment->comment_type == '' ){
			$count ++;
		}
	}
	return $count;
}

//Count all the trackbacks and pingbacks on a post

function sc_pings_count(){
	//post id
	global $id;
	$comments = get_approved_comments( $id );
	$count = 0;

	//go through the comments array, counting each real comment
	foreach( $comments AS $comment ){
		if( $comment->comment_type != '' ){
			$count ++;
		}
	}

	echo $count == 1 ? __('One Site Links Here', 'strawberry-cookie' ) : $count . __(' Sites Link Here', 'strawberry-cookie');
}


/*woocommerce additions*/
add_action( 'after_setup_theme', 'sc_woo' );
function sc_woo(){
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}


/**
 * Woocommerce Show cart contents / total Ajax
 * https://docs.woocommerce.com/document/show-cart-contents-total/
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}


//disable all woocommerce styles
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// make woocommerce work with our page structure
 //remove the default content wrapper HTML
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//add our correct content wrapper HTML
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<main class="content">';
}

function my_theme_wrapper_end() {
  echo '</main>';
}

//Example of modifying the main query 
//change the number of posts on the search results page
add_action( 'pre_get_posts', 'sc_change_queries' );
function sc_change_queries( $query ){
	if( is_search() AND $query->is_main_query()  ){
		$query->set( 'posts_per_page', 15 );
		$query->set( 'post_type', 'post' );
	}

}

// Customization API additions
add_action( 'customize_register', 'sc_customize' );
function sc_customize( $wp_customize ){
	//footer bg color - adding to the built-in colors section
	$wp_customize->add_setting( 'footer_bg_color', array( 'default' => 'orange' ) );

	//add the User Interface - color picker
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'footer_bg_color_ui', array(
			'label' 	=> 'Footer Background Color',
			'section' 	=>	'colors', //built-in
			'settings'	=>	'footer_bg_color',
		)
	) );

	//footer text color
	$wp_customize->add_setting( 'footer_text_color', array( 'default' => 'black' ) );

	//add the User Interface - color picker
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize, 'footer_text_color_ui', array(
			'label' 	=> 'Footer Text Color',
			'section' 	=>	'colors', //built-in
			'settings'	=>	'footer_text_color',
		)
	) );

	//custom section for font choice
	$wp_customize->add_section( 'sc_typography', array(
		'title' 		=> 'Typography',
		'capability'	=> 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'heading_font', array( 'default' => 'Lobster' ) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize, 'heading_font_ui', array(
			'label' 	=> 'Heading Font',
			'section' 	=> 'sc_typography',
			'settings' 	=> 'heading_font',
			'type'		=> 'radio', //radio, checkbox or select
			'choices'	=> array(
				'Roboto' 			=> 'Roboto - Modern sans-serif',
				'Lobster' 			=> 'Lobster - Flourishy',
				'Righteous'			=> 'Righteous - Bold geometric',
				'Roboto Condensed' 	=> 'Roboto Condensed - skinny robot',
			),
		)
	) );

} //sc_customize function


//Display the customize options as embedded CSS
add_action( 'wp_head', 'sc_embedded_css' );
function sc_embedded_css(){
	?>
	<style>
		.footer{
			background-color: <?php echo get_theme_mod('footer_bg_color'); ?> ;
			color: <?php echo get_theme_mod('footer_text_color'); ?> ;
		}

		h1{
			font-family: "<?php echo get_theme_mod('heading_font'); ?>", Arial, sans-serif;
		}
	</style>
	<?php
}

//custom font choice - enqueue the google font stylesheet and add custom css
add_action( 'wp_enqueue_scripts', 'sc_google_font' );
function sc_google_font(){
	//convert spaces to +
	$urlsafe = urlencode( get_theme_mod('heading_font') );
	wp_enqueue_style( 'custom_font', 'https://fonts.googleapis.com/css2?family=' . $urlsafe . '&display=swap' );
}



//no close php