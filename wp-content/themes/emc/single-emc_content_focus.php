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

			<?php // The main loop, for the FMC description and Big Ideas
			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
					<header class="entry-header">
						<?php emc_the_post_type_link( 'emc_content_focus' ); ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">

						<?php the_post_thumbnail( 'emc-featured' ); ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'emc' ) . '</span>', 'after' => '</div>' ) ); ?>

						<?php emc_related_posts_list( 'big_ideas_to_content_foci', 'Related Big Ideas' ); ?>

					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>

			<?php // List FMC "archive"
			$related = new WP_Query( array(
			  	'connected_type' => 'content_foci_to_posts',
			  	'connected_items' => get_queried_object(),
			  	'nopaging' => true,
			) );

			if ( $related->have_posts() ) : ?>

				<h2 class="emc-section-heading-posts"><?php esc_html_e( 'Related Posts', 'emc' ); ?></h2>

				<?php if ( function_exists( 'emc_faceted_search' ) ) emc_faceted_search(); ?>

				<?php // Start the Loop
				while ( $related->have_posts() ) : $related->the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-connected-post' ); ?>>
						<header class="entry-header">
							
							<div class="emc-format">
								<?php echo emc_get_content_icon(); ?>
								<?php comments_number( '' ); ?>
							</div><!-- .emc-format -->
							
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'emc' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

							<div class="entry-meta">
								<?php emc_display_post_meta( get_the_ID() ); ?>
							</div><!-- .entry-meta -->

						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php emc_the_post_thumbnail(); ?>
							<?php the_excerpt(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'emc' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->

						<footer class="entry-meta">
							<?php emc_the_fmcs(); ?>
							<?php emc_the_ccas(); ?>
							<?php emc_the_grade_levels(); ?>
						</footer><!-- #entry-meta -->
					</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; ?>

				<?php //emc_content_nav( 'nav-below' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>