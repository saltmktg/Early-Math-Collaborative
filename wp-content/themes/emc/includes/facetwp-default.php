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