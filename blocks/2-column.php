<div class="<?php echo $block['className'] ?> two-col-image-text">
    <?php if( have_rows('left_column') ): ?>
        <div class="left">
        <?php while( have_rows('left_column') ): the_row(); ?>
             <?php if( get_row_layout() == 'text' ): 
                $title = get_sub_field('title');
                $main_text = get_sub_field('main_text');
                $text_link = get_sub_field('link');?>
                <?php if($title) :?>
                    <h2><?php echo $title; ?></h2>
                <?php 
                endif;
                if($main_text) :
                    echo $main_text;
                endif;
                
                if($text_link):
                ?>
                    <a class="button" href="<?php echo $text_link['url']; ?>" target="<?php echo $text_link['target']; ?>"><?php  echo $text_link['title']; ?></a>
                <?php endif; ?>
            <?php elseif( get_row_layout() == 'image' ): 
                $image = get_sub_field('image');
                ?>
                <figure>
                    <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                </figure>
            <?php endif; ?>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if( have_rows('right_column') ): ?>
        <div class="right">
        <?php while( have_rows('right_column') ): the_row(); ?>
            <?php if( get_row_layout() == 'text' ): 
                $title = get_sub_field('title');
                $main_text = get_sub_field('main_text');
                $text_link = get_sub_field('link');?>
                <?php if($title) :?>
                    <h2><?php echo $title; ?></h2>
                <?php 
                endif;
                if($main_text) :
                    echo $main_text;
                endif;
                
                if($text_link):
                ?>
                    <a class="button" href="<?php echo $text_link['url']; ?>" target="<?php echo $text_link['target']; ?>"><?php  echo $text_link['title']; ?></a>
                <?php endif; ?>
            <?php elseif( get_row_layout() == 'image' ): 
                $image = get_sub_field('image');
                ?>
                <figure>
                    <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                </figure>
            <?php endif; ?>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>

</div>