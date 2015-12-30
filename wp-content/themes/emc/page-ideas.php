<?php
/**
 * Template Name: Ideas
 *
 * This template displays the content with the Ideas sidebar on the left.
 *
 * @package EMC
 * @since 1.0.4
 */

if (function_exists('sharing_display')) {
    sharing_display();
}

get_header(); ?>

<?php get_sidebar('ideas'); ?>

    <div class="primary ideas-page" class="site-content">
      <div id="content" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'content', 'page' ); ?>

          <?php //comments_template( '', true ); ?>

        <?php endwhile; // end of the loop. ?>

      </div><!-- #content -->
    </div><!-- .primary .site-content -->

<?php get_footer(); ?>