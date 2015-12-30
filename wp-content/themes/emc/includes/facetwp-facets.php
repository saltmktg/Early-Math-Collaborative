<div class="emc-faceted-search emc-toggle-section">
  <p><a class="emc-toggle-link">Filter Results</a></p>
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