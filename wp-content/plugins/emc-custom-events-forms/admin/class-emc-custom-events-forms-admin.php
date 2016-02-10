<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    EMC_CustomEventsForms
 * @subpackage EMC_CustomEventsForms/admin
 * @author     Your Name <email@example.com>
 */
class EMC_CustomEventsForms_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/emc-custom-events-forms-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/emc-custom-events-forms-admin.js', array( 'jquery' ), $this->version, false );

	}

  /**
   * Registers the 'Group' taxonomy for users.
   * This is a taxonomy for the 'user' object type rather than a
   * post being the object type.
   *
   */
  public function my_register_user_taxonomy() {
    register_taxonomy(
      'group-events-forms',
      'user',
      array(
        'public' => true,
        'labels' => array(
          'name' => __( 'Groups for Events and Forms' ),
          'singular_name' => __( 'Group for Events and Forms' ),
          'menu_name' => __( 'Groups for Events and Forms' ),
          'search_items' => __( 'Search Groups for Events and Forms' ),
          'popular_items' => __( 'Popular Groups for Events and Forms' ),
          'all_items' => __( 'All Groups for Events and Forms' ),
          'edit_item' => __( 'Edit Group for Events and Forms' ),
          'update_item' => __( 'Update Group for Events and Forms' ),
          'add_new_item' => __( 'Add New Group for Events and Forms ' ),
          'new_item_name' => __( 'New Group Name' ),
          'separate_items_with_commas' => __( 'Separate groups with commas' ),
          'add_or_remove_items' => __( 'Add or remove groups' ),
          'choose_from_most_used' => __( 'Choose from the most popular groups' ),
        ),
        'rewrite' => array(
          'with_front' => true,
          'slug' => 'author/group-events-forms' // Use 'author' (default WP user slug).
        ),
        'capabilities' => array(
          'manage_terms' => 'edit_users', // Using 'edit_users' cap to keep this simple.
          'edit_terms'   => 'edit_users',
          'delete_terms' => 'edit_users',
          'assign_terms' => 'read',
        ),
        'update_count_callback' => 'EMC_CustomEventsForms_Admin::my_update_group_count' // Use a custom function to update the count.
      )
    );
  }

  /**
   * Function for updating the 'group' taxonomy count.
   * What this does is update the count of a specific term
   * by the number of users that have been given the term.
   * We're not doing any checks for users specifically here.
   * We're just updating the count with no specifics for simplicity.
   *
   * See the _update_post_term_count() function in WordPress for more info.
   *
   * @param array $terms List of Term taxonomy IDs
   * @param object $taxonomy Current taxonomy object of terms
   */
  public static function my_update_group_count( $terms, $taxonomy ) {
    global $wpdb;

    foreach ( (array) $terms as $term ) {

      $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

      do_action( 'edit_term_taxonomy', $term, $taxonomy );
      $wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
      do_action( 'edited_term_taxonomy', $term, $taxonomy );
    }
  }

  /**
   * Creates the admin page for the 'group' taxonomy under the 'Users' menu.
   * It works the same as any other taxonomy page in the admin.
   * However, this is kind of hacky and is meant as a quick solution.  When
   * clicking on the menu item in the admin, WordPress' menu system thinks you're
   * viewing something under 'Posts'
   * instead of 'Users'.  We really need WP core support for this.
   */
  public function my_add_group_admin_page() {

    $tax = get_taxonomy( 'group-events-forms' );

    add_users_page(
      esc_attr( $tax->labels->menu_name ),
      esc_attr( $tax->labels->menu_name ),
      $tax->cap->manage_terms,
      'edit-tags.php?taxonomy=' . $tax->name
    );
  }

  /**
   * Unsets the 'posts' column and adds a 'users' column on the manage group admin page.
   *
   * @param array $columns An array of columns to be shown in the manage terms table.
   */
  public function my_manage_group_user_column( $columns ) {

    unset( $columns['posts'] );

    $columns['users'] = __( 'Users' );

    return $columns;
  }

  /**
   * Displays content for custom columns on the manage groups page in the admin.
   *
   * @param string $display WP just passes an empty string here.
   * @param string $column The name of the custom column.
   * @param int $term_id The ID of the term being displayed in the table.
   */
  public function my_manage_group_column( $display, $column, $term_id ) {

    if ( 'users' === $column ) {
      $term = get_term( $term_id, 'group-events-forms' );
      echo $term->count;
    }
  }

  /**
   * Adds an additional settings section on the edit user/profile page in the admin.
   * This section allows users to
   * select a group from a checkbox of terms from the group taxonomy.
   * This is just one example of
   * many ways this can be handled.
   *
   * @param object $user The user object currently being edited.
   */
  public function my_edit_user_group_section( $user ) {
    //print_r($user->allcaps);
    $tax = get_taxonomy( 'group-events-forms' );

    /* Make sure the user can assign terms of the group taxonomy before proceeding. */
    if ( !current_user_can( $tax->cap->assign_terms ) )
      return;

    /* Get the terms of the 'group' taxonomy. */
    $terms = get_terms( 'group-events-forms', array( 'hide_empty' => false ) );

		include_once plugin_dir_path( __FILE__ ). 'partials/emc-custom-events-forms-admin-display-user-groups.php';
  }

  /**
   * Saves the term selected on the edit user/profile page in the admin.
   * This function is triggered when the page
   * is updated.  We just grab the posted data and use wp_set_object_terms() to save it.
   *
   * @param int $user_id The ID of the user to save the terms for.
   */
  public function my_save_user_group_terms( $user_id ) {

    $tax = get_taxonomy( 'group-events-forms' );

    /* Make sure the current user can edit the user and assign terms before proceeding. */
    if ( !current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) )
      return false;

    $terms = $_POST['group-events-forms'];

     wp_set_object_terms( $user_id, $terms , 'group-events-forms', false);
     clean_object_term_cache( $user_id, 'group-events-forms' );
  }
  /**
   * Disables the 'group' username when someone registers.
   * This is to avoid any conflicts with the custom
   * 'author/group' slug used for the 'rewrite' argument when registering the
   * 'group' taxonomy.  This  will cause WordPress to output an error that the
   * username is invalid if it matches 'group'.
   *
   * @param string $username The username of the user before registration is complete.
   */
  public function my_disable_username( $username ) {

    if ( 'group-events-forms' === $username )
      $username = '';

    return $username;
  }

  public function events_meta_box_template( $template ) {
    $template = plugin_dir_path( __FILE__ ). 'partials/emc-custom-events-forms-admin-events-meta-box.php';

    return $template;
  }

  public function events_event_meta_box_template( $template ) {
    $template = plugin_dir_path( __FILE__ ). 'partials/emc-custom-events-forms-admin-events-event-meta-box.php';

    return $template;
  }
}
