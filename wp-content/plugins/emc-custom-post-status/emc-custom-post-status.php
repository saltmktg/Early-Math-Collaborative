<?php
/**
 * Plugin Name: EMC Custom Post Status
 * Description: Allows posts and pages to be canceled so you can unpublish content without having to trash it.
 * Version: 1.0
 * Author: Saucal
 * Author URI: http://saucal.com
 * License: GPLv2+
 * Text Domain: custom-post-status
 */

define( 'CANCELED_POST_STATUS_PLUGIN', plugin_basename( __FILE__ ) );

define( 'CANCELED_POST_STATUS_DIR', plugin_dir_path( __FILE__ ) );

define( 'CANCELED_POST_STATUS_URL', plugin_dir_url( __FILE__ ) );

define( 'CANCELED_POST_STATUS_LANG_PATH', dirname( CANCELED_POST_STATUS_PLUGIN ) . '/languages' );

/**
 * Load languages
 *
 * @action plugins_loaded
 */
function emc_cps_i18n() {

	load_plugin_textdomain( 'canceled-post-status', false, CANCELED_POST_STATUS_LANG_PATH );

}

add_action( 'plugins_loaded', 'emc_cps_i18n' );

/**
 * Translations strings placeholder function
 *
 * Translation strings that are not used elsewhere but Plugin Title and Description
 * are helt here to be picked up by Poedit. Keep these in sync with the actual plugin's
 * title and description.
 */
function emc_cps_i18n_strings() {

	__( 'Canceled Post Status', 'canceled-post-status' );

	__( 'Allows posts and pages to be canceled so you can unpublish content without having to trash it.', 'canceled-post-status' );

}

/**
 * Register a custom post status for Canceled
 *
 * @action init
 */
function emc_cps_register_canceled_post_status() {

	$args = array(
		'label'                     => __( 'Canceled', 'canceled-post-status' ),
		'public'                    => (bool) apply_filters( 'emc_cps_status_arg_public', emc_cps_current_user_can_view() ),
		'private'                   => (bool) apply_filters( 'emc_cps_status_arg_private', true ),
		'exclude_from_search'       => (bool) apply_filters( 'emc_cps_status_arg_exclude_from_search', ! emc_cps_current_user_can_view() ),
		'show_in_admin_all_list'    => (bool) apply_filters( 'emc_cps_status_arg_show_in_admin_all_list', emc_cps_current_user_can_view() ),
		'show_in_admin_status_list' => (bool) apply_filters( 'emc_cps_status_arg_show_in_admin_status_list', emc_cps_current_user_can_view() ),
		'label_count'               => _n_noop( 'Canceled <span class="count">(%s)</span>', 'Canceled <span class="count">(%s)</span>', 'canceled-post-status' ),
	);

	register_post_status( 'canceled', $args );

}

add_action( 'init', 'emc_cps_register_canceled_post_status' );

/**
 * Returns TRUE if on the frontend, otherwise FALSE
 *
 * @filter emc_cps_status_arg_exclude_from_search
 *
 * @return bool
 */
function emc_cps_is_frontend() {

	return ! is_admin();

}

add_filter( 'emc_cps_status_arg_exclude_from_search', 'emc_cps_is_frontend' );

/**
 * Returns TRUE if current user can view, otherwise FALSE
 *
 * @return bool
 */
function emc_cps_current_user_can_view() {

	/**
	 * Default capability to grant ability to view Canceled content
	 *
	 * @since 0.3.0
	 *
	 * @return string
	 */
	$capability = (string) apply_filters( 'emc_cps_default_read_capability', 'read_private_posts' );

	return current_user_can( $capability );

}

/**
 * Filter canceled post titles on the frontend
 *
 * @param string $title
 * @param int    $post_id (optional)
 *
 * @return string
 */
function emc_cps_the_title( $title, $post_id = null ) {

	$post = get_post( $post_id );

	if (
		! is_admin()
		&&
		isset( $post->post_status )
		&&
		'canceled' === $post->post_status
	) {

		$title = sprintf( '%s: %s', __( 'Canceled', 'canceled-post-status' ), $title );

	}

	return $title;

}
add_filter( 'the_title', 'emc_cps_the_title', 10, 2 );

/**
 * Check if a post type should NOT be using the Canceled status
 *
 * @param string $post_type
 *
 * @return bool
 */
function emc_cps_is_included_post_type( $post_type ) {

	/**
	 * Prevent the Canceled status from being used on all post types
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	$included = (array) apply_filters( 'emc_cps_included_post_types', array( 'tribe_events' ) );

	if ( in_array( $post_type, $included ) ) {

		return true;

	}

	return false;

}

/**
 * Modify the DOM on post screens
 *
 * @action admin_footer-post.php
 */
function emc_cps_post_screen_js() {

	global $post;

	if ( ! emc_cps_is_included_post_type( $post->post_type ) ) {

		return;

	}

	if ( 'draft' !== $post->post_status && 'pending' !== $post->post_status ) {

		?>
		<script>
		jQuery( document ).ready( function( $ ) {
			$( '#post_status' ).append( '<option value="canceled"><?php esc_html_e( 'Canceled', 'canceled-post-status' ) ?></option>' );
		});
		</script>
		<?php

	}

}

add_action( 'admin_footer-post.php', 'emc_cps_post_screen_js' );

/**
 * Modify the DOM on edit screens
 *
 * @action admin_footer-edit.php
 */
function emc_cps_edit_screen_js() {

	global $typenow;

	if ( ! emc_cps_is_included_post_type( $typenow ) ) {

		return;

	}

	?>
	<script>
	jQuery( document ).ready( function( $ ) {
		$rows = $( '#the-list tr.status-canceled' );

		/*$.each( $rows, function() {
			disallowEditing( $( this ) );
		});*/

		$( 'select[name="_status"]' ).append( '<option value="canceled"><?php esc_html_e( 'Canceled', 'canceled-post-status' ) ?></option>' );

		$( '.editinline' ).on( 'click', function() {
			var $row        = $( this ).closest( 'tr' ),
			    $option     = $( '.inline-edit-row' ).find( 'select[name="_status"] option[value="canceled"]' ),
			    is_canceled = $row.hasClass( 'status-canceled' );

			$option.prop( 'selected', is_canceled );
		});

		$( '.inline-edit-row' ).on( 'remove', function() {
			var id   = $( this ).prop( 'id' ).replace( 'edit-', '' ),
			    $row = $( '#post-' + id );

			if ( $row.hasClass( 'status-canceled' ) ) {
				disallowEditing( $row );
			}
		});

		function disallowEditing( $row ) {
			var title = $row.find( '.column-title a.row-title' ).text();

			$row.find( '.column-title a.row-title' ).replaceWith( title );
			$row.find( '.row-actions .edit' ).remove();
		}
	});
	</script>
	<?php

}

add_action( 'admin_footer-edit.php', 'emc_cps_edit_screen_js' );

/**
 * Prevent canceled content from being edited
 *
 * @action load-post.php
 */
function emc_cps_load_post_screen() {

	$post_id = (int) filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT );

	$post = get_post( $post_id );

	if (
		is_null( $post )
		||
		! emc_cps_is_included_post_type( $post->post_type )
		||
		'canceled' !== $post->post_status
	) {

		return;

	}

	$action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_STRING );

	$message = (int) filter_input( INPUT_GET, 'message', FILTER_SANITIZE_NUMBER_INT );

	// Redirect to list table after saving as Canceled
	if ( 'edit' === $action && 1 === $message ) {

		wp_safe_redirect(
			add_query_arg(
				array(
					'post_type' => $post->post_type,
				),
				admin_url( 'edit.php' )
			),
			302
		);

		exit;

	}

	wp_die(
		__( "You can't edit this item because it has been Canceled. Please change the post status and try again.", 'canceled-post-status' ),
		translate( 'WordPress &rsaquo; Error' )
	);

}

add_action( 'load-post.php', 'emc_cps_load_post_screen' );

/**
 * Display custom post state text next to post titles that are Canceled
 *
 * @filter display_post_states
 *
 * @param array  $post_states  An array of post display states
 * @param object $post         WP_Post
 *
 * @return array
 */
function emc_cps_display_post_states( $post_states, $post ) {

	if (
		! emc_cps_is_included_post_type( $post->post_type )
		||
		'canceled' !== $post->post_status
		||
		'canceled' === get_query_var( 'post_status' )
	) {

		return $post_states;

	}

	return array_merge(
		$post_states,
		array(
			'canceled' => __( 'Canceled', 'canceled-post-status' ),
		)
	);

}

add_filter( 'display_post_states', 'emc_cps_display_post_states', 10, 2 );

/**
 * Close comments and pings when content is canceled
 *
 * @action save_post
 *
 * @param int    $post_id  Post ID
 * @param object $post     WP_Post
 * @param bool   $update   Whether this is an existing post being updated or not
 */
function emc_cps_save_post( $post_id, $post, $update ) {

	if (
		! emc_cps_is_included_post_type( $post->post_type )
		||
		wp_is_post_revision( $post )
	) {

		return;

	}

	if ( 'canceled' === $post->post_status ) {

		// Unhook to prevent infinite loop
		remove_action( 'save_post', __FUNCTION__ );

		$args = array(
			'ID'             => $post->ID,
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		);

		wp_update_post( $args );

		// Add hook back again
		add_action( 'save_post', __FUNCTION__, 10, 3 );

	}

}

add_action( 'save_post', 'emc_cps_save_post', 10, 3 );

/**
 * Adds a post meta to log the cancel time
 *
 * @param object $post
 */
function emc_cps_post_canceled( $post ) {
	update_post_meta( $post->ID, 'canceled', date( 'Y-m-d H:i' ) );
}
add_filter( 'publish_to_canceled', 'emc_cps_post_canceled');

/**
 * Adds a post meta to log the cancel time
 *
 * @param object $post
 */
function emc_cps_remove_canceled_from_frontend( $query ) {
	if ( ! $query->is_admin() && $query->is_main_query() && 'tribe_events' == $query->query_vars['post_type'] ) {
		$query->set( 'post_status', 'publish' );
	}
}
add_filter( 'pre_get_posts', 'emc_cps_remove_canceled_from_frontend');