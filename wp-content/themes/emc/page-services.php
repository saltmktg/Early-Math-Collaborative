<?php
/**
 * Template Name: Services
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

					<?php get_template_part( 'content', 'page' ); ?>

					<?php if(get_field('services')){ ?>
					<div class="urls">
					<div class="jumpto">
						JUMP TO:
					</div>
						<?php while(has_sub_field('services')){ ?>
							<a href="#<?php the_sub_field('unique_id'); ?>"><?php the_sub_field('s_title'); ?></a>
						<?php }// end of the loop. ?>
					</div>
						<?php while(has_sub_field('services')){ ?>
			 			<div id="<?php the_sub_field('unique_id'); ?>" class="service">
							<hr>
							<h2><?php the_sub_field('s_title'); ?></h2>
							<?php if (get_sub_field('service_page_url')) {?>
								(<a href="<?php the_sub_field('service_page_url'); ?>"><?php the_field('visit_this_services'); ?> &rarr;</a>)
							<?php } ?>
							<div class="row">
								<div class="excerpt">
									<?php the_sub_field('short_description'); ?>
								</div>
								<img class="servthumb" src="<?php the_sub_field('s_image'); ?>" alt="">								
							</div>
							<?php if(get_sub_field('project_examples')){ ?>
							
								<div class="projexample">
									<?php the_field('examples_ribbon_text'); ?> 
									<?php while(has_sub_field('project_examples')){ ?>
										<a href="<?php the_sub_field('example_url'); ?>"><?php the_sub_field('example_name'); ?></a>
									<?php } ?>
								</div>

							<?php } ?>

								<?php the_sub_field('s_content'); ?>
								<?php if (get_sub_field('service_page_url')) {?>
								<div class="learnmore">
									LEARN MORE: <a href="<?php the_sub_field('unique_id'); ?>"><?php the_sub_field('s_title'); ?></a>
								<div class="arrow-right"></div>
								</div>
								<?php } ?>
						</div> 
						<?php } ?>
					<?php } ?>

					<?php //comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>