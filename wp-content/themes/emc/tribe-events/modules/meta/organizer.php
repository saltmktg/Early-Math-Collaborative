<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$organizer = get_userdata( $organizer_ids[0] );

$phone = tribe_get_organizer_phone();
$email = $organizer->user_email;
$website = $organizer->user_url;
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<h3 class="tribe-events-single-section-title">Assigned Coach</h3>
	<dl>
		<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

			?>
			<dd class="tribe-organizer">
				<?php echo tribe_get_organizer( $organizer ) ?>
			</dd>
			<?php
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
		$customFields = tribe_get_option( 'custom-fields', false );
		if ( is_array( $customFields ) ) {
			foreach ( $customFields as $field ) {
				if ( strpos( $field['label'], 'Report' ) ) {
					$forms = get_post_meta( get_the_id(), $field['name'], true );
					if( $forms ):
						?>
						<dt>Coach Report:</dt>
						<?php
						$forms = explode( '|', $forms );
						$forms_list = array();
						foreach ( (array)$forms as $form ) :
							$form_meta = RGFormsModel::get_form_meta( str_replace( 'gf_', '', $form ) );
							?>
							<dd>
								<?php echo do_shortcode( sprintf( '[formlightbox_call title="%1$s" class="form%2$d"]%1$s[/formlightbox_call]', $form_meta['title'], $form_meta['id'] ) ); ?>
								<?php echo do_shortcode( sprintf( '[formlightbox_obj id="form%1$d" style="" onload="false"][gravityform id="%1$d"][/formlightbox_obj]', $form_meta['id'] ) ); ?>
							</dd>
							<?php
						endforeach;
					endif;
				}
			}
		}
		?>
	</dl>
</div>
<?php /*
<div class="tribe-events-meta-group">
	<h3 class="tribe-events-single-section-title">Participants</h3>
	<dl>
		<dd class="tribe-participants">Group One</dd>
		<dd class="tribe-participants">Teacher One</dd>
		<dd class="tribe-participants">Teacher Two</dd>
		<dd class="tribe-participants">Someone</dd>
	</dl>
</div> */ ?>
