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
      <div class="postmeta">
        <span class="author">by: <?php the_author(); ?> </span>
        <span class="date"> <?php the_time('F j, Y'); ?> </span>
        <span class="num-comments"> <?php comments_number(); ?> </span>
        <span class="categories"> 
      <?php the_category(', '); ?>
    </span>
        <span class="tags"><?php the_tags(); ?></span>
      </div>
      <!-- end postmeta -->
    </article>
    <!-- end post -->

    <section class="pagination">
      <?php 
      previous_post_link( '%link', '&larr; %title' );
      next_post_link( '%link', '%title &rarr;' );      
      ?>
    </section>

     
    <?php comments_template(); //display comment list and form ?>


	<?php 
		}//end while
	}else{ ?>

		<div class="noposts">Sorry, no posts to show</div>

	<?php 
	} //end of The Loop 
	?>


  </main>
  <!-- end #content -->

<?php get_sidebar(); //require sidebar.php ?> 


<?php get_footer();  //requires footer.php ?>