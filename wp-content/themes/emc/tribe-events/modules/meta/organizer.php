<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$coaches = get_users( array( 'role' => 'coach-events', 'fields' => 'ids' ) );
$organizer_ids = array_intersect( tribe_get_organizer_ids(), $coaches );
$multiple = count( $organizer_ids ) > 1;
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
					if ( is_user_logged_in() ) :
						?>
						<dd>
							<?php echo do_shortcode( sprintf( '[formlightbox_call title="%1$s" class="form%2$d"]%1$s[/formlightbox_call]', $form_meta['title'], $form_meta['id'] ) ); ?>
							<?php echo do_shortcode( sprintf( '[formlightbox_obj id="form%1$d" style="" onload="false"][gravityform id="%1$d" ajax="true"][/formlightbox_obj]', $form_meta['id'] ) ); ?>
						</dd>
						<?php
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
