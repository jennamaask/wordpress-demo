<!-- Our query for team members -->
<div class="team-members <?php echo $block['className'] ?>">

    <h2>Our Team</h2>
    <?php
    // leadership team query
    $leadership_query = new WP_Query(
        array(
            'post_type' => 'team_members',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'team', // what taxonomy are we querying by?
                    'field' => 'slug', // what field is the query? (other options are the term_id or name)
                    'terms'    => 'leadership', // what specific term are we querying by?
                ))
        )
    );
    // The Loop for leadership
    if ( $leadership_query->have_posts() ) { ?>
        <div class="team-section">
            <h3>Leadership</h3>
            <div class="row">
            <?php while ( $leadership_query->have_posts() ) { 
                $leadership_query->the_post(); 
                $image = get_field('close-up-image', get_the_ID());?>

                <?php $job_title = get_field('job_title', get_the_ID()); ?>
                
                <div class="team-member">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_get_attachment_image($image, 'square', false, array('class' => 'featured-image')); ?>
                        <h4><?php the_title(); ?></h4>
                        <p><?php echo $job_title; ?></p>
                    </a>
                </div>

            <?php }
            
            /* Restore original Post Data */
            wp_reset_postdata();
        } else { ?>
            <!-- no posts found -->
            <p>There are no leaders</p>
            
        <?php }  ?>

            </div>
        
        </div>
    <?php
    // developers team query
    $developers_query = new WP_Query(
        array(
            'post_type' => 'team_members',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'team', // what taxonomy are we querying by?
                    'field' => 'slug', // what field is the query? (other options are the term_id or name)
                    'terms'    => 'development', // what specific term slug are we querying by?
                ))
        )
    );
    // The Loop for developers team
    if ( $developers_query->have_posts() ) { ?>
    <div class="team-section">
        <h3>Development Team</h3>
        <div class="row">
            <?php while ( $developers_query->have_posts() ) { 
                $developers_query->the_post(); 
                $image = get_field('close-up-image', get_the_ID());?>

                <div class="team-member">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_get_attachment_image($image, 'square', false, array('class' => 'featured-image')); ?>
                        <h4><?php the_title(); ?></h4>
                    </a>
                </div>

            <?php }
            
            /* Restore original Post Data */
            wp_reset_postdata();
        } else { ?>
            <!-- no posts found -->
            <p>There are no developers</p>
    <?php } ?>

        </div>
    
    </div>
    <?php

    // design team query
    $design_query = new WP_Query(
        array(
            'post_type' => 'team_members',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'team', // what taxonomy are we querying by?
                    'field' => 'slug', // what field is the query? (other options are the term_id or name)
                    'terms'    => 'design', // what specific term slug are we querying by?
                ))
        )
    );
    // The Loop for design team
    if ( $design_query->have_posts() ) { ?>
    <div class="team-section">
        <h3>Design Team</h3>
        <div class="row">
            <?php while ( $design_query->have_posts() ) { 
                $design_query->the_post();
                $image = get_field('close-up-image', get_the_ID());
                ?>

                <div class="team-member">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo wp_get_attachment_image($image, 'square', false, array('class' => 'featured-image')); ?>
                        <h4><?php the_title(); ?></h4>
                        <h2><?php  ?></h2>
                    </a>
                </div>

            <?php }
            
            /* Restore original Post Data */
            wp_reset_postdata();
        } else { ?>
            <!-- no posts found -->
            <p>There are no designers</p>
        
    <?php }  ?>
        </div>
    
    </div>
</div>