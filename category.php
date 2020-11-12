<?php get_header(); ?>

<div class="wrapper">
  <div class="content">
    <div class="main-title">
      <h1>Blog Posts: <?php single_cat_title(); ?></h1>
    </div>
    <?php
      $category_description = category_description();
      if ( ! empty( $category_description ) )
        echo '' . $category_description . '';
        get_template_part( 'loop', 'category' );
      ?>

  </div> <!-- /.content -->


</div>

<?php get_footer(); ?>