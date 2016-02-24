<?php
/**
 * Events post main metabox
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

if ( class_exists( 'Eventbrite_for_TribeEvents' ) ) {
	?>
	<style type="text/css">
		.eventBritePluginPlug {
			display: none;
		}
	</style>
	<?php
}
?>
<div id="eventIntro">
	<div id="tribe-events-post-error" class="tribe-events-error error"></div>
	<?php
	/**
	 * Fires inside the top of "The Events Calendar" meta box
	 *
	 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
	 * @param boolean
	 */
	do_action( 'tribe_events_post_errors', $event->ID, true );
	?>
</div>
<div id='eventDetails' class="inside eventForm" data-datepicker_format="<?php echo esc_attr( tribe_get_option( 'datepickerFormat' ) ); ?>">
	<?php
	/**
	 * Fires inside the opening #eventDetails div of The Events Calendar meta box
	 *
	 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
	 * @param boolean
	 */
	do_action( 'tribe_events_detail_top', $event->ID, true );

	wp_nonce_field( Tribe__Events__Main::POSTTYPE, 'ecp_nonce' );

	/**
	 * Fires after the nonce field inside The Events Calendar meta box
	 *
	 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
	 * @param boolean
	 */
	do_action( 'tribe_events_eventform_top', $event->ID );
	?>
	<table cellspacing="0" cellpadding="0" id="EventInfo">
		<tr>
			<td colspan="2" class="tribe_sectionheader">
				<div class="tribe_sectionheader" style="">
					<h4><?php esc_html_e( 'Time &amp; Date', 'the-events-calendar' ); ?></h4></div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="eventtable">
					<tr id="recurrence-changed-row">
						<td colspan='2'><?php printf( esc_html__( 'You have changed the recurrence rules of this %1$s.  Saving the %1$s will update all future %2$s.  If you did not mean to change all %2$s, then please refresh the page.', 'the-events-calendar' ), strtolower( $events_label_singular ), strtolower( $events_label_plural ) ); ?></td>
					</tr>
					<tr>
						<td><?php printf( esc_html__( 'All Day %s:', 'the-events-calendar' ), $events_label_singular ); ?></td>
						<td>
							<input tabindex="<?php tribe_events_tab_index(); ?>" type="checkbox" id="allDayCheckbox" name="EventAllDay" value="yes" <?php echo esc_html( $isEventAllDay ); ?> />
						</td>
					</tr>
					<tr>
						<td style="width:175px;"><?php esc_html_e( 'Start Date &amp; Time:', 'the-events-calendar' ); ?></td>
						<td id="tribe-event-datepickers" data-startofweek="<?php echo get_option( 'start_of_week' ); ?>">
							<input autocomplete="off" tabindex="<?php tribe_events_tab_index(); ?>" type="text" class="tribe-datepicker" name="EventStartDate" id="EventStartDate" value="<?php echo esc_attr( $EventStartDate ) ?>" />

							<span class="helper-text hide-if-js"><?php esc_html_e( 'YYYY-MM-DD', 'the-events-calendar' ) ?></span>
							<span class="timeofdayoptions">
								<?php echo tribe_get_datetime_separator(); ?>
								<select tabindex="<?php tribe_events_tab_index(); ?>" name="EventStartHour">
									<?php echo $startHourOptions; ?>
								</select>
								<select tabindex="<?php tribe_events_tab_index(); ?>" name="EventStartMinute">
									<?php echo $startMinuteOptions; ?>
								</select>
								<?php if ( ! Tribe__View_Helpers::is_24hr_format() ) : ?>
									<select tabindex="<?php tribe_events_tab_index(); ?>" name="EventStartMeridian">
										<?php echo $startMeridianOptions; ?>
									</select>
								<?php endif; ?>
							</span>
						</td>
					</tr>
					<tr>
						<td><?php esc_html_e( 'End Date &amp; Time:', 'the-events-calendar' ); ?></td>
						<td>
							<input autocomplete="off" type="text" class="tribe-datepicker" name="EventEndDate" id="EventEndDate" value="<?php echo esc_attr( $EventEndDate ); ?>" />
							<span class="helper-text hide-if-js"><?php _e( 'YYYY-MM-DD', 'the-events-calendar' ) ?></span>
							<span class="timeofdayoptions">
								<?php echo tribe_get_datetime_separator(); ?>
								<select class="tribeEventsInput" tabindex="<?php tribe_events_tab_index(); ?>" name="EventEndHour">
									<?php echo $endHourOptions; ?>
								</select>
								<select tabindex="<?php tribe_events_tab_index(); ?>" name="EventEndMinute">
									<?php echo $endMinuteOptions; ?>
								</select>
								<?php if ( ! Tribe__View_Helpers::is_24hr_format() ) : ?>
									<select tabindex="<?php tribe_events_tab_index(); ?>" name="EventEndMeridian">
										<?php echo $endMeridianOptions; ?>
									</select>
								<?php endif; ?>
							</span>
						</td>
					</tr>
					<tr class="event-timezone">
						<td class="label">
							<label for="event-timezone">
								<?php esc_html_e( 'Timezone:', 'the-events-calendar' ); ?>
							</label>
						</td>
						<td>
							<select tabindex="<?php tribe_events_tab_index(); ?>" name="EventTimezone" id="event-timezone" class="chosen">
								<?php echo wp_timezone_choice( Tribe__Events__Timezones::get_event_timezone_string() ); ?>
							</select>
						</td>
					</tr>
					<?php
					/**
					 * Fires after the event end date field in The Events Calendar meta box
					 * HTML outputted here should be wrapped in a table row (<tr>) that contains 2 cells (<td>s)
					 *
					 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
					 * @param boolean
					 */
					do_action( 'tribe_events_date_display', $event->ID, true );
					?>
				</table>
			</td>
		</tr>
	</table>
	<table id="event_venue" class="eventtable">
		<tr>
			<td colspan="2" class="tribe_sectionheader">
				<h4><?php esc_html_e( 'Location', 'the-events-calendar' ); ?></h4></td>
		</tr>
		<?php
		/**
		 * Fires just after the "Location" header that appears above the venue entry form when creating & editing events in the admin
		 * HTML outputted here should be wrapped in a table row (<tr>) that contains 2 cells (<td>s)
		 *
		 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
		 */
		do_action( 'tribe_venue_table_top', $event->ID );
		$venue_meta_box_template = apply_filters( 'tribe_events_venue_meta_box_template', $tribe->pluginPath . 'src/admin-views/venue-meta-box.php' );
		if ( $venue_meta_box_template ) {
			include $venue_meta_box_template;
		}
		?>
	</table>
	<?php
	/**
	 * Fires after the venue entry form when creating & editing events in the admin
	 * HTML outputted here should be wrapped in a table row (<tr>) that contains 2 cells (<td>s)
	 *
	 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
	 */
	do_action( 'tribe_after_location_details', $event->ID );
	?>
	<table id="event_organizer" class="eventtable">
		<thead>
			<tr>
				<td colspan="2" class="tribe_sectionheader">
					<h4>Assigned Team</h4></td>
			</tr>
			<?php
			/**
			 * Fires just after the header that appears above the organizer entry form when creating & editing events in the admin
			 * HTML outputted here should be wrapped in a table row (<tr>) that contains 2 cells (<td>s)
			 *
			 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
			 */
			do_action( 'tribe_organizer_table_top', $event->ID );
			?>
		</thead>
		<tbody>
			<?php
			// The organizer meta box will render everything within a <tbody>
			$coaches = get_users( array( 'role' => 'coach-events', 'orderby' => 'display_name' ) );
			$teachers = get_users( array( 'role' => 'teacher-events', 'orderby' => 'display_name' ) );
			$groups = get_terms( 'group-events-forms', array( 'hide_empty' => false ) );

			$organizer_ids = array_filter( (array)tribe_get_event_meta( $event->ID, '_EventOrganizerID', false ) );

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
				<td class="vtop"><label>Other Attendees:</label></td>
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
		<?php
		//include Tribe__Events__Main::instance()->pluginPath . 'src/admin-views/new-organizer-meta-section.php';
		?>
	</table>

	<?php
	/**
	 * Fires just after closing table tag after Event Website in The Events Calendar meta box
	 *
	 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
	 * @param boolean
	 */
	do_action( 'tribe_events_details_table_bottom', $event->ID, true );
	?>

</div>
<?php
/**
 * Fires at the bottom of The Events Calendar meta box
 *
 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
 * @param boolean
 */
do_action( 'tribe_events_above_donate', $event->ID, true );

/**
 * Fires at the bottom of The Events Calendar meta box
 *
 * @param int $event->ID the event currently being edited, will be 0 if creating a new event
 * @param boolean
 */
do_action( 'tribe_events_details_bottom', $event->ID, true );
