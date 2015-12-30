<?php
/**
 * The Template for displaying all single posts.
 *
 * @package EMC
 * @since 1.0
 */

get_header(); ?>

		<div class="primary" class="site-content">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'components/content', 'conference' ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>