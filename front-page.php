<?php get_header(); //requires  header.php ?>

<main class="content">

  	<?php //The Loop
  	if( have_posts() ){
  		while( have_posts() ){
  			the_post();
            ?>
            <article <?php post_class(); ?>>
              <h2 class="entry-title"> 				
               <?php the_title(); ?>		
           </h2>
           <div class="entry-content">
             <?php the_content(); ?>
         </div>

     </article>
     <!-- end post -->
     <?php 
		}//end while
	}else{ ?>

		<div class="noposts">Sorry, no posts to show</div>

       <?php 
	} //end of The Loop 
	?>


    <?php 
    //Custom Query example
    //get 2 most recent portfolio pieces (custom post type)
    $portfolio_query = new WP_Query( array(
        'post_type' => 'work',
        'posts_per_page' => 2,
        //example tax query - only get "graphic design" work_category
        'tax_query' => array(
            array(
                'taxonomy'  => 'work_category',
                'field'     => 'slug',
                'terms'     => 'featured',
            )
        ),

    ) );
    //custom loop
    if( $portfolio_query->have_posts() ){
    ?>
    <div class="featured-work">
        <h2>Featured Work</h2>

        <?php while( $portfolio_query->have_posts() ){
             $portfolio_query->the_post();
        ?>
        <article>
            <div class="overlay">
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <?php the_post_thumbnail( 'sc_wide' ); ?>
            </div>
            <div class="entry-content">
                <?php the_excerpt() ?>
            </div>
        </article>
        <?php } //end while ?>
    </div>
    <?php }//end custom loop 

    //clean up after custom query 
    wp_reset_postdata();
    ?>


</main>
<!-- end #content -->

<?php get_sidebar('page'); //include sidebar-page.php ?>

<?php get_footer();  //requires footer.php ?>