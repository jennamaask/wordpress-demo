<?php get_header(); ?>
<div class="wrapper">

        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="intro-fields">
                <div class="entry-image">
                    <?php echo wp_get_attachment_image(
                        get_post_thumbnail_id($employee->ID),
                    'large'
                );?>
                </div>
                <h1><?php the_title(); ?></h1>
                <h3><?php the_field('job_title' );?></h3>
                <p class="bold">Additional Information:</p>            
                <p>Favourite Pizza Topping: <span class="pink"><?php the_field('favourite_pizza_topping'); ?></span></p>
                <p>Favourite Band: <span class="pink"><?php the_field('favourite_band'); ?></span></p>
                <p>Favourite Project: <span class="pink"><?php the_field('favourite_project'); ?></span></p>
            </div>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        
        <?php endwhile; ?>


</div>


<?php get_footer(); ?>