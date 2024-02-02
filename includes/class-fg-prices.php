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
		add_action( 'plugins_loaded', array( $this, 'includes' ) );

		add_action( 'plugins_loaded', array( $this, 'init_classes' ) );

		add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );

		add_filter( 'fg_prices_get_multicurrency_prices', array( $this, 'get_multicurrency_prices' ), 10, 2 );
		add_filter( 'fremediti_guitars_get_current_currency_symbol', array( $this, 'get_current_currency_symbol' ) );
		add_filter( 'fremediti_guitars_get_current_currency', array( $this, 'get_current_currency' ) );
		add_filter( 'fremediti_guitars_get_currency_symbol', array( $this, 'get_currency_symbol' ), 10, 2 );
		add_filter( 'fg_prices_get_current_currency', array( $this, 'get_current_currency' ) );
	}

	public function includes() {
		include 'class-fg-prices-currencies.php';
		include 'class-fg-prices-dependencies.php';
		include 'class-fg-prices-enqueues.php';
		include 'class-fg-prices-settings.php';

		include 'cmb2-fields/cmb2-multicurrency-prices/cmb2-multicurrency-prices.php';

		include 'post-types-prices-hooks/abstract-class-fg-prices-post-types-prices-hooks.php';
		include 'post-types-prices-hooks/class-fg-prices-fg-available-guitars.php';
		include 'post-types-prices-hooks/class-fg-prices-fg-guitars.php';
		include 'post-types-prices-hooks/class-fg-prices-fg-pickups.php';
	}

	public function init_classes() {
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

		return $multicurrency_prices[ $current_currency ] ?? '';
	}

	public function get_currency_symbol( $currency_symbol, $currency ) {
		$currency_symbols = FG_Prices_Currencies::get_currency_symbols();

		return ! empty( $currency_symbols[ $currency ] ) ? $currency_symbols[ $currency ] : $currency_symbol;
	}

	public function get_current_currency_symbol( $currency_symbol ) {
		$current_currency_symbol = FG_Prices_Currencies::get_current_currency_symbol();

		return ! empty( $current_currency_symbol ) ? $current_currency_symbol : $currency_symbol;
	}

	public function get_current_currency( $current_currency ) {

		if ( ! FG_Prices_Settings::get_enable_geoip_rule() ) {
			return $current_currency;
		}

		if ( function_exists( 'geoip_detect2_get_info_from_current_ip' ) ) {
			$info               = geoip_detect2_get_info_from_current_ip();
			$country_code       = $info->country->isoCode;
			$european_countries = FG_Prices_Currencies::get_european_union_countries();

			if ( in_array( $country_code, $european_countries ) ) {
				$current_currency = 'EUR';
			} else {
				$current_currency = 'USD';
			}
		}

		return $current_currency;
	}
}