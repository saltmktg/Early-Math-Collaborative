<?php
/**
 * @package EMC
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
	<header class="entry-header">
		<span class="emc-single-series">
			<?php esc_html_e( 'Series: ', 'emc' ); ?>
			<?php echo emc_get_the_series(); ?>
		</span>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php emc_display_post_meta( get_the_ID() ); ?>
			<?php emc_sharing_display(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		if ( has_term( 'video', 'emc_content_format' ) ) {
			emc_video();
		} elseif ( has_term( 'link', 'emc_content_format' ) ) {
			emc_the_link_excerpt();
		} else {
			the_post_thumbnail( 'emc-featured' );
		}
		?>

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'emc' ) . '</span>', 'after' => '</div>' ) ); ?>

		<?php if ( has_term( 'download', 'emc_content_format' ) ) emc_download(); ?>

		<?php emc_why_is_this_important(); ?>

		<?php
		if ( function_exists( 'emc_register_post_types' ) ) {
			emc_single_big_ideas();
			emc_single_ccas( get_the_ID() );
			emc_single_fmcs( get_the_ID() );
		}
		?>

		<?php
		if ( has_term( 'discussion', 'emc_content_format' ) ) :
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) {
				comments_template( '', true );
			} elseif ( ! comments_open() ) { ?>
				<p class="nocomments"><?php _e( 'Comments are closed.', 'debut' ); ?></p>
			<?php } 
		endif;
		?>

	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php emc_single_footer_meta(); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

<div class="emc-single-widgets widget-area" role="complementary">
	<?php dynamic_sidebar( 'single' ); ?>
</div>
