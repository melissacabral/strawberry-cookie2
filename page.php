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


  </main>
  <!-- end #content -->

<?php get_sidebar('page'); //include sidebar-page.php ?>

<?php get_footer();  //requires footer.php ?>