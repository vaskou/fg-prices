<?php

class FG_Prices {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );

		FG_Prices_Dependencies::instance();
		FG_Prices_Settings::instance();
		FG_Prices_FG_Available_Guitars::instance();
		FG_Prices_FG_Guitars::instance();
		FG_Prices_FG_Pickups::instance();
	}

	public function on_plugins_loaded() {
		load_plugin_textdomain( 'fg-prices', false, FG_PRICES_PLUGIN_DIR_NAME . '/languages/' );
	}
}