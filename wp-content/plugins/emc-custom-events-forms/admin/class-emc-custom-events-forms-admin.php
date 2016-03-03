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
      if ( is_array( $term ) || is_object( $term ) ) {
        $term_id = $term->term_id;
      } else {
        $term_id = $term;
      }

      $term_coaches = array_filter( (array)get_field( 'group_coaches', 'group-events-forms_' . $term_id ) );
      $term_teachers = array_filter( (array)get_field( 'group_teachers', 'group-events-forms_' . $term_id ) );

      $term_count = count( $term_coaches) + count( $term_teachers );

      do_action( 'edit_term_taxonomy', $term, $taxonomy );
      $wpdb->update( $wpdb->term_taxonomy, array( 'count' => $term_count ), array( 'term_id' => $term_id ) );
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

  public function my_update_post_meta( $meta_id, $object_id, $meta_key, $_meta_value ) {
    if ( wp_is_post_revision( $object_id ) )
      return;
    if ( 'tribe_events' != get_post_type( $object_id ) )
      return;
    if ( '_EventStartDate' != $meta_key )
      return;

    $old_event_start_date = get_post_meta( $object_id, '_EventStartDate', true );
    $new_event_start_date = $_meta_value;

    if ( $old_event_start_date != $new_event_start_date ) {
      $old_data = get_post_meta( $object_id, 'rescheduled', true );
      $new_data = array(
        'from' => $old_event_start_date,
        'to' => $new_event_start_date
        );

      if ( end( $old_data ) == $new_data )
        return;

      if ( ! $old_data ) {
        $old_data = array();
      }

      array_push( $old_data, $new_data );
      update_post_meta( $object_id, 'rescheduled', $old_data );
    }
  }

  function my_new_event_send_email( $new_status, $old_status, $post ) {
    if ( ! in_array( $old_status, array( 'draft', 'auto-draft' ) ) && 'publish' != $new_status )
      return;
    if ( wp_is_post_revision( $post->ID ) )
      return;

    $post_url = get_permalink( $post->ID );
    $subject = 'New event';

    $message = "A new event has been created on your website:\n\n";
    $message .= get_the_title( $post->ID ) . ": " . $post_url;

  // Send email to admin.
    wp_mail( 'paulo@saucal.com', $subject, $message );
  }

  /**
 * First create the dropdown
 * make sure to change POST_TYPE to the name of your custom post type
 *
 * @author Ohad Raz
 *
 * @return void
 */
  function my_admin_posts_filter_restrict_manage_posts(){
    $type = 'post';
    if (isset($_GET['post_type'])) {
      $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('tribe_events' == $type){
        //change this to the list of values you want to show
        //in 'label' => 'value' format
      $values = array(
        'Rescheduled' => 'rescheduled',
        'Canceled' => 'canceled',
        );
        ?>
        <select name="event_status">
          <option value=""><?php _e('All Event Status'); ?></option>
          <?php
          $current_v = isset($_GET['event_status'])? $_GET['event_status']:'';
          foreach ($values as $label => $value) {
            printf
            (
              '<option value="%s"%s>%s</option>',
              $value,
              $value == $current_v? ' selected="selected"':'',
              $label
              );
          }
          ?>
        </select>
        <?php
      }
    }

  /**
 * if submitted filter by post meta
 *
 * make sure to change META_KEY to the actual meta key
 * and POST_TYPE to the name of your custom post type
 * @author Ohad Raz
 * @param  (wp_query object) $query
 *
 * @return Void
 */
  function my_posts_filter( $query ){
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
      $type = $_GET['post_type'];
    }
    if ( 'tribe_events' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['event_status']) && $_GET['event_status'] != '') {
      switch ( $_GET['event_status'] ) {
        case 'rescheduled':
          $query->set( 'meta_key', 'rescheduled' );
          $query->set( 'meta_compare', 'EXISTS' );
          break;
        case 'canceled':
          $query->set( 'post_status', 'canceled' );
          break;
      }
    }
    return $query;
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

  function my_add_custom_columns( $columns ) {
    return array_merge( $columns, array( 'rescheduled' => __( 'Rescheduled' ) ) );
  }

  function my_custom_columns( $column, $post_id ) {
    switch ( $column ) {
      case 'rescheduled':
        $rescheduled_data = get_post_meta( $post_id, 'rescheduled', true );
        if ( $rescheduled_data ) {
          printf( ngettext( "Yes (%d time)", "Yes (%d times)", count( $rescheduled_data ) ), count( $rescheduled_data ) );
        } else {
          echo 'No';
        }
      break;
    }
  }
}
