<?php 
/* 
Template Name: Portfolio by Category
*/
//edit these to match the stuff you registered in your custom post type plugin
$post_type = 'work';
$taxonomy = 'work_category'; ?>

<?php get_header(); ?>
<main class="content">
  	<?php //The main Loop - for main page title and intro
  	if( have_posts() ){
  		while( have_posts() ){
  			the_post();
  			?>

  			<h1><?php the_title(); ?></h1>
  			<?php the_content(); ?>

  		<?php }
  	} //end the main loop ?>
  	<?php         

	// Get every term in this taxonomy as an array
 	$terms = get_terms( $taxonomy );

	//go through each term in this taxonomy one at a time
  	foreach( $terms as $term ) { 

    	//get all posts assigned to this term
  		$custom_loop = new WP_Query( array(
  			'post_type' => $post_type,
  			'taxonomy' => $taxonomy,
  			'term' => $term->slug,
  		) );

    	//LOOP each term (category)
  		if( $custom_loop->have_posts() ){ ?>
  			<h1><?php echo $term->name; ?></h1>
  			<div class="grid">
  			<?php
  			while( $custom_loop->have_posts() ) { $custom_loop->the_post(); ?>
  				<article <?php post_class(); ?>>
  					<div class="overlay">

  						<h2 class="entry-title"> 
  							<a href="<?php the_permalink(); ?>"> 
  								<?php the_title(); ?> 
  							</a>
  						</h2>

  						<?php 
        //the featured image (activate in functions.php first)
  						the_post_thumbnail( 'thumbnail' ); ?>

  					</div>

  					<div class="entry-content">
  						<?php
       // excerpts are short previews of the content 
       //the_content(); 
  						the_excerpt(); ?>
  					</div>

  				</article>

  				<?php } //end while posts ?>
  		</div>
  			<?php 
  			} //end if posts
  		}//end foreach term
  			?>
  	<?php get_sidebar() ?>
  	<?php get_footer() ?>