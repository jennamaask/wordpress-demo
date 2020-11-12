<?php get_header();  ?>

<div class="wrapper">
    <?php // Start the loop ?>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <div class="main-title">
        <h1><?php the_title(); ?></h1>
      </div>
      <?php the_content(); ?>

    <?php endwhile; // end the loop?>


</div>

<?php get_footer(); ?>