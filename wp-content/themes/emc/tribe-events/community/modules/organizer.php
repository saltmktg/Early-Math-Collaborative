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
				<h4> <label class="<?php echo tribe_community_events_field_has_error( 'organizer' ) ? 'error' : ''; ?>">Assigned Team</label> </h4>
			</td><!-- .tribe_sectionheader -->
		</tr> </thead>
		<tbody>
			<?php
			// The organizer meta box will render everything within a <tbody>
			$organizer_ids = tribe_get_organizer_ids();
			$coaches = get_users( array( 'role' => 'coach-events', 'orderby' => 'display_name' ) );
			$teachers = get_users( array( 'role' => 'teacher-events', 'orderby' => 'display_name' ) );
			$groups = get_terms( 'group-events-forms', array( 'hide_empty' => false ) );
			?><script type="text/template" id="tmpl-tribe-select-organizer"></script><?php
			?>
			<tr class="saved_organizer">
				<td><label>Coaches:</label></td>
				<td><?php
				echo '<select class="chosen organizer-dropdown" multiple name="organizer[OrganizerID][]" id="saved_organizer">';
				foreach ( $coaches as $user ) {
					if ( in_array( $user->ID, $organizer_ids ) ) {
						printf( '<option value="%d" selected="selected">%s</option>', $user->ID, $user->data->display_name );
					} else {
						printf( '<option value="%d">%s</option>', $user->ID, $user->data->display_name );
					}
				}
				echo '</select>';
				?>
				</td>
			</tr>
			<tr class="saved_organizer">
				<td><label>Teachers:</label></td>
				<td><?php
				echo '<select class="chosen organizer-dropdown" multiple name="organizer[OrganizerID][]" id="saved_organizer">';
				foreach ( $teachers as $user ) {
					if ( in_array( $user->ID, $organizer_ids ) ) {
						printf( '<option value="%d" selected="selected">%s</option>', $user->ID, $user->data->display_name );
					} else {
						printf( '<option value="%d">%s</option>', $user->ID, $user->data->display_name );
					}
				}
				echo '</select>';
				?>
				</td>
			</tr>
			<tr class="saved_organizer">
				<td><label>Groups:</label></td>
				<td><?php
				echo '<select class="chosen organizer-dropdown" multiple name="organizer[OrganizerID][]" id="saved_organizer">';
				foreach ( $groups as $group ) {
					if ( in_array( $group->term_id, $organizer_ids ) ) {
						printf( '<option value="group_%d" selected="selected">%s</option>', $group->term_id, $group->name );
					} else {
						printf( '<option value="group_%d">%s</option>', $group->term_id, $group->name );
					}
				}
				echo '</select>';
				?>
				</td>
			</tr>
		</tbody>
		<?php
		include Tribe__Events__Main::instance()->pluginPath . 'src/admin-views/new-organizer-meta-section.php';
		?>
	</table> <!-- #event_organizer -->

</div>