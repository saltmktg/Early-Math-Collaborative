<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$organizer_ids_full = tribe_get_organizer_ids();
$coaches = get_users( array( 'role' => 'coach-events', 'fields' => 'ids' ) );
$groups = get_terms( 'group-events-forms', array( 'fields' => 'ids' ) );
$organizer_ids = array_intersect( $organizer_ids_full, $coaches );
foreach( $organizer_ids_full as $key => $organizer_id ) {
	if ( strpos( $organizer_id, '99999' ) ) {
		$organizer_ids_full[$key] = str_replace( '99999', '', $organizer_id );
	} else {
		unset( $organizer_ids_full[$key] );
	}
}
$groups_ids = array_intersect( $organizer_ids_full, $groups );
$multiple = ( count( $organizer_ids ) + count( $groups_ids ) ) > 1;
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<h3 class="tribe-events-single-section-title">Assigned Coaches</h3>
	<dl>
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer_id ) {
			$organizer = get_userdata( $organizer_id );

			if ( ! $organizer || 'coach-events' != $organizer->roles[0] ) {
				continue;
			}

			$phone = tribe_get_organizer_phone();
			$email = $organizer->user_email;
			$website = $organizer->user_url;
			?>
			<dd class="tribe-organizer">
				<h4><?php echo $organizer->display_name; ?></h4>
			</dd>
			<?php
		}

		if ( $groups_ids ) {
			foreach ( $groups_ids as $group_id ) {
				$term = get_term( $group_id, 'group-events-forms' );
				$term_coaches  = array_filter( (array)get_field( 'group_coaches', 'group-events-forms_' . $group_id ) );
				$term_teachers = array_filter( (array)get_field( 'group_teachers', 'group-events-forms_' . $group_id ) );

				if ( $term_coaches || $term_teachers ) :
					?>
					<dd class="tribe-organizer">
						<h4><?php echo $term->name; ?></h4>
						<ul>
							<?php
							foreach( $term_coaches as $coach ) :
								printf( '<li>%s</li>', $coach['display_name'] );
							endforeach;
							?>
							<?php
							foreach( $term_teachers as $teacher ) :
								printf( '<li>%s</li>', $teacher['display_name'] );
							endforeach;
							?>
						</ul>
					</dd>
					<?php
				endif;
			}
		}

		if ( ! $multiple ) { // only show organizer details if there is one
			if ( ! empty( $phone ) ) {
				?>
				<dt>
					<?php esc_html_e( 'Phone:', 'the-events-calendar' ) ?>
				</dt>
				<dd class="tribe-organizer-tel">
					<?php echo esc_html( $phone ); ?>
				</dd>
				<?php
			}//end if

			if ( ! empty( $email ) ) {
				?>
				<dt>
					<?php esc_html_e( 'Email:', 'the-events-calendar' ) ?>
				</dt>
				<dd class="tribe-organizer-email">
					<?php echo esc_html( $email ); ?>
				</dd>
				<?php
			}//end if

			if ( ! empty( $website ) ) {
				?>
				<dt>
					<?php esc_html_e( 'Website:', 'the-events-calendar' ) ?>
				</dt>
				<dd class="tribe-organizer-url">
					<?php echo $website; ?>
				</dd>
				<?php
			}//end if
		}//end if
		do_action( 'tribe_events_single_meta_organizer_section_end' );
		?>
		<?php
		// Event Forms
		//
		// Call related Gravity Forms here!!!
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
			if( $forms ):
				?>
				<dt>Coach Report:</dt>
				<?php
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
											'value' => $event_id,
										),
									),
									'status' => 'active',
								);
								$entries = GFAPI::get_entries( $form_meta['id'], $search_criteria );
								if ( $entry = $entries[0] ) {
									echo do_shortcode( sprintf( '[gf-edit-entries form_id="%d" entry_id="%d"]', $form_meta['id'], $entry['id'] ) );
								}
								?>
								<?php echo do_shortcode( sprintf( '[formlightbox_call title="%1$s" class="form%2$d"]%1$s[/formlightbox_call]', $form_meta['title'], $form_meta['id'] ) ); ?>
								<?php echo do_shortcode( sprintf( '[formlightbox_obj id="form%1$d" style="" onload="false"][gravityform id="%1$d" ajax="true"][/formlightbox_obj]', $form_meta['id'] ) ); ?>
								<?php
								if ( $_GET['form'] ) {
									$form_hash = md5( $form_meta['id'] . get_the_ID() );

									if ( $_GET['form'] == $form_hash ) {
										?>
										<script type="text/javascript">
										jQuery(document).ready(function($) {
											setTimeout(function(){
												$( '.fl_box-form<?php echo $form_meta['id']; ?>' ).trigger( 'click' );
											}, 1000);
										});
										</script>
										<?php
									}
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
			endif;
		}
		?>
	</dl>
</div>
<?php
$gmt_offset = ( get_option( 'gmt_offset' ) >= '0' ) ? ' +' . get_option( 'gmt_offset' ) : ' ' . get_option( 'gmt_offset' );
$gmt_offset = str_replace( array( '.25', '.5', '.75' ), array( ':15', ':30', ':45' ), $gmt_offset );

if ( ! tribe_is_showing_all() && strtotime( tribe_get_end_date( $post, false, 'Y-m-d G:i' ) . $gmt_offset ) <= time() ) {
	$_event_passed = true;
}

$fields = tribe_get_custom_fields();

foreach ( $fields as $field => $value ) {
	if ( 'Other Attendee' == $field ) {
		?>
		<div class="tribe-events-meta-group">
			<h3 class="tribe-events-single-section-title">Other Attendees</h3>
			<dl>
				<?php if ( ( is_user_logged_in() && ( 'administrator' == $role || 'coach-events' == $role ) ) && $_event_passed ) : ?>
					<dd class="tribe-participants"><?php
					$attendees = explode( ',', $value );
					$attendees = array_map( 'trim', $attendees );
					$attendees = array_filter( $attendees );
					$value = array();
					foreach ( $attendees as $key => $attendee ) {
						$value[] = sprintf( '%s <small>(<a href="#" class="remove-attendee" data-event="%d" data-attendee="%d" data-attendee-name="%s">Remove</a>)</small>', $attendee, get_the_ID(), ( $key + 1), $attendee );
					}
					echo implode( ', ', $value );
					?></dd>
				<?php else : ?>
					<dd class="tribe-participants"><?php echo $value; ?>...</dd>
				<?php endif; ?>
			</dl>
		</div>
		<?php
	}
}
