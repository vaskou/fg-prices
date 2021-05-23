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
		add_filter( 'fg_prices_get_multicurrency_prices', array( $this, 'get_multicurrency_prices' ), 10, 2 );
		add_filter( 'fremediti_guitars_get_currency_symbol', array( $this, 'get_currency_symbol' ) );

		FG_Prices_Enqueues::instance();
		FG_Prices_Dependencies::instance();
		FG_Prices_Settings::instance();
		FG_Prices_FG_Available_Guitars::instance();
		FG_Prices_FG_Guitars::instance();
		FG_Prices_FG_Pickups::instance();
	}

	public function on_plugins_loaded() {
		load_plugin_textdomain( 'fg-prices', false, FG_PRICES_PLUGIN_DIR_NAME . '/languages/' );
	}

	public function get_multicurrency_prices( $price, $multicurrency_prices ) {

		$current_currency = FG_Prices_Currencies::get_current_currency();

		if ( isset( $multicurrency_prices[ $current_currency ] ) ) {
			$price = $multicurrency_prices[ $current_currency ];
		}

		return $price;
	}

	public function get_currency_symbol( $currency_symbol ) {
		$current_currency_symbol = FG_Prices_Currencies::get_current_currency_symbol();

		return ! empty( $current_currency_symbol ) ? $current_currency_symbol : $currency_symbol;
	}
}