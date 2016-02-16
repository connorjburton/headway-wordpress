<?php

class Headway_Plugin_Settings {
	
	private $headway_setting;
	/**
	 * Construct me
	 */
	public function __construct() {
		$this->headway_setting = get_option( 'headway_setting', '' );
		
		// register the checkbox
		add_action('admin_init', array( $this, 'register_settings' ) );
	}
		
	/**
	 * Setup the settings
	 */
	public function register_settings() {
		register_setting( 'headway_setting', 'headway_setting', array( $this, 'headway_validate_settings' ) );
		
		add_settings_section(
			'headway_settings_section',
			'',
			array($this, 'headway_settings_callback'),
			'headway-plugin-base'
		);
		
		add_settings_field(
			'headway_account_id',
			__( "Headway Account ID: ", 'headwaybase' ),
			array( $this, 'headway_account_id_callback' ),
			'headway-plugin-base',
			'headway_settings_section'
		);
	}
	
	public function headway_settings_callback() {
		echo _e( "You can find your details by logging into <a href='https://headwayapp.co/'' target='_blank'>https://headwayapp.co/</a>", 'headwaybase' );
	}
	
	public function headway_account_id_callback() {
		$out = '';
		$val = '';
		
		if(! empty( $this->headway_setting ) && isset ( $this->headway_setting['headway_account_id'] ) ) {
			$val = $this->headway_setting['headway_account_id'];
		}

		$out = '<input type="text" id="headway_account_id" name="headway_setting[headway_account_id]" value="' . $val . '"  />';
		
		echo $out;
	}
	
	/**
	 * Helper Settings function if you need a setting from the outside.
	 * 
	 * Keep in mind that in our demo the Settings class is initialized in a specific environment and if you
	 * want to make use of this function, you should initialize it earlier (before the base class)
	 * 
	 * @return boolean is enabled
	 */
	public function is_enabled() {
		if(! empty( $this->headway_setting ) && isset ( $this->headway_setting['headway_opt_in'] ) ) {
			return true;
		}
		return false;
	}
	
	/**
	 * Validate Settings
	 * 
	 * Filter the submitted data as per your request and return the array
	 * 
	 * @param array $input
	 */
	public function headway_validate_settings( $input ) {
		
		return $input;
	}
}
