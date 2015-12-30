<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

$publications = get_posts(array(
		'post_type' => 'post',
		'showposts' => '-1',
		'meta_query' => array(
		),
		
		'order'			=> 'DESC'
	));

 ?>
 <?php if( $publications ): ?>
<?php $i = 0; ?>
	<?php foreach( $publications as $publication ): ?>
	<?php
		$authorsid = get_field('authors_repeater', $publication->ID);
    $found = false;

    if (is_array($authorsid)){
	    foreach ($authorsid as $item) {
	    	$item = $item['single_author'];
	    if ($item === $curauth->ID) { 
	            $found = true; 
	            $i++;
	        } elseif (is_array($item)) {
	            $found = in_array($curauth->ID, $item); 
	            if($found) {
	            $i++; 
	            } 
	        } 
	      }   
	  }	else {
		  	if ($authorsid === $curauth->ID) { 
		            $found = true; 
		            $i++;
		  }
	  }
	?>
	<?php endforeach;?>
<?php if ($i > 0) { ?>
<div class="publications last">
<h1>Associated Ideas</h1>

 <?php $i = 0; ?>
	<?php foreach( $publications as $publication ): ?>
	<?php 


		
	
	$authorsid = get_field('authors_repeater', $publication->ID);
	if (is_array($authorsid))
			{
	    foreach ($authorsid as $item) {
	    	$item = $item['single_author'];
	        	if ($item[ID] == $curauth->ID) {
	        			$i++;

	        			if($i > 3) {
	        				break;
	        			}

	            	?>

<article id="post-<?php echo $publication->ID; ?>" class="ideas-associated">
		<header class="entry-header">
			<?php 
				$format = get_the_terms( $publication->ID, 'emc_content_format' );
				$format = array_shift( $format );
				$url = get_template_directory_uri() . '/img/' . $format->slug . '.png';
				$title = sprintf( __( 'View all %s posts', 'emc' ), $format->name );
				$alt = sprintf( __( '%s icon', 'emc' ), $format->name );
				$html = sprintf( __( '<a href="%1$s" title="%2$s"><img class="emc-format-icon" src="%3$s" alt="%4$s"/></a>', 'emc' ),
					esc_url( get_term_link( $format ) ),
					esc_attr( $title ),
					esc_url( $url ),
					esc_attr( $alt )
				);
				echo $html;
			 ?>
			<?php echo get_the_post_thumbnail($publication->ID, 'thumbnail');  ?>
			<h1 class="entry-title"><a href="<?php echo get_permalink($publication->ID); ?>"><?php echo get_the_title($publication->ID); ?></a></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php $post = get_post( $publication->ID ); 
			echo wp_trim_words( $post->post_content );
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->

	            	<?php

            } 
	       }     
	    
	    } //end if is array

	 ?>

<?php endforeach; ?>
<a href="/associated-ideas/?u=<?php echo $curauth->ID; ?>">
	<div class="learnmore">
			VIEW ALL ASSOCIATED WITH THIS AUTHOR
		<div class="arrow-right"></div>
	</div>
</a>
</div>
<?php } ?>
<?php endif; ?>