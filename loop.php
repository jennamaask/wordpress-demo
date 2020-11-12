<?php // If there are no posts to display, such as an empty archive page ?>

<div class="blog-posts">

<?php if ( ! have_posts() ) : ?>

	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<section class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		</section><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; // end if there are no posts ?>

<?php // if there are posts, Start the Loop. ?>

<?php while ( have_posts() ) : the_post(); ?>
		<a href="<?php the_permalink() ?>">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_post_thumbnail("medium")?>
				<div class="lower">
					<h2 class="entry-title">
						<?php the_title(); ?>
					</h2>
					<p class="author-date"><?php the_author(); ?> - <?php echo get_the_date("d/m/y")?></p>
					<?php the_excerpt();?>
					<div class="readmore">
						<p class="">Read More</p>
					</div>
				</div>
			</article><!-- #post-## -->
	</a>
<?php endwhile; // End the loop. Whew. ?>




<?php pagination_bar(); ?>


</div>

