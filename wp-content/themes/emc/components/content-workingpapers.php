<?php
/**
 * @package EMC
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php 
			$publications = get_posts(array(
				'post_type' => 'workingpapers',
				'showposts' => '-1',
				'meta_query' => array(
					array(
						'key' => 'exclude_from_listing',
						'value' => 0,
						'compare' => '=='
					)
				),
				'meta_key'		=> 'citation_year',
				'orderby'		=> 'meta_value_num',
				'order'			=> 'DESC'
			));

	  ?>

	  <?php if( $publications ): ?>
	  <ul class="citation-listing">
	  	<?php $citationyears = array(); ?>
	 		<?php foreach( $publications as $publication ): ?>
 				<?php
 				$year = get_field('citation_year', $publication->ID);
				array_push($citationyears, $year);
				?>
 			<?php endforeach; ?>
 			<?php 
				$citationyears = array_unique($citationyears);
				rsort($citationyears);
 			?>

 			<?php foreach( $citationyears as $citationyear ): ?>
 				<h2 class="cyear"><?php echo $citationyear; ?></h2>
 				<hr>
 				<?php foreach( $publications as $publication ): ?>
 				<?php if((get_field('citation_year', $publication->ID)) == $citationyear) { ?>
 				
 				<li class="citation">
				<?php $cusers = get_field('authors_repeater', $publication->ID); ?>
	 				<?php $i = 0; 
	 				$len = count($cusers);?>
	 				<?php if( $cusers ){ ?>
	 					<?php foreach( $cusers as $cuser): ?>
	 						<?php $cuser = $cuser['single_author'] ?>
	 						<a href="<?php echo get_author_posts_url($cuser['ID']); ?>">
	 						<?php 
	 						if (get_field('citation_name_display', 'user_'.$cuser['ID'])) { echo get_field('citation_name_display', 'user_'.$cuser['ID']); } else
	 						{ $string = $cuser['user_firstname']; echo $cuser['user_lastname']; echo ', '.$string[0].'.';} ?></a><?php if ($i != $len - 1){ echo ", "; }
	 							$i++; 
								endforeach; 	
								} 
								echo get_field('details', $publication->ID); ?>
 					<?php
 						$behaviour = array(); 
						$behaviour = get_field('citation_behaviour', $publication->ID); 
					?>
	 					<?php if (is_array($behaviour) && in_array(3, $behaviour)) { ?>
	 						<a class="behaviour" href="<?php echo get_field('citation_url', $publication->ID) ?>">View Link <i class="fa fa-long-arrow-right"></i></a>
	 					<?php } ?>
	 					<?php if (is_array($behaviour) && in_array(2, $behaviour)) { ?>
	 						<a class="behaviour" href="<?php echo get_field('citation_file', $publication->ID) ?>">Download File <i class="fa fa-save"></i></a>
	 					<?php } ?>
	 					<?php if (is_array($behaviour) && in_array(4, $behaviour)) { ?>
	 						<a class="emc-toggle-link behaviour">Read More</a>
	 						<div class="readmore-content">
	 						<h3>Abstract</h3>
	 						<?php echo get_field('citation_abstract', $publication->ID) ?>
	 						</div>
	 					<?php } ?>
 				</li>
 				
 				<?php } ?>
 				<?php endforeach; ?>
 			<?php endforeach; ?>
		</ul>
		<?php endif; ?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->

<div class="emc-single-widgets widget-area" role="complementary">
	<?php dynamic_sidebar( 'single' ); ?>
</div>
