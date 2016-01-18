<?php
/**
 * Template Name: test ideas
 *
 * This template displays the content full-width, with no sidebar.
 *
 * @package EMC
 * @since 1.0.4
 */

get_header(); ?>

    <section class="primary" class="site-content">
      <div id="content" role="main">

        <header class="page-header">
          Part of the <a href="<?php site_url(); ?>/common-core">Common Core Alignments</a>
          <h1 class="page-title"><?php emc_taxonomy_title(); ?></h1>

          <?php echo emc_taxonomy_description(); ?>

          <?php emc_related_big_ideas(); ?>

        </header>

        <!-- Start FacetWP Facets -->
        <div class="emc-faceted-search emc-toggle-section">
          <div><a class="emc-toggle-link">Filter Results</a></div>
          <div class="emc-toggle-content">
            <p>Select one or many checkboxes to narrow your results</p>

            <div class="emc-fs-column emc-fs-formats-grades">
              <div class="emc-fs-formats emc-fs-section">
                <h6 class="emc-fs-heading">Content Types</h6>
                <?php echo do_shortcode('[facetwp facet="formats"]'); ?>
              </div>

              <div class="emc-fs-grades emc-fs-section">
                <h6 class="emc-fs-heading">Grade Levels</h6>
                <?php echo do_shortcode('[facetwp facet="grade_level"]'); ?>
              </div>
            </div>

            <div class="emc-fs-fmcs emc-fs-section emc-fs-column">
              <h6 class="emc-fs-heading">Foundational Math Concepts</h6>
              <?php echo do_shortcode('[facetwp facet="found"]'); ?>
            </div>

            <div class="emc-fs-ccas emc-fs-section emc-fs-column">
              <h6 class="emc-fs-heading">Common Core Alignment</h6>
              <?php echo do_shortcode('[facetwp facet="core"]'); ?>
            </div>

            <div class="emc-fs-additional-content">
              <?php echo do_shortcode('[browse_by_series]'); ?>
            </div><!-- .emc-fs-additional-content -->
          
          </div><!-- /.emc-toggle-content -->
        </div><!-- /.emc-faceted-search -->
        <!-- End FacetWP Facets -->

        <?php if ( have_posts() ) : ?>

          <?php /* Start the Loop */ ?>
          <div class="facetwp-template"><!-- Code needed to display FacetWP results -->
            <?php while ( have_posts() ) : the_post(); ?>

              <?php get_template_part( 'content', emc_get_post_format() ); ?>

            <?php endwhile; ?>
            <?php echo facetwp_display( 'pager' );?>
          </div><!-- .facetwp-template -->

        <?php else : ?>

          <?php get_template_part( 'no-results', 'archive' ); ?>

        <?php endif; ?>

      </div><!-- #content -->
    </section><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>