<?php
/**
 * The template used for displaying page content on Early Math Library
 *
 * @package EMC
 * @since 1.0
 */
?>

<!--
<div class="crumbs">
  <ul>
    <li><a href="<?php bloginfo('url'); ?>">Home</a><span class="crumb-arrow">&raquo;</span></li>
    <li>Early Math Library</li>
  </ul>
</div>
-->

<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
  <!--<header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>    
  </header>-->  

  <div class="mod-header-title-alt">
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

  <div class="entry-content">
    <?php the_content(); ?>
  </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
