<?php
/**
 * Template Name: Associated Ideas
 *
 * This template displays the content full-width, with no sidebar.
 *
 * @package EMC
 * @since 1.0.4
 */
?>
<?php get_header(); ?>
<?php if(isset($_GET['u'])) { $userid = $_GET['u']; $authordata = get_userdata( $userid );} ?>

		<section class="primary" class="site-content">
			<div id="content" role="main">

			<header class="page-header">
				<h1 class="page-title">
					Ideas <?php if($userid){ echo "associated with ".$authordata->display_name; } ?>
				</h1>
			</header>

			
			

<?php $publications = get_posts(array(
		'post_type' => 'post',
		'showposts' => '-1',
		'meta_query' => array(
		),
		
		'order'			=> 'DESC'
	));

 ?>

<?php if( $publications ) { ?>

<div class="entry-content2">

 <?php $i = 0; ?>
	<?php foreach( $publications as $publication ): ?>
	<?php 
	
	$authorsid = get_field('citation_authors', $publication->ID);
	if (is_array($authorsid))
			{
	    foreach ($authorsid as $item) {
	    
	        	if ($item[ID] == $authordata->ID) {
	        			$i++;
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
			<h1 class="entry-title"><?php echo get_the_title($publication->ID); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php $post = get_post( $publication->ID ); 
			echo wp_trim_words( $post->post_content );
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php } } }  endforeach;?>

</div>
		<?php } ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>