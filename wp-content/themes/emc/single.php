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

				<?php get_template_part( 'content', 'single' ); ?>

				<?php emc_content_nav( 'nav-below' ); ?>

				<?php
				if ( ! has_term( 'discussion', 'emc_content_format' ) ) :
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template( '', true );
					} elseif ( ! comments_open() ) { ?>
						<p class="nocomments"><?php _e( 'Comments are closed.', 'debut' ); ?></p>
					<?php } 
				endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>