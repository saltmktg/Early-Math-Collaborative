<?php
/**
 * @package EMC
 * @since 1.0
 */
?>

<div class="crumbs">
  <ul>
    <li><a href="<?php bloginfo('url'); ?>">Home</a><span class="crumb-arrow">&raquo;</span></li>
    <li><a href="<?php bloginfo('url'); ?>/early-math-library">Early Math Library</a><span class="crumb-arrow">&raquo;</span></li>
    <li><?php the_title();?></li>
  </ul>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
  <!--<header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>    
  </header>-->  

  <div class="mod-header-title">
    <h1 class="fl-left"><?php the_title();?></h1>
    <div class="fl-right mod-title-bar-nav">
      <div class="cp-btn-wrap inline-block">
        <a class="btn btn-gray btn-small">
          Coaching Portal
        </a>
      </div>
      <div class="mod-login-links inline-block">
        <a href="#">Login</a> / <a href="#">Logout</a>
      </div>
    </div>
  </div>

  <div class="mod-intro-block">
    <?php 
      // Main Image
      $image = get_field('main_image');
      if( !empty($image) ): ?>
      <div class="mod-img-wrap">
        <img src="<?php the_field('main_image'); ?>" alt="<?php echo $image['alt']; ?>" />
      </div>
    <?php endif; ?>

    <div class="mod-intro-content bot-mar-0">
      <h2><?php the_field('intro_title'); ?></h2>
      <?php if( get_field('intro_audio') ): ?>
        <div class="audio-intro">
          <audio id="wp_mep_0" src="<?php the_field('intro_audio'); ?>" controls="controls" preload="none"  >
            <object width="400" height="30" type="application/x-shockwave-flash" data="http://earlymath.erikson.edu/wp-content/plugins/media-element-html5-video-and-audio-player/mediaelement/flashmediaelement.swf">
              <param name="movie" value="http://earlymath.erikson.edu/wp-content/plugins/media-element-html5-video-and-audio-player/mediaelement/flashmediaelement.swf" />
              <param name="flashvars" value="controls=true&amp;file=<?php the_field('intro_audio'); ?>" />     
            </object>   
          </audio>
          <script type="text/javascript">
          jQuery(document).ready(function(jQuery) {
            jQuery('#wp_mep_0').mediaelementplayer({
              m:1    
              ,features: ['playpause','current','progress','duration','volume','tracks','fullscreen']
              ,audioWidth:400,audioHeight:30
            });
          });
          </script>
        </div><!-- .audio-intro -->
       <?php endif; ?> 

      <div class="mod-intro-desc"><?php the_field('module_description'); ?></div>
    </div>
  </div><!-- .mod-intro-block -->
 
  <?php if( get_field('download_module') ): ?>
    <div class="mod-download">
      <div class="icon-download">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 72 72" enable-background="new 0 0 72 72" xml:space="preserve">
        <g>
          <polygon id="icon-download" fill="#F6968C" points="59.2,25.6 41.8,25.6 41.8,0 30.3,0 30.3,25.6 12.9,25.6 36,52.3   "/>
          <path id="icon-download" fill="#F6968C" d="M62,45v17H10V45H0v22c0,2.8,2.2,5,5,5h62c2.8,0,5-2.2,5-5V45H62z"/>
        </g>
        </svg>
      </div>
      <a href="<?php the_field('download_module'); ?>">Download Module</a>
    </div><!-- .mod-download -->
  <?php endif; ?>  

  <?php if( get_field('view_presentation_link') ): ?>
    <div class="view-pres-link">
      <div class="icon-presentation">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
          <g id="Layer_1" display="none">
            <g display="inline">
              <polygon id="icon-presentation" fill="#F6968C" points="82.2,35.6 58.1,35.6 58.1,0 42.1,0 42.1,35.6 17.9,35.6 50,72.6     "/>
              <path id="icon-presentation" fill="#F6968C" d="M86.1,62.5v23.6H13.9V62.5H0v30.6c0,3.9,3.1,6.9,6.9,6.9h86.1c3.9,0,6.9-3.1,6.9-6.9V62.5H86.1z"/>
            </g>
          </g>
          <g id="Layer_2">
            <g>
              <path id="icon-presentation" fill="#0095DA" d="M79.5,37.8H40v34.4h39.5V37.8z M74.6,67.2H45V42.7h29.6V67.2z"/>
              <rect id="icon-presentation" x="20.3" y="37.8" fill="#0095DA" width="12.8" height="34.4"/>
              <path id="icon-presentation" fill="#0095DA" d="M5.6,11.7v76.5h88.8V11.7H5.6z M68.6,16.9h18.2v7.1H68.6V16.9z M12.9,16.9h49.3v7.1H12.9L12.9,16.9
                L12.9,16.9z M87,80.9H13V29h74L87,80.9L87,80.9z"/>
            </g>
          </g>
          </svg>
      </div>
      <a target="_blank" href="<?php the_field('view_presentation_link'); ?>">Presentation Mode</a>
    </div>
  <?php endif; ?>

  <div class="mod-section-block accordion">
    <?php if( have_rows('module_section') ): ?>          
      <?php while ( have_rows('module_section') ) : the_row(); ?>
        <div class="accordion-toggle">
          <div class="accordion-arrows">
            <div class="icon-arrow icon-arrow-right"><img src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-arrow-right.svg" alt=""></div>
            <div class="icon-arrow icon-arrow-down icon-visually-hidden"><img src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-arrow-down.svg" alt=""></div>
          </div>
          <div class="accordion-toggle-text">
            <!-- Display custom icon based on section type -->
            <?php 
              if (get_sub_field('section_type', 'option') == 'Text') {
                echo '<div class="mod-section-icon"><img class="mod-icon-text" src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-document.svg"></div>';
              } else if (get_sub_field('section_type', 'option') == 'Video') {
                echo '<div class="mod-section-icon"><img class="mod-icon-video" src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-filmstrip.svg"></div>';
              } else if (get_sub_field('section_type', 'option') == 'Discussion') {
                echo '<div class="mod-section-icon"><img class="mod-icon-discussion" src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-talk-bubbles.svg"></div>';
              } else {
                echo '';
              }
            ?>
            <!-- Locked section -->
            <?php 
              if (get_sub_field('locked', 'option') == 'Yes') {
                echo '<div class="mod-section-icon-lock"><img class="mod-icon-lock" src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-lock.svg"></div>';
              } else {
                echo '';
              }
            ?>
            <?php the_sub_field('section_title'); ?>
            <?php 
              if (get_sub_field('locked', 'option') == 'Yes') {
                echo '[Locked]';
              } else {
                echo '';
              }
            ?>
          </div><!-- .accordion-toggle-text -->
        </div>
        <div class="accordion-content">
          <?php the_sub_field('section_content'); ?>
          <?php if( have_rows('submenu_accordion') ): ?> 
            <div class="submenu-accordion">         
              <?php while ( have_rows('submenu_accordion') ) : the_row(); ?>              
                  <div class="submenu-accordion-toggle">
                    <div class="icon-arrow icon-arrow-right">
                      <div class="icon-arrow-svg">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                           viewBox="0 0 30 43.4" enable-background="new 0 0 30 43.4" xml:space="preserve">
                          <g>
                            <g>
                              <polygon id="icon-arrow-right-submenu" fill="#A3A2A2" points="8.3,0 0,8.3 13.4,21.7 0,35.1 8.3,43.4 30,21.7     "/>
                            </g>
                          </g>
                        </svg>
                      </div>                   
                    </div>
                    <div class="icon-arrow icon-arrow-down icon-visually-hidden"><img src="http://earlymath.erikson.edu/wp-content/themes/emc/img/icon-arrow-down.svg" alt=""></div>
                    <?php the_sub_field('submenu_section_title'); ?>
                  </div>
                  <div class="submenu-accordion-content">
                    <?php the_sub_field('submenu_section_content'); ?>
                  </div>                
              <?php endwhile; ?>
            </div><!-- .submenu-accordion -->
          <?php else : ?>
          <?php endif; ?>
        </div>  
      <?php endwhile; ?>
     <?php else : ?>
    <?php endif; ?>
  </div><!-- .mod-section-block -->

  <!-- Filter Related Ideas by Advanced Custom Field checkbox choices -->
  <?php 
    $acf_data = array(
    'formats' => get_field( 'content_types' ),
    'grade_level' => get_field( 'grade_levels' ), 
    'found' => get_field( 'foundational_math_concepts' ),
    'core' => get_field( 'common_core_alignment' ),   
    );
  ?>

  <!-- This script does the actual Related Ideas filtering -->
  <script>
  // This goes into your template file, below your ACF lookup code
  (function($) {
    $(document).on('facetwp-refresh', function() {
      if (! FWP.loaded) {
        var data = <?php echo json_encode( $acf_data ); ?>;
        $.each(data, function(facet_name, facet_values) {
          FWP.facets[facet_name] = facet_values;
        });
      }
    });
  })(jQuery);
  </script>

  <!-- Idea Library Section -->
  <div class="mod-lib-block">
    <h1 class="idea-lib-title">Related Modules &amp; Ideas</h1>
    <div class="mod-lib-col-2">
      <?php get_sidebar('module-ideas'); ?>
    </div><!-- .mod-lib-col-2 -->    
    <div class="mod-lib-col-1">          
      <div class="mod-lib-search">
        <?php echo do_shortcode('[facetwp facet="search"]'); ?>
      </div>
      <?php echo do_shortcode('[facetwp template="custom"]'); ?>
      <?php echo do_shortcode('[facetwp pager="true"]'); ?>      
    </div><!-- .mod-lib-col-1 -->    
  </div><!-- .mod-lib-block -->

</article><!-- #post-<?php the_ID(); ?> -->