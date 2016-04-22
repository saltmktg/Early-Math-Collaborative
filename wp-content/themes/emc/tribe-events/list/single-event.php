<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>
<td>
<?php
$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$organizer = get_userdata( $organizer_ids[0] );
if ( $organizer ) :
	?>
	<dd class="tribe-organizer">
		<?php echo $organizer->data->display_name; ?>
	</dd>
	<?php
else :
	echo 'No Coach assigned';
endif;
?>
</td>
<td>
  <?php
		echo tribe_get_event_taxonomy(
			get_the_id(), array(
				'before'       => '',
				'sep'          => ', ',
				'after'        => '',
				'label'        => '', // An appropriate plural/singular label will be provided
				'label_before' => '',
				'label_after'  => '',
				'wrap_before'  => '<dd class="tribe-events-event-categories">',
				'wrap_after'   => '</dd>',
			)
		);
		?>

</td>
<?php
$event_date = tribe_get_start_date(get_the_ID());
?>
<td data-order="<?php echo $event_date; ?>">
			<?php echo tribe_events_event_schedule_details() ?>
</td>
<td>
    <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark">
		<?php the_title() ?>
    &raquo;</a>
</td>
<td>
<?php
global $wp_roles;
$current_user = wp_get_current_user();
$roles = $current_user->roles;
$role = array_shift($roles);
if ( ( is_user_logged_in() && ( 'administrator' == $role || 'coach-events' == $role ) ) || ! is_user_logged_in() ) {
	$terms = wp_get_post_terms( get_the_ID(), 'tribe_events_cat' );
	$forms = array();
	foreach ( $terms as $term ) {
		$term_forms = get_field( 'related_forms', 'tribe_events_cat_' . $term->term_id );
		if ( $term_forms ) {
			$forms = array_merge( $forms, $term_forms );
		}
	}
	$terms = wp_get_post_terms( get_the_ID(), 'tribe_events_cat' );
	$forms = array();
	foreach ( $terms as $term ) {
		$term_forms = get_field( 'related_forms', 'tribe_events_cat_' . $term->term_id );
		if ( $term_forms ) {
			$forms = array_merge( $forms, $term_forms );
		}
	}
	if( $forms ):
		echo '<dl>';
		foreach ( (array)$forms as $form ) :
			$form_meta = RGFormsModel::get_form_meta( $form );
			$form_settings = rgar( $form_meta, 'emc-custom-gf-addons' );
			if ( is_user_logged_in() ) :
				if ( in_array( $current_user->ID, (array)$form_settings['disable_for_users'] ) || $form_settings['disable_for_all'] ) :
					?>
					<dd><?php echo $form_meta['title']; ?></dd>
					<?php
				else :
					?>
					<dd>
						<?php
						$search_criteria = array(
							'field_filters' => array(
								array(
									'key' => 'created_by',
									'value' => $current_user->ID,
								),
								array(
									'key' => 'post_id',
									'value' => get_the_ID(),
								),
							),
							'status' => 'active',
						);
						$entries = GFAPI::get_entries( $form_meta['id'], $search_criteria );
						$form_hash = md5( $form_meta['id'] . get_the_ID() );
						if ( $entry = $entries[0] ) {
							printf( '<a href="%1$s?form=%2$s" class="has-entry">%3$s</a>', get_permalink( get_the_ID() ), $form_hash, $form_meta['title'] );
						} else {
							printf( '<a href="%1$s?form=%2$s" class="no-entry">%3$s</a>', get_permalink( get_the_ID() ), $form_hash, $form_meta['title'] );
						}
						?>
					</dd>
				<?php
				endif;
			else:
				?>
				<dd><a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php echo $form_meta['title']; ?></a></dd>
				<?php
			endif;
		endforeach;
		echo '</dl>';
	else :

	    echo 'No Forms assigned';

	endif;
}
?>


</td>
<?php
/*
// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<!-- Event Cost -->
<?php if ( tribe_get_cost() ) : ?>
	<div class="tribe-events-event-cost">
		<span><?php echo tribe_get_cost( null, true ); ?></span>
	</div>
<?php endif; ?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h2 class="tribe-events-list-event-title">
	<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h2>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta">
	<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

		<!-- Schedule & Recurrence Details -->
		<div class="tribe-event-schedule-details">
			<?php echo tribe_events_event_schedule_details() ?>
		</div>

		<?php if ( $venue_details ) : ?>
			<!-- Venue Display Info -->
			<div class="tribe-events-venue-details">
				<?php echo implode( ', ', $venue_details ); ?>
			</div> <!-- .tribe-events-venue-details -->
		<?php endif; ?>

	</div>
</div><!-- .tribe-events-event-meta -->
<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Image -->
<?php echo tribe_event_featured_image( null, 'medium' ) ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content">
	<?php echo tribe_events_get_the_excerpt(); ?>
	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'the-events-calendar' ) ?> &raquo;</a>
</div><!-- .tribe-events-list-event-description -->
<?php
 */
do_action( 'tribe_events_after_the_content' );
