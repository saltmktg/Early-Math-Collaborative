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

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
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
		?>
			<dt>Coach Report:</dt>
			<dd>
				<?php echo do_shortcode( '[formlightbox_call title="Test 1" class="1452187370596"]Planning[/formlightbox_call]' ); ?>
				<?php echo do_shortcode( '[formlightbox_obj id="1452187370596" style="" onload="false"][gravityform id="1"][/formlightbox_obj]' ); ?>
			</dd>
			<dd> Observation </dd>
			<dd> Reflection </dd>
	</dl>
</div>
<div class="tribe-events-meta-group">
	<h3 class="tribe-events-single-section-title">Participants</h3>
	<dl>
		<dd class="tribe-participants">Group One</dd>
		<dd class="tribe-participants">Teacher One</dd>
		<dd class="tribe-participants">Teacher Two</dd>
		<dd class="tribe-participants">Someone</dd>
	</dl>
</div>

<?php
/*
[formlightbox_call title="Gravity Form" class="1"]Gravity Form[/formlightbox_call]
[formlightbox_obj id="1" style="padding: 10px;"][gravityform id="1"][/formlightbox_obj]

[formlightbox_call title="Test 1" class="1452187370596"]Test[/formlightbox_call]
[formlightbox_obj id="1452187370596" style="" onload="false"][gravityform id="2"][/formlightbox_obj]

*/
?>
