<div class="tabbed-content <?php echo $block['className'] ?>">
    <?php 
    // var_dump($block['data']);
        if( have_rows('tabs') ):
            ?>
            <ul class="tabs" role="tablist">
            <?php
            // loop through the rows of data
            while ( have_rows('tabs') ) : the_row();

                ?>
                <li tabindex="0" aria-selected="<?php echo (get_row_index() == 1) ? "true": "false" ?>" role="tab"class="tab" aria-controls="<?php echo get_row_index()?>">
                <?php 
                    the_sub_field('title');
                ?>
                </li>
                <?php 



            endwhile;?>
            </ul>
       <?php endif; 
        if( have_rows('tabs') ):?>
            <div class="tabs-content">
            <?php
            // loop through the rows of data
            while ( have_rows('tabs') ) : the_row();?>
                <div role="tabpanel" aria-expanded="<?php echo (get_row_index() == 1) ? "true": "false" ?>" class="tab-content" id="<?php echo get_row_index()?>">
                <?php 
                    the_sub_field('main_content');
                ?>
                </div>
                <?php 
            endwhile;?>
            </div>
            <?php
        endif; ?>



</div>