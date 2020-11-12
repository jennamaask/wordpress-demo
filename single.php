<?php get_header(); ?>
<div class="wrapper">
  <div class="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="title">
          <div class="entry-image">
            <?php the_post_thumbnail("")?>
          </div>
          <?php the_category()?>
          <h1 class="entry-title"><?php the_title(); ?></h1>
  
          <div class="entry-meta">
            <p>By <?php echo get_the_author_posts_link() ?></p>
          </div><!-- .entry-meta -->
        </div>

        <div class="entry-content">
          <?php the_content(); ?>
          <?php wp_link_pages(array(
            'before' => '<div class="page-link"> Pages: ',
            'after' => '</div>'
          )); ?>
        </div><!-- .entry-content -->



    <?php endwhile; // end of the loop. ?>

  </div> <!-- /.content -->


</div>

<?php get_footer(); ?>