<?php

class FG_Prices_Enqueues {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	public function admin_enqueue_styles() {
		$prefix = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';

		$filename = '/assets/css/core' . $prefix . '.css';
		$version  = $this->_get_file_version( $filename );
		wp_enqueue_style( 'fg-prices-select2-style', FG_PRICES_PLUGIN_URL . $filename, array(), $version, 'all' );
	}

	public function admin_enqueue_scripts() {
		$prefix = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';

		$filename = '/assets/js/select2' . $prefix . '.js';
		$version  = $this->_get_file_version( $filename );
		wp_enqueue_script( 'fg-prices-select2-script', FG_PRICES_PLUGIN_URL . $filename, array( 'jquery' ), $version, true );

		$filename = '/assets/js/scripts' . $prefix . '.js';
		$version  = $this->_get_file_version( $filename );
		wp_enqueue_script( 'fg-prices-admin-scripts', FG_PRICES_PLUGIN_URL . $filename, array( 'jquery', 'fg-prices-select2-script' ), $version, true );
	}

	private function _get_file_version( $filename ) {

		$filename = FG_PRICES_PLUGIN_DIR_PATH . $filename;

		$filetime = file_exists( $filename ) ? filemtime( $filename ) : '';

		return FG_PRICES_VERSION . ( ! empty( $filetime ) ? '-' . $filetime : '' );
	}
}