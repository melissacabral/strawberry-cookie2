<?php get_header(); //requires  header.php ?>

  <main class="content">
   
  	<?php //The Loop
  	if( have_posts() ){
  		while( have_posts() ){
  			the_post();
  	 ?>
    <article <?php post_class(); ?>>

      <?php the_post_thumbnail( 'large' ); ?>

      <h2 class="entry-title"> 
				<?php the_title(); ?> 			
			</h2>
      <div class="entry-content">
       <?php 
       the_content(); 
       wp_link_pages(); //for paginated posts
       ?>
      </div>
     
    </article>
    <!-- end post -->

    <section class="pagination">
      <?php 
      previous_post_link( '%link', '&larr; %title' );
      next_post_link( '%link', '%title &rarr;' );      
      ?>
    </section>

     


	<?php 
		}//end while
	}else{ ?>

		<div class="noposts">Sorry, no posts to show</div>

	<?php 
	} //end of The Loop 
	?>


  </main>
  <!-- end #content -->




<?php get_footer();  //requires footer.php ?>