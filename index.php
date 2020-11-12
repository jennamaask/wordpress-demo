<?php //index.php is the last resort template, if no other templates match ?>
<?php get_header(); ?>

<div class="wrapper">

      <?php $blog_title = get_the_title( get_option('page_for_posts', true) );
            $blog_content = get_post_field( 'post_content', get_option( 'page_for_posts' ) );?>
      <div class="main-title">
        <h1><?php echo $blog_title;?></h1>
      </div>
      <?php  echo $blog_content ?>
      
      <?php $categories = get_categories();
        if($categories):?>
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                <select name="cat" id="cat">
                <option value="" selected disabled hidden>Categories</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category ->term_id ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
                </select>
                <input class ="visuallyhidden"type="submit" name="submit" value="Go"/>
            </form>
      <?php endif; ?> 

      <?php get_template_part( 'loop', 'index' );	?>

</div> 

<?php get_footer(); ?>