<?php get_header(); //requires header.php ?>

  <main class="content">
   
  	<?php //The Loop
  	if( have_posts() ){
  		while( have_posts() ){
  			the_post();
  	 ?>
    <article <?php post_class(); ?>>
      <h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

      <?php 
      //the featured image (activate in functions.php first)
      the_post_thumbnail( 'thumbnail' ); ?>

      <div class="entry-content">
       <?php
       // excerpts are short previews of the content 
       //the_content(); 
       the_excerpt(); ?>
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

<?php get_sidebar(); //require sidebar.php ?> 


<?php get_footer();  //requires footer.php ?>