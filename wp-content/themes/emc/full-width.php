<?php
/**
 * Template Name: Full Width
 *
 * This template displays the content full-width, with no sidebar.
 *
 * @package EMC
 * @since 1.0.4
 */

get_header(); ?>

		<div class="primary site-content full-width">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

										

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_footer(); ?>
