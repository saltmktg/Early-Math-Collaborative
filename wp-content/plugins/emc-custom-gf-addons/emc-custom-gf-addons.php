<?php
/**
 * Plugin Name: EMC Custom GF Add-ons
 * Description: Create new settings to Gravity Forms
 * Version: 1.0
 * Author: Saucal
 * Author URI: http://saucal.com
 * License: GPLv2+
 * Text Domain: custom-gf-addons
 */

if ( class_exists( 'GFForms' ) ) {
	GFForms::include_addon_framework();
	class GFSimpleAddOn extends GFAddOn {
		protected $_version = '1.0';
		protected $_min_gravityforms_version = '1.9';
		protected $_slug = 'emc-custom-gf-addons';
		protected $_path = 'emc-custom-gf-addons/emc-custom-gf-addons.php';
		protected $_full_path = __FILE__;
		protected $_title = 'Gravity Forms Event Settings';
		protected $_short_title = 'Events Settings';

		public function pre_init() {
			parent::pre_init();
			// add tasks or filters here that you want to perform during the class constructor - before WordPress has been completely initialized
		}

		public function init() {
			parent::init();
			// add tasks or filters here that you want to perform both in the backend and frontend and for ajax requests
		}

		public function init_admin() {
			parent::init_admin();
			// add tasks or filters here that you want to perform only in admin
		}

		public function init_frontend() {
			parent::init_frontend();
			// add tasks or filters here that you want to perform only in the front end
		}

		public function init_ajax() {
			parent::init_ajax();
			// add tasks or filters here that you want to perform only during ajax requests
		}

		public function form_settings_fields($form) {
			$users = get_users( array( 'orderby' => 'display_name' ) );
			$users_as_options = array();
			foreach ( $users as $user ) {
				$users_as_options[] = array(
					'label' => $user->data->display_name,
					'value' => $user->ID,
				);
			}
			return array(
				array(
					"title"  => "Form Event Settings",
					"fields" => array(
						array(
							"label"   => "Disable for all",
							"type"    => "checkbox",
							"name"    => "disable_for_all",
							"tooltip" => "Checking this box you will hide this form on all events.",
							"choices" => array(
								array(
									"label" => "Disable",
									"name"  => "disable"
								)
							)
						),
						array(
							"label"    => "Disable for these users",
							"type"     => "select",
							"name"     => "disable_for_users[]",
							"tooltip"  => "The selected users can't see this form on events.",
							"multiple" => "multiple",
							"choices"  => $users_as_options,
						),
					)
				)
			);
		}

		public function scripts() {
			$scripts = array(
				array(
					'handle'    => 'chosen',
					'src'       => $this->get_base_url() . '/assets/chosen.jquery.min.js',
					'version'   => $this->_version,
					'deps'      => array( 'jquery' ),
					'in_footer' => false,
					'enqueue'   => array(
						array(
							'admin_page' => array( 'form_settings' ),
							'tab'        => 'emc-custom-gf-addons'
						)
					)
				),
				array(
					'handle'    => 'emc-sutom-gf-addons',
					'src'       => $this->get_base_url() . '/assets/admin.js',
					'version'   => $this->_version,
					'deps'      => array( 'jquery', 'chosen' ),
					'in_footer' => false,
					'enqueue'   => array(
						array(
							'admin_page' => array( 'form_settings' ),
							'tab'        => 'emc-custom-gf-addons'
						)
					)
				),
			);

			return array_merge( parent::scripts(), $scripts );
		}

		public function styles() {
			$styles = array(
				array(
					'handle'  => 'chosen',
					'src'     => $this->get_base_url() . '/assets/chosen.css',
					'version' => $this->_version,
					'enqueue' => array(
						array(
							'admin_page' => array( 'form_settings' ),
							'tab'        => 'emc-custom-gf-addons'
						)
					)
				)
			);

			return array_merge(parent::styles(), $styles);
		}
	}

	new GFSimpleAddOn();
}