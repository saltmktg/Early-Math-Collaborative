<?php
/**
 * Template Name: Login
 *
 * This template displays the 'Project Login' form
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

        <div class="login-wrap">
          <?php the_widget( 'emc_widgets_login'); ?> 
        </div>

        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'content', 'page' ); ?>

          <?php //comments_template( '', true ); ?>

        <?php endwhile; // end of the loop. ?>

      </div><!-- #content -->
    </div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>