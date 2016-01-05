<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/includes
 * @author     Your Name <email@example.com>
 */
class EMC_CustomEventsForms_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
    remove_role('form_events_admin');
    add_role( 'form_events_admin', 'Form/Events Administrator', array( 'read' => true, 'level_0' => true ) );
    remove_role('coach');
    add_role( 'coach', 'Coach', array( 'read' => true, 
                                       'coaching' => true) );
    remove_role('teacher');
    add_role( 'teacher', 'Teacher', array( 'read' => true, 
                                           'teaching' => true ) );

    


	}

}
