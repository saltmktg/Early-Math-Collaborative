<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/public
 * @author     Your Name <email@example.com>
 */
class EMC_CustomEventsForms_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in EMC_CustomEventsForms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The EMC_CustomEventsForms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/emc-custom-events-forms-public.css', array(), $this->version, 'all' );

    wp_enqueue_style( 'css_DT', plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css' );
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' );
    wp_enqueue_style( 'btn_css_DT',  plugin_dir_url( __FILE__ ) . 'css/buttons.dataTables.min.css' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in EMC_CustomEventsForms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The EMC_CustomEventsForms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/emc-custom-events-forms-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		/* DataTables Basics */
		wp_enqueue_script( 'jquery.dataTables', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js' );

		/* DataTables Extensions */
		wp_enqueue_script( 'jq_btn_DT', plugin_dir_url( __FILE__ ) . 'js/dataTables.buttons.min.js' );
		wp_enqueue_script( 'jszip', plugin_dir_url( __FILE__ ) . 'js/jszip.min.js' );
		wp_enqueue_script( 'pdfmake',  plugin_dir_url( __FILE__ ) . 'js/pdfmake.min.js' );
		wp_enqueue_script( 'vfs_fonts',  plugin_dir_url( __FILE__ ) . 'js/vfs_fonts.js' );
		wp_enqueue_script( 'buttons.html5',  plugin_dir_url( __FILE__ ) . 'js/buttons.html5.min.js' );
		/* Bootstrap */
		wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array('jquery'), true);

	}

  /**
   *
   *
   *
   */
  public function before_event_list(){
		include_once plugin_dir_path( __FILE__ ). 'partials/emc-custom-events-forms-public-display-before-event-list.php';
  }

  /**
   *
   *
   */
  public function after_event_list(){
		include_once plugin_dir_path( __FILE__ ). 'partials/emc-custom-events-forms-public-display-after-event-list.php';
  }

  public function get_custom_fields( $custom_fields ) {
  	foreach ( $custom_fields as $key => $field ) {
  		if ( strpos( $key, 'Report' ) ) {
  			unset( $custom_fields[$key] );
  		}
  	}

  	return $custom_fields;
  }

  public function remove_attendee_callback() {
  		$event_id = sanitize_key( $_POST['event_id'] );
  		$attendee_key = sanitize_key( $_POST['attendee_key'] );

		$customFields = tribe_get_option( 'custom-fields', false );
		if ( is_array( $customFields ) ) {
			foreach ( $customFields as $field ) {
				if ( $field['label'] === 'Other Attendee' ) {
					$field_name = $field['name'];
					$field_value = get_post_meta( $event_id, $field['name'], true );
				}
			}
		}

		$attendees = explode( '|', $field_value );
		$attendees = array_filter( $attendees );

		if ( $attendee_key > 0 ) {
			unset($attendees[$attendee_key - 1]);
		}

		update_post_meta( $event_id, $field['name'], implode( '|', $attendees ) );

		$value = array();
		foreach ( $attendees as $key => $attendee ) {
			$value[] = sprintf( '%s <small>(<a href="#" class="remove-attendee" data-event="%d" data-attendee="%d">Remove</a>)</small>', $attendee, get_the_ID(), ( $key + 1) );
		}

		echo implode( ', ', $value );

		wp_die();
	}

	public function save_post_id_on_gravity_forms( $entry, $form ) {
		GFAPI::update_entry_property( $entry['id'], 'post_id', get_the_ID() );
	}

	public function change_query_where_for_events_list( $where ) {
		global $wp_query;
		if ( false !== strpos( $where, '_EventStartDate' ) ) {
			if ( is_post_type_archive( 'tribe_events') && 'list' == $wp_query->query_vars['eventDisplay'] ) {
				$where = " AND wp_posts.post_type = 'tribe_events' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'canceled')";
			}

				global $wp_roles;
				$current_user = wp_get_current_user();
				$roles = $current_user->roles;
				$role = array_shift($roles);

				if ( is_user_logged_in() && 'coach-events' == $role ) {
					$where .= " AND ((wp_postmeta.meta_key = '_EventOrganizerID' && wp_postmeta.meta_value = " . $current_user->ID . ") OR (wp_posts.post_author = " . $current_user->ID . "))";
				}
		}

		return $where;
	}

	public function change_query_args_for_events_list( $query ) {
		if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'tribe_events') ) {
			$query->set( 'posts_per_page', '-1' );
		}

		return $query;
	}
}
