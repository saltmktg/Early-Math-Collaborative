<?php
/**
 * Template Name: Blank Slide Template
 * 
 */
?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
  </head>
  <body>
    <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); endwhile; ?>
  </body>
</html>