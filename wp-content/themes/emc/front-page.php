<?php
/**
 * The template file for the front page (http://earlymath.erikson.edu).
 *
 * @package EMC
 * @since 1.0
 */

get_header(); ?>

		<div class="primary" class="site-content">
			<div id="content" role="main">

			<?php
			$args = array(
				'post_type' => 'any',
				'tag' => 'home',
				'nopaging' => true,
			);
			$home = new WP_Query( $args );


			if ( $home->have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( $home->have_posts() ) : $home->the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', emc_get_post_format() );
					?>

				<?php endwhile; ?>

				<a class="emc-button emc-ideas-button" href="<?php echo home_url(); ?>/ideas/"><?php esc_html_e( 'View all ideas &rarr;', 'emc' ); ?></a>

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>