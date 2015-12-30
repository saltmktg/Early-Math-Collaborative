<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package EMC
 * @since 1.0
 */

get_header(); ?>

	<div class="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops!', 'emc' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'That page cannot be found, or you do not have access to view it. Please try searching another way or, if you are a project participant, try logging in.', 'emc' ); ?></p>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>