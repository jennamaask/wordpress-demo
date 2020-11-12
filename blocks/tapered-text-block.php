<div class="tapered-block <?php echo $block['className'] ?>">

    <?php $title = get_field('title');
            $main_text = get_field('main_content'); 
            if($title):?>
            <h2><?php echo $title; ?></h2>
            <?php endif; 
            if($main_text):
                echo $main_text;
            endif;
            ?>
</div>