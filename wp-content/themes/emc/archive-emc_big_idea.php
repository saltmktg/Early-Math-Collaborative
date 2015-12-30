<?php
/**
 * The template for displaying taxonomy archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EMC
 * @since 1.0
 */

get_header(); ?>

		<section class="primary" class="site-content">
			<div id="content" role="main">

				<header class="page-header">
					<h1 class="page-title">
						<?php emc_the_cpt_title(); ?>
					</h1>
					<?php echo emc_the_cpt_description(); ?>
				</header>

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-big-idea-post' ); ?>>
							<header class="entry-header">
								
								<?php echo emc_get_cpt_icon(); ?>
								
								<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'emc' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php emc_the_post_thumbnail(); ?>
								<?php the_excerpt(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'emc' ), 'after' => '</div>' ) ); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-<?php the_ID(); ?> -->

					<?php endwhile; ?>

					<?php emc_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'archive' ); ?>

				<?php endif; ?>

			</div><!-- #content -->
		</section><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>