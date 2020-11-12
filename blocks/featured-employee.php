<?php $employee = get_field('featured_employee')?>
   <section class="featured-employee two-col-image-text <?php echo $block['className'] ?>">
        <div class="left">
            <?php echo wp_get_attachment_image(
                get_post_thumbnail_id($employee->ID),
                'square-large'
            );?>
        </div>
        <div class="right">
            <?php if($employee->post_title): ?>
                <h3><?php the_field('section_title'); ?></h3>

                <a href="<?php echo $employee->guid ?>">
                <h2><?php echo $employee->post_title; ?></h2>
                </a>
            <?php endif; ?>
            <p><?php echo wp_trim_words($employee->post_content, 100); ?></p>
        </div>
    </section>