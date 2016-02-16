<?php
if ( empty( $customFields ) || ! is_array( $customFields ) ) {
	return;
}

$events_label_singular = tribe_get_event_label_singular();

?>
<table id="event-meta" class="eventtable">
	<thead>
		<tr>
			<td colspan="2" class="tribe_sectionheader">
				<h4><?php esc_html( sprintf( __( 'Additional %s Fields', 'tribe-events-calendar-pro' ), $events_label_singular ) ); ?></h4></td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ( $customFields as $customField ): ?>
		<?php $val = get_post_meta( get_the_ID(), $customField['name'], true ) ?>
		<tr>
			<td><?php echo esc_html( stripslashes( $customField['label'] ) ) ?></td>
			<td>
				<?php $options = explode( "\r\n", $customField['values'] ) ?>
				<?php if ( 'text' === $customField['type'] ): ?>
					<input type="text" name="<?php echo esc_attr( $customField['name'] ) ?>" value="<?php echo esc_attr( $val ) ?>" />
				<?php elseif ( 'url' === $customField['type'] ): ?>
					<input type="url" name="<?php echo esc_attr( $customField['name'] ) ?>" value="<?php echo esc_attr( $val ) ?>" />
				<?php elseif ( 'radio' === $customField['type'] ): ?>
					<div>
						<label><input type="radio" name="<?php echo esc_attr( $customField['name'] ) ?>" value="" <?php checked( trim( $val ), '' ) ?>/> <?php esc_html_e( 'None', 'tribe-events-calendar-pro' ); ?></label>
					</div>
					<?php foreach ( $options as $option ): ?>
						<div>
							<label><input type="radio" name="<?php echo esc_attr( $customField['name'] ) ?>" value="<?php echo esc_attr( trim( $option ) ) ?>" <?php checked( esc_attr( trim( $val ) ), esc_attr( trim( $option ) ) ) ?>/> <?php echo esc_html( stripslashes( $option ) ) ?>
							</label></div>
					<?php endforeach ?>
				<?php elseif ( 'checkbox' === $customField['type'] ):
					if ( 'Gravity Forms' == $customField['values'] ) {
						$forms = RGFormsModel::get_forms();
						foreach( $forms as $form ) {
							$values = explode( '|', $val );
							?>
							<div>
								<label>
									<input type="checkbox" value="<?php echo esc_attr( 'gf_' . $form->id ); ?>" <?php checked( in_array( esc_attr( $form->id ), $values ) ) ?> name="<?php echo esc_html( stripslashes( $customField['name'] ) ); ?>[]"/>
									<?php echo esc_html( stripslashes( $form->title ) ); ?>
								</label>
							</div>
							<?php
						}
					} else {
						foreach ( $options as $option ): ?>
							<?php $values = explode( '|', $val ); ?>
							<div>
								<label><input type="checkbox" value="<?php echo esc_attr( trim( $option ) ) ?>" <?php checked( in_array( esc_attr( trim( $option ) ), $values ) ) ?> name="<?php echo esc_attr( $customField['name'] ) ?>[]" /> <?php echo esc_html( stripslashes( $option ) ) ?>
								</label></div>
						<?php endforeach;
					}
				elseif ( 'dropdown' === $customField['type'] ): ?>
					<select name="<?php echo esc_attr( $customField['name'] ) ?>">
						<option value="" <?php selected( trim( $val ), '' ) ?>><?php esc_html_e( 'None', 'tribe-events-calendar-pro' ); ?></option>
						<?php $options = explode( "\r\n", $customField['values'] ) ?>
						<?php foreach ( $options as $option ): ?>
							<option value="<?php echo esc_attr( trim( $option ) ) ?>" <?php selected( esc_attr( trim( $val ) ), trim( esc_attr( $option ) ) ) ?>><?php echo esc_html( stripslashes( $option ) ) ?></option>
						<?php endforeach ?>
					</select>
				<?php elseif ( 'textarea' === $customField['type'] ): ?>
					<textarea name="<?php echo esc_attr( $customField['name'] ) ?>"><?php echo esc_textarea( $val ) ?></textarea>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>