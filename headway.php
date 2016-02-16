<?php
/**
 * Plugin Name: Headway
 * Description: A plugin to integrate with headwayapp.co
 * Author: Connor Burton
 * Author URI: http://connorburton.com/
 * Version: 0.1
 * Text Domain: headway
 * License: GPL2
 Copyright 2016 Connor Burton (email : hello@connorburton.com)
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 2, as
 published by the Free Software Foundation.
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 */

define( 'HEADWAY_VERSION', '0.1' );
define( 'HEADWAY_PATH', dirname( __FILE__ ) );
define( 'HEADWAY_PATH_INCLUDES', dirname( __FILE__ ) . '/inc' );
define( 'HEADWAY_FOLDER', basename( HEADWAY_PATH ) );
define( 'HEADWAY_URL', plugins_url() . '/' . HEADWAY_FOLDER );
define( 'HEADWAY_URL_INCLUDES', HEADWAY_URL . '/inc' );

class Headway_Plugin_Base {
	public function __construct() {
		add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_item' ) );

		add_action( 'admin_menu', array( $this, 'admin_pages_callback' ) );

		add_action( 'admin_init', array( $this, 'register_settings' ), 5 );

		add_action( 'admin_footer', array( $this, 'load_badge' ) );
	}

	public function add_admin_bar_item( $wp_admin_bar ) {
		$wp_admin_bar->add_menu(array(
			'id' => 'headway',
			'title' => 'Changelog',
			'meta' => array(
				'class' => 'attach_headway_badge'
			)
		));
	}

	public function admin_pages_callback() {
		add_options_page( __( 'Headway', 'headway' ), __( 'Headway', 'headway' ), 'manage_options', 'headway-settings', array( $this, 'plugin_subpage' ) );
	}

	public function plugin_subpage() {
		include_once( HEADWAY_PATH_INCLUDES . '/settings.php' );
	}

	public function register_settings() {
		require_once( HEADWAY_PATH . '/headway-plugin-settings.class.php' );
		new Headway_Plugin_Settings();
	}

	public function load_badge() {
		$settings = get_option('headway_setting');

		if( ! empty( $settings ) ) {
		?>
			<style>
				.attach_headway_badge > div
				{
				float: left;
				}

				#HW_badge_cont
				{
				float: left;
				}

				#HW_frame_peak
				{
				top: -5px !important;
				}

				#HW_frame_cont
				{
				z-index: 15000 !important;
				}
			</style>
			<script>
			  var HW_config = {
			    selector: '.attach_headway_badge', // CSS selector where to inject the badge
			    account: "<?php echo $settings['headway_account_id']; ?>" // your account ID
			  };
			</script>
			<script async src="//cdn.headwayapp.co/widget.js"></script>
		<?php
		}
	}
}

$headway_plugin_base = new Headway_Plugin_Base();