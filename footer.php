</main>
<footer>
<div class="wrapper">
    <div class="left">
        <h3><?php the_field('logo_text', 'options') ?></h3>
    </div>
    <div class="right">
    <p class="social-text"><?php the_field('social_icons_text', 'options')?></p>
    <?php wp_nav_menu( array(
        'theme_location' => 'footer',
        'container_class' => 'footer-menu'
      )); ?>
    </div>
</div>
</footer>


<?php wp_footer(); ?>
</body>
</html>