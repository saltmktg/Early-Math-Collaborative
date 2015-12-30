<?php
/**
 * @package EMC
 * @since 1.0
 */
?>



<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
	<header class="entry-header">
		<span>Presentations associated with</span>
		<h3 class="entry-title"><?php the_title(); ?></h3>

		
	</header><!-- .entry-header -->

	<?php 
	$reasearches = get_posts(array(
		'post_type' => array('researchp', 'contentp'),
		'showposts' => '-1',
		'meta_query' => array(
			array(
				'key' => 'conf_url', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			)
		),
		'meta_key'		=> 'citation_year',
		'orderby'		=> 'meta_value_num',
		'order'			=> 'DESC'
	));

?>

	<div class="entry-content">
  
	  <?php if( $reasearches ): ?>
	  <ul class="citation-listing">
	  	<?php $citationyears = array(); ?>
	 		<?php foreach( $reasearches as $reasearch ): ?>
 				<?php
 				$year = get_field('citation_year', $reasearch->ID);
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
 				<?php foreach( $reasearches as $reasearch ): ?>
 				<?php if((get_field('citation_year', $reasearch->ID)) == $citationyear) { ?>
 				
 				<li class="citation">
				<?php $cusers = get_field('authors_repeater', $reasearch->ID); ?>
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
								echo get_field('details', $reasearch->ID); ?>
	 					<?php if (get_field('citation_behaviour', $reasearch->ID)==3 && get_field('citation_url', $reasearch->ID)) { ?>
	 						<a href="<?php echo get_field('citation_url', $reasearch->ID) ?>">View Link <i class="fa fa-long-arrow-right"></i></a>
	 					<?php } ?>
	 					<?php if (get_field('citation_behaviour', $reasearch->ID)==2 && get_field('citation_url', $reasearch->ID)) { ?>
	 						<a href="<?php echo get_field('citation_file', $reasearch->ID) ?>">Download File <i class="fa fa-save"></i></a>
	 					<?php } ?>
	 					<?php if (get_field('citation_behaviour', $reasearch->ID)==4 && get_field('citation_url', $reasearch->ID)) { ?>
	 						<a class="emc-toggle-link">Read More</a>
	 						<div class="readmore-content">
	 						<h3>Abstract</h3>
	 						<?php echo get_field('citation_abstract', $reasearch->ID) ?>
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

<?php if($reasearches){ ?> 
<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////
	 /////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////
-->



<div class="emc-single-widgets widget-area" role="complementary">
	<?php dynamic_sidebar( 'single' ); ?>
</div>
