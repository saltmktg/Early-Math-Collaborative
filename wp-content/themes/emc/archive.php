<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EMC
 * @since 1.0
 */

get_header(); ?>

		<section class="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							if ( is_category() ) {
								printf( __( 'Category: %s', 'emc' ), '<span>' . single_cat_title( '', false ) . '</span>' );

							} elseif ( is_tag() ) {
								printf( __( 'Topic: %s', 'emc' ), '<span>' . single_tag_title( '', false ) . '</span>' );

							} elseif ( is_author() ) {
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								*/
								the_post();
								printf( __( 'Author: %s', 'emc' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();

							} elseif ( is_day() ) {
								printf( __( 'Daily Archives: %s', 'emc' ), '<span>' . get_the_date() . '</span>' );

							} elseif ( is_month() ) {
								printf( __( 'Monthly Archives: %s', 'emc' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							} elseif ( is_year() ) {
								printf( __( 'Yearly Archives: %s', 'emc' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							} else {
								_e( 'Archives', 'emc' );

							}
						?>
					</h1>
					<?php echo term_description(); ?>
				</header>

				<?php rewind_posts(); ?>
				
				<!-- Start 'FacetWP' Faceted Search -->
        <div class="emc-faceted-search emc-toggle-section emc-toggle-closed">
            <a class="emc-toggle-link">Filter Results</a>
            <div class="emc-toggle-content">
            <p>Select one or many checkboxes to narrow your results</p>

            <div class="emc-fs-column emc-fs-formats-grades">
                <div class="emc-fs-formats emc-fs-section">
                    <h6 class="emc-fs-heading">Content Types</h6>
                    <?php echo facetwp_display( 'facet', 'formats' ); ?>
                </div>
                <div class="emc-fs-grades emc-fs-section">
                    <h6 class="emc-fs-heading">Grade Levels</h6>
                    <?php echo facetwp_display( 'facet', 'grade_level' ); ?>
                </div>
            </div>  

            <div class="emc-fs-fmcs emc-fs-section emc-fs-column">
                <h6 class="emc-fs-heading">Foundational Math Concepts</h6>
                <?php echo facetwp_display( 'facet', 'found' ); ?>
            </div>

            <div class="emc-fs-ccas emc-fs-section emc-fs-column">
                <h6 class="emc-fs-heading">Common Core Alignment</h6>
                <?php echo facetwp_display( 'facet', 'core' ); ?>
            </div>

            <?php echo do_shortcode('[browse_by_series]');?>
          </div><!-- /.emc-toggle-content -->
        </div><!-- /.emc-faceted-search .emc-toggle-section .emc-toggle-open -->   

        <?php echo facetwp_display( 'template', 'default' ); ?>
        <?php echo facetwp_display( 'pager' ); ?>  
        <!-- End 'FacetWP' Faceted Search -->
				 

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php emc_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>