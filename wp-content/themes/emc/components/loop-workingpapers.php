<?php 
	$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
	
	$publications = get_posts(array(
		'post_type' => 'workingpapers',
		'showposts' => '-1',
		'meta_query' => array(
		),
		'meta_key'		=> 'citation_year',
		'orderby'		=> 'meta_value_num',
		'order'			=> 'DESC'
	));

?>
<?php if( $publications ): ?>
	<?php $i = 0; ?>
	<?php foreach( $publications as $publication ): ?>
	<?php
		$authorsid[] = get_field('authors_repeater', $publication->ID);
    $found = false;
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
	?>
	<?php endforeach;?>
<?php if ($i > 0) { ?>
<div class="publications">
<h1><a href="/research/working-papers/" alt="View all Working Papers" title="View all Working Papers">Working Papers</a></h1>
<ul class="citation-listing">
	<?php $citationyears = array(); ?>
		<?php foreach( $publications as $publication ): ?>
			<?php
		$authorsid = get_field('authors_repeater', $publication->ID);

    $found = false;
    foreach ($authorsid as $item) {
    	$item = $item['single_author'];
    if ($item === $curauth->ID) { 
            $found = true; 
        } elseif (is_array($item)) {
            $found = in_array($curauth->ID, $item); 
            if($found) { 
            	$year = get_field('citation_year', $publication->ID);
							array_push($citationyears, $year);
            } 
        }    
    }
		?>
		<?php endforeach; ?>
		<?php 
		$citationyears = array_unique($citationyears);
		rsort($citationyears);
		?>

		<?php foreach( $citationyears as $citationyear ): ?>
			<h3 class="cyear"><?php echo $citationyear; ?></h3>
			<hr>
			<?php foreach( $publications as $publication ): ?>

			<?php $authorsid = get_field('authors_repeater', $publication->ID); ?>

			<?php if((get_field('citation_year', $publication->ID)) == $citationyear) { ?>
			<?php $authorsid = get_field('authors_repeater', $publication->ID);
				    $found = false;
				    foreach ($authorsid as $item) {
				    	$item = $item['single_author'];
				    if ($item === $curauth->ID) { 
				            $found = true; 
				        } elseif (is_array($item)) {
				            $found = in_array($curauth->ID, $item); 
				            if($found) { ?>
				            
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
												<?php
				            } 
				        }    
				    } ?>
			
			<?php } ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
</ul>
</div>
<?php } ?>
<?php endif; ?>