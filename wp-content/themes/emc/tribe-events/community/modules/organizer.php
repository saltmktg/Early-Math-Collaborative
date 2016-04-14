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

if ( ! $_POST ) {
	$organizer_ids = function_exists( 'tribe_get_organizer_ids' ) ? tribe_get_organizer_ids() : "";
} else {
	$organizer_ids = isset( $_POST['organizer']['OrganizerID'] ) ? array_filter( $_POST['organizer']['OrganizerID'] ) : '';
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
						printf( '<option value="%d99999" selected="selected">%s</option>', $group->term_id, $group->name );
					} else {
						printf( '<option value="%d99999">%s</option>', $group->term_id, $group->name );
					}
				}
				echo '</select>';
				?>
				</td>
			</tr>
			<tr class="saved_organizer">
				<td><label>Other Attendees:</label></td>
				<td><?php
				$customFields = tribe_get_option( 'custom-fields' );

				foreach ( $customFields as $key => $field ) {
					if ( 'Other Attendee' == $field['label'] ) {
						$val = '';
						global $post;
						if ( isset( $post->ID ) && get_post_meta( get_the_ID(), $field['name'], true ) ) {
							$val = get_post_meta( get_the_ID(), $field['name'], true );
						}
						$val = apply_filters( 'tribe_community_custom_field_value', $val, $field['name'], get_the_ID() );

						$field_id = 'tribe_custom_'.sanitize_title( $field['label'] );

						$values = ! is_array( $val ) ? explode( '|', $val ) : $val;
						$values = array_values( array_filter( $values ) );

						echo '<div class="multiples-inputs">';
						for ( $i = 0; $i <= count( $values ); $i++ ) :
							?>
							<div class="input-wrap">
								<input type="text" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>[]" value="<?php echo esc_attr( $values[$i] ); ?>" size="40" />
							</div>
							<?php
						endfor;
						echo '</div>';
					}
				}
				?>
				</td>
			</tr>
		</tbody>
	</table> <!-- #event_organizer -->

	<script type="text/template" id="tmpl-tribe-create-organizer"></script>

</div>