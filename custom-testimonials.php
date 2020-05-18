<?php 
/*
Template Name: Testimonials List
*/
get_header(); //requires  header.php ?>

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
    //get a random set of 5 testimonials
    $testimonials = new WP_Query( array(
        'post_type' => 'testimonial',
        'posts_per_page' => 5,
        'orderby'        => 'rand',
    ) ); 

    if( $testimonials->have_posts() ){ ?>
    <div class="testimonials">
        
        <?php 
        while( $testimonials->have_posts() ){ 
            $testimonials->the_post();
        ?>

        <blockquote>
           <?php the_content(); ?>

           <cite><?php the_title(); ?></cite>
        </blockquote>

        <?php } //end while ?>

    </div>
    <?php } //end testimonials loop  ?>



  </main>
  <!-- end #content -->

<?php get_sidebar('page'); //include sidebar-page.php ?>

<?php get_footer();  //requires footer.php ?>