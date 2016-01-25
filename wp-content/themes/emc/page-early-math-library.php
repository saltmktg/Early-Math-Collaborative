<?php
/**
 * Template Name: Early Math Library
 *
 * This template displays the EMC modules and library
 *
 * @package EMC
 * @since 1.0
 */

get_header(); ?>

    <div class="primary-module page-early-math-library" class="site-content">
      <div id="content" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

          <?php get_template_part( 'components/content', 'early-math-library' ); ?>

          <?php //comments_template( '', true ); ?>

        <?php endwhile; // end of the loop. ?>

        <div class="mod-title-bar">
          <div class="mod-title-bar-heading">
            Modules
          </div>
          <div class="mod-view-all">
            <a href="#">View All &raquo;</a>
          </div>
        </div>

        <!-- Display Modules -->
        <div class="feat-modules-wrap">
          <?php
          $args = array( 'post_type' => 'Module', 'posts_per_page' => 4 );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); ?>
              <div class="content-column one_fourth">
                <a href="<?php echo get_permalink(); ?>">
                  <div class="feat-mod-block">
                    <div class="feat-mod-img">
                      <img src="<?php the_field('main_image') ?>">
                    </div>
                    <a class="feat-mod-title-link" href="<?php echo get_permalink(); ?>">
                      <div class="feat-mod-title">
                        <?php the_title(); ?>
                      </div> 
                    </a>
                    <div class="feat-mod-blurb">
                      <?php the_field('module_blurb'); ?> 
                    </div> 
                  </div><!-- .feat-mod-block -->
                </a>
              </div><!-- .content-column -->      
          <?php endwhile; ?>
        </div><!-- .feat-modules-wrap -->

        <!-- Idea Library Section -->
        <div class="mod-lib-block">
          <h1 class="idea-lib-title-alt">Idea Library</h1>
          <div class="mod-lib-col-1">          
            <div class="mod-lib-search">
              <?php echo do_shortcode('[facetwp facet="search"]'); ?>
            </div>
            <?php echo do_shortcode('[facetwp template="custom"]'); ?>
            <?php echo do_shortcode('[facetwp pager="true"]'); ?>      
          </div><!-- .mod-lib-col-1 -->
          <div class="mod-lib-col-2">
            <?php get_sidebar('module-ideas'); ?>
          </div><!-- .mod-lib-col-2 -->
        </div><!-- .mod-lib-block -->

      </div><!-- #content -->
    </div><!-- .primary .site-content -->

<?php get_footer(); ?>