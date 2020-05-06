<?php get_header(); //requires header.php ?>

  <main class="content">

    <h1><?php post_type_archive_title(); ?></h1>
   
  	<?php //The Loop
  	if( have_posts() ){
  		while( have_posts() ){
  			the_post();
  	 ?>
    <article <?php post_class(); ?>>
      <div class="overlay">
        
        <h2 class="entry-title"> 
  				<a href="<?php the_permalink(); ?>"> 
  					<?php the_title(); ?> 
  				</a>
  			</h2>

        <?php 
        //the featured image (activate in functions.php first)
        the_post_thumbnail( 'sc_wide' ); ?>

      </div>

      <div class="entry-content">
       <?php
       // excerpts are short previews of the content 
       //the_content(); 
       the_excerpt(); ?>
      </div>
      
    </article>
    <!-- end post -->
	<?php 
		}//end while
  ?>

  <section class="pagination">
    <?php 
    //example of next & previous buttons
    //previous_posts_link('&larr; Newer Posts'); //newer posts
    //next_posts_link('Older Posts &rarr;'); //older posts
    
    //numbered pagination
    the_posts_pagination(array(
      'prev_text' => '&larr;',
      'next_text' => 'Next Page &rarr;',
      'mid_size'  => 2,
    ));
    
    ?>
  </section>

  <?php
	}else{ ?>

		<div class="noposts">Sorry, no posts to show</div>

	<?php 
	} //end of The Loop 
	?>


  </main>
  <!-- end #content -->




<?php get_footer();  //requires footer.php ?>