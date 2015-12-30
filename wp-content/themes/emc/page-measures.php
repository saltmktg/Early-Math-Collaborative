<?php
/**
 * Template Name: Measures list
 *
 * This template displays the content full-width, with no sidebar.
 *
 * @package EMC
 * @since 1.0.4
 */

if (function_exists('sharing_display')) {
    sharing_display();
}

get_header(); ?>

		<div class="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'components/content', 'page' ); ?>

					<?php //comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php 
				    query_posts(array( 
				        'post_type' => 'measures',
				        'showposts' => -1 
				    ) );  
				?>
				<?php while (have_posts()) : the_post(); ?>
			        <article class="measure">
				        <h3><?php the_title(); ?></h3>
				        <div class="citation-excerpt"><?php echo get_the_content(); ?></div>
				        <a href="<?php the_permalink(); ?>"><i class="fa fa-caret-right"></i> Research associated with this measure</a>
					 		</article>
				<?php endwhile;?>

			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>