<?php

class FG_Prices_FG_Available_Guitars extends FG_Prices_Post_Types_Prices_Hooks {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		$this->price_meta_key                = 'fg_available_guitars_price';
		$this->multicurrency_prices_meta_key = 'fg_available_guitars_multicurrency_prices';
		
		add_filter( 'fg_available_guitars_fields', array( $this, 'post_type_fields' ) );
		add_filter( 'fg_available_guitars_post_type_get_price', array( $this, 'post_type_get_price' ), 10, 2 );
	}

}