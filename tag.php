<?php get_header(); ?>

<div class="wrapper">

  <div class="content">
    <div class="main-title">
      <h1>Blog Posts: <?php single_tag_title(); ?></h1>
    </div>
    <?php get_template_part( 'loop', 'tag' ); ?>
  </div> <!-- /.content -->


</div>

<?php get_footer(); ?>