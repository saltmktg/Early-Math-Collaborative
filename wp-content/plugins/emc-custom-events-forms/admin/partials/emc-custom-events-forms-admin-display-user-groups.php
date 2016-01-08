<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/admin/partials
 */
?>
  <h3><?php _e( 'Group for Events and Forms' ); ?></h3>

    <table class="form-table">

      <tr>
        <th><label for="group"><?php _e( 'Select group for events and forms' ); ?></label></th>

        <td><?php

        /* If there are any group terms, loop through them and display checkboxes. */
        if ( !empty( $terms ) ) {

          foreach ( $terms as $term ) { ?>
            <input type="checkbox" name="group-events-forms[]" id="group-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( true, is_object_in_term( $user->ID, 'group-events-forms', $term ) ); ?> /> <label for="group-<?php echo esc_attr( $term->slug ); ?>"><?php echo $term->name; ?></label> <br />
          <?php }
        }

        /* If there are no group terms, display a message. */
        else {
          _e( 'There are no groups available.' );
        }

        ?></td>
      </tr>

    </table>

