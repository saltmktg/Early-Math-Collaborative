<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package EMC
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
	<header class="entry-header">
		<?php the_post_thumbnail( 'emc-featured' ); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'emc' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
