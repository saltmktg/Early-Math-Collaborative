<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/includes
 * @author     Your Name <email@example.com>
 */
class EMC_CustomEventsForms {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      EMC_CustomEventsForms_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'emc-custom-events-forms';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - EMC_CustomEventsForms_Loader. Orchestrates the hooks of the plugin.
	 * - EMC_CustomEventsForms_i18n. Defines internationalization functionality.
	 * - EMC_CustomEventsForms_Admin. Defines all hooks for the admin area.
	 * - EMC_CustomEventsForms_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-emc-custom-events-forms-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-emc-custom-events-forms-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-emc-custom-events-forms-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-emc-custom-events-forms-public.php';

		$this->loader = new EMC_CustomEventsForms_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the EMC_CustomEventsForms_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new EMC_CustomEventsForms_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new EMC_CustomEventsForms_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_admin, 'my_register_user_taxonomy' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'my_add_group_admin_page' );

		$this->loader->add_action( 'update_post_meta', $plugin_admin, 'my_update_post_meta', 10, 4 );
		$this->loader->add_action( 'restrict_manage_posts', $plugin_admin, 'my_admin_posts_filter_restrict_manage_posts' );
		$this->loader->add_filter( 'parse_query', $plugin_admin, 'my_posts_filter' );
		$this->loader->add_action( 'transition_post_status', $plugin_admin, 'my_new_event_send_email', 10, 3 );

		/* Create custom columns for the manage group page. */
		$this->loader->add_filter( 'manage_edit-group_columns', $plugin_admin,'my_manage_group_user_column' );

		/* Create custom columns for the manage group page. */
		$this->loader->add_action( 'edited_group-events-forms', $plugin_admin,'my_update_group_count', 10, 2 );

		/* Customize the output of the custom column on the manage groups page. */
		$this->loader->add_action( 'manage_group_custom_column', $plugin_admin, 'my_manage_group_column', 10, 3 );

		/* Add section to the edit user page in the admin to select group. */
		//$this->loader->add_action( 'show_user_profile', $plugin_admin, 'my_edit_user_group_section' );
		//$this->loader->add_action( 'edit_user_profile', $plugin_admin, 'my_edit_user_group_section' );

		/* Update the group terms when the edit user page is updated. */
		$this->loader->add_action( 'personal_options_update', $plugin_admin, 'my_save_user_group_terms' );
		$this->loader->add_action( 'edit_user_profile_update', $plugin_admin, 'my_save_user_group_terms' );

		/* Filter the 'sanitize_user' to disable username. */
		$this->loader->add_filter( 'sanitize_user', $plugin_admin, 'my_disable_username' );

		/* Filter the organizer meta box template location. */
		$this->loader->add_filter( 'tribe_events_meta_box_template', $plugin_admin, 'events_meta_box_template' );
		$this->loader->add_filter( 'tribe_events_event_meta_template', $plugin_admin, 'events_event_meta_box_template' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_admin = new EMC_CustomEventsForms_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_public = new EMC_CustomEventsForms_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'tribe_events_before_loop', $plugin_public, 'before_event_list' );
		$this->loader->add_action( 'tribe_events_after_loop', $plugin_public, 'after_event_list' );

		$this->loader->add_filter( 'tribe_get_custom_fields', $plugin_public, 'get_custom_fields' );

		//$this->loader->add_action( 'update_post_meta', $plugin_admin, 'my_update_post_meta', 10, 4 );
		//$this->loader->add_action( 'wp_insert_post', $plugin_admin, 'my_new_event_send_email', 10, 3 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    EMC_CustomEventsForms_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
