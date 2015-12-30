<?php
/**
 * @package EMC
 * @since 1.0
 */
?>

<article class="post-main" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<div class="emc-format">
			<?php
			if ( emc_get_content_icon() ) {
				echo emc_get_content_icon();
				//comments_number( '' );
			}
			?>
		</div><!-- .emc-format -->

		<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
			<div class="feat-post-img">

				<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
				} else { ?>
				<img width="640" height="360" src='http://earlymath.erikson.edu/wp-content/themes/emc/img/bg-erikson-generic.jpg' alt="<?php the_title(); ?>" />
				<?php } ?>

				<!--<?php emc_the_post_thumbnail(); ?>-->
			  <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'emc' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</div>
		</a>
		
		<div class="entry-meta">
		  <div class="entry-bar">
		    <span class="entry-meta-date">
		    	<?php echo get_the_date(); ?>
		    </span>
		    <span class="entry-meta-series">
			  	<?php esc_html_e( 'Series: ', 'emc' ); ?>
			  	<?php echo emc_get_the_series(); ?>
				</span> 
		  </div>
			<!--<?php emc_display_post_meta( get_the_ID() ); ?>-->
			
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">
	  <div class="entry-content-inner">
			<a class="link-entry-content-inner" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
				<?php the_excerpt(); ?>
			</a>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'emc' ), 'after' => '</div>' ) ); ?>			
		</div>
	</div><!-- .entry-content -->

	<?php if ( function_exists( 'emc_register_post_types' ) ) : ?>
		<!--<footer class="entry-meta">-->
		<div class="entry-info">
		  <a class="more-link" href="<?php the_permalink(); ?>">Continue Reading &raquo;</a>
			<div class="entry-info-inner">
				<span class="hover-tipso-tooltip show-hide-tipso info-icon" data-tipso="This is a manual TIPSO!">i</span>			
				<?php emc_the_fmcs(); ?>
				<?php emc_the_ccas(); ?>
				<?php emc_the_grade_levels(); ?>
				<?php the_tags( '<div class="meta-bullet emc-tag-bullet"></div>&nbsp;<span class="tag-text">Tags:</span> ',' <span class="tag-slash">/</span> ' ); ?>
			</div>

		</div>
		<!--</footer> #entry-meta -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
