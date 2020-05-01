<?php 
//max width for embeds like youtube videos
if ( ! isset( $content_width ) ) $content_width = 640;

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
);
add_theme_support( 'custom-header', $args );

//Custom Logo - step 1 of 2 ( display in your theme with the_custom_logo() )
$args = array(
	'width' 	=> 300,
	'height' 	=> 300,
	'flex-width' => true,
	'flex-height'=> true,
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




//no close php