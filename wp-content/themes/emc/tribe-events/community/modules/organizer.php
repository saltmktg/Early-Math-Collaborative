<?php
/**
 * Event Submission Form Metabox For Organizers
 * This is used to add a metabox to the event submission form to allow for choosing or
 * creating an organizer for user submitted events.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/modules/organizer.php
 *
 * @package Tribe__Events__Community__Main
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! isset( $event ) ) {
	$event = Tribe__Events__Main::postIdHelper();
}
?>

<!-- Organizer -->
<div class="tribe-events-community-details eventForm bubble" id="event_organizer">

	<table class="tribe-community-event-info" cellspacing="0" cellpadding="0">

		<thead> <tr>
			<td colspan="2" class="tribe_sectionheader">
				<h4> <label class="<?php echo tribe_community_events_field_has_error( 'organizer' ) ? 'error' : ''; ?>">Assigned Coach</label> </h4>
			</td><!-- .tribe_sectionheader -->
		</tr> </thead>
		<tbody>
			<?php
			// The organizer meta box will render everything within a <tbody>
			$users = get_users( array( 'role' => 'coach-events', 'orderby' => 'display_name' ) );
			?><script type="text/template" id="tmpl-tribe-select-organizer"></script><?php
			?>
			<tr class="saved_organizer">
				<td><label>Coach:</label></td>
				<td><?php
				echo '<select class="chosen organizer-dropdown" name="organizer[OrganizerID][]" id="saved_organizer">';
				echo '<option value="">Select a Coach:</option>';
				foreach ( $users as $user ) {
					printf( '<option value="%d">%s</option>', $user->ID, $user->data->display_name );
				}
				echo '</select>';
				?>
				</td>
			</tr>

			<?php
			foreach ( $users as $user ) {
				printf( '<tr class="venue coach-data coach-id-%d"><td><label>Email:</label></td><td>%s</td></tr>', $user->ID, $user->data->user_email );
			}
			?>
		</tbody>

	</table> <!-- #event_organizer -->

</div>