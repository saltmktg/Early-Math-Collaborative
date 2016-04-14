<?php
/**
 * List View Content Template
 * The content template for the list view. This template is also used for
 * the response that is returned on list view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-list">

	<!-- List Title -->
	<?php do_action( 'tribe_events_before_the_title' ); ?>
	<h2 class="tribe-events-page-title"><?php echo tribe_get_events_title() ?></h2>
	<?php do_action( 'tribe_events_after_the_title' ); ?>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<!-- List Header -->
	<?php do_action( 'tribe_events_before_header' ); ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- Header Navigation -->
		<?php do_action( 'tribe_events_before_header_nav' ); ?>
		<?php tribe_get_template_part( 'list/nav', 'header' ); ?>
		<?php do_action( 'tribe_events_after_header_nav' ); ?>

	</div>
	<!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ); ?>


	<!-- Events Loop -->
	<?php do_action( 'tribe_events_before_loop' ); ?>
	<?php if ( have_posts() ) : ?>
		<?php tribe_get_template_part( 'list/loop' ) ?>
	<?php endif; ?>
	<?php do_action( 'tribe_events_after_loop' ); ?>

	<!-- List Footer -->
	<?php do_action( 'tribe_events_before_footer' ); ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php tribe_get_template_part( 'list/nav', 'footer' ); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</div>

	<div class="request-help">
		<?php echo do_shortcode( sprintf( '[formlightbox_call title="%1$s" class="form%2$d dt-button"]%1$s[/formlightbox_call]', 'Easy Edit/Help Request', 12 ) ); ?>
		<?php echo do_shortcode( sprintf( '[formlightbox_obj id="form%1$d" style="" onload="false"][gravityform id="%1$d" ajax="true"][/formlightbox_obj]', 12 ) ); ?>
	</div>
	<!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer' ) ?>

</div><!-- #tribe-events-content -->
