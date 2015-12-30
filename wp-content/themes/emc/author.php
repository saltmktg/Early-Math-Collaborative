<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EMC
 * @since 1.0
 */

if (function_exists('sharing_display')) {
    sharing_display();
}

get_header(); ?>

		<div class="primary" class="site-content">
			<div id="content" role="main">

				<?php
				  global $curauth;
			    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
			    ?>
			    <header id="userbio" class="entry-header">
			    	<div class="left">
				    	<h1><?php echo $curauth->display_name; ?><?php if (get_field('title', 'user_'.$curauth->ID)){ echo ", ".get_field('title', 'user_'.$curauth->ID);} ?></h1>
							<h3 class="profession"><?php the_field('profession', 'user_'.$curauth->ID) ?></h3>
							<h3><?php the_field('job_title', 'user_'.$curauth->ID) ?></h3>
						</div>
						<?php if (get_field('user_image', 'user_'.$curauth->ID)) { 
							$attachment_id = get_field('user_image', 'user_'.$curauth->ID);
							$size = "thumbnail"; // (thumbnail, medium, large, full or custom size) 
							$img = wp_get_attachment_image( $attachment_id, $size );
							?> <div class="userprofile"><?php echo $img; ?></div> <?php 
						} ?>
					</header>
			    <div class="bio-descripton">
			    	<?php if  (!get_field('user_bio', 'user_'.$curauth->ID)) { echo "This Person doesn’t have a public profile </div>"; } else { ?>
			    	<?php the_field('user_bio', 'user_'.$curauth->ID) ?>
			    </div>
			    
			<!-- The Loop -->
					
			  		<?php get_template_part( 'components/featured', 'publications' ); ?>
				  	
				  	<?php get_template_part( 'components/loop', 'workingpapers' ); ?>
				  	
				  	<?php get_template_part( 'components/featured', 'researchpresentation' ); ?>
				  	
				  	<?php get_template_part( 'components/featured', 'contentpresentation' ); ?>
				  	
				  	<?php get_template_part( 'components/featured', 'ideasasociated' ); ?>

				  	<?php } ?><!--  end else -->
			</div><!-- #content -->
		</div><!-- .primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>