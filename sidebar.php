<aside class="sidebar">

  <?php //show widgets if they exist
  if( ! dynamic_sidebar('blog-sidebar') ){
  ?>
    
    <section id="categories" class="widget">
      <h3 class="widget-title"> Categories </h3>
      <ul>
        <?php 
        //show the most popular 10 categories
        wp_list_categories( array(
          'title_li' => '',
          'show_count'  => true,
          'orderby' => 'count',
          'order' => 'DESC',
          'number' => 10
        ) ); 
        ?>
      </ul>
    </section>


    <section id="archives" class="widget">
      <h3 class="widget-title"> Archives </h3>
      <ul>
        <?php 
        wp_get_archives( array(
          'type' => 'yearly',
          'show_post_count' => true,
        ) ); 
        ?>
      </ul>
    </section>



    <section id="tags" class="widget">
      <h3 class="widget-title"> Tags </h3>

      <?php wp_tag_cloud( array(
        'smallest'  => 1,
        'largest'   => 1,
        'unit'      => 'em',
        'number' => 30,
        'separator' => ', ',
      ) ); ?>

    </section>



    <section id="meta" class="widget">
      <h3 class="widget-title"> Meta </h3>
      <ul>
      
        <?php wp_register(); ?>

        <li>
          <?php wp_loginout(); ?>
        </li>
      </ul>
    </section>

  <?php } //end if widgets ?>
</aside>
<!-- end #sidebar -->