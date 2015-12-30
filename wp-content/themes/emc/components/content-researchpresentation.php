<?php
/**
 * @package EMC
 * @since 1.0
 */
?>
<?php if(isset($_GET['u'])) { $userid = $_GET['u']; $authordata = get_userdata( $userid );} ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'emc-primary-post' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?> <?php if($userid){ echo "by ".$authordata->display_name; } ?></h1>
		<?php if($userid){ ?>
		<a href="/research/research-presentations/">view all research presentations</a>
		<?php } ?>
		
	</header><!-- .entry-header -->
	<?php if($userid){ ?>
		<?php get_template_part( 'components/conditional', 'researchpresentation' ); ?>
	<?php } else { ?>
	<div class="entry-content">

		<?php 
			$researchpres = get_posts(array(
				'post_type' => 'researchp',
				'showposts' => '-1',
				'meta_query' => array(
					'relation' => 'OR',
						array(
						'key' => 'exclude_from_listing', // name of custom field
						'compare' => 'NOT EXISTS'
					),
						array(
						'key' => 'exclude_from_listing', // name of custom field
						'value' => 1, // matches exaclty "123", not just 123. This prevents a match for "1234"
						'compare' => '!='
					),
				),
				'meta_key'		=> 'citation_year',
				'orderby'		=> 'meta_value_num',
				'order'			=> 'DESC'
			));

		?>

		<?php if( $researchpres ): ?>
		<ul class="citation-listing">
			<?php $citationyears = array(); ?>
			<?php foreach( $researchpres as $presentation ): ?>
				<?php
				$year = get_field('citation_year', $presentation->ID);
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
				<?php foreach( $researchpres as $presentation ): ?>
				<?php if((get_field('citation_year', $presentation->ID)) == $citationyear) { ?>
				
				<li class="citation">
				<?php $cusers = get_field('authors_repeater', $presentation->ID); ?>
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
								echo get_field('details', $presentation->ID); ?>
					<?php 
						$behaviour = array();
						$behaviour = get_field('citation_behaviour', $presentation->ID); 
					?>
					<?php if (is_array($behaviour) && in_array(5, $behaviour)) { ?>
							<?php $conferences = get_field('conf_url', $presentation->ID); ?>
							<?php foreach ( $conferences as $conference) :?> 
								<a class="behaviour" href="<?php echo get_permalink( $conference->ID ) ?>"><?php echo $conference->post_title ?> <i class="fa fa-calendar-o"></i></a>
							<?php endforeach; ?>
						<?php } ?>
						<?php if (is_array($behaviour) && in_array(3, $behaviour)) { ?>
							<a class="behaviour" href="<?php echo get_field('citation_url', $presentation->ID) ?>">View Link <i class="fa fa-long-arrow-right"></i></a>
						<?php } ?>
						<?php if (is_array($behaviour) && in_array(2, $behaviour)) { ?>
							<a class="behaviour" href="<?php echo get_field('citation_file', $presentation->ID) ?>">Download File <i class="fa fa-save"></i></a>
						<?php } ?>
						<?php if (is_array($behaviour) && in_array( 4 , $behaviour)) { ?>
							<a class="emc-toggle-link behaviour">Read More</a>
							<div class="readmore-content">
							<h3>Abstract</h3>
							<?php echo get_field('citation_abstract', $presentation->ID) ?>
							</div>
						<?php } ?>
						
				</li>
				
				<?php } ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>

	</div><!-- .entry-content -->
	<?php } ?> <!-- else -->
</article><!-- #post-<?php the_ID(); ?> -->

<div class="emc-single-widgets widget-area" role="complementary">
	<?php dynamic_sidebar( 'single' ); ?>
</div>
