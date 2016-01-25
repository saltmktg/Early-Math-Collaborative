<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package EMC
 * @since 1.0
 */
?>
    <div class="widget-area" role="complementary">
      <?php do_action( 'before_sidebar' ); ?>
      <?php if ( ! dynamic_sidebar( 'ideas-page-sidebar' ) ) : ?>

        <aside id="search" class="widget widget_search">
          <?php get_search_form(); ?>
        </aside>

        <aside id="archives" class="widget">
          <h1 class="widget-title"><?php _e( 'Archives', 'emc' ); ?></h1>
          <ul>
            <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
          </ul>
        </aside>

        <aside id="meta" class="widget">
          <h1 class="widget-title"><?php _e( 'Meta', 'emc' ); ?></h1>
          <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
          </ul>
        </aside>

      <?php endif; // end sidebar widget area ?>
    </div><!-- .secondary .widget-area -->
