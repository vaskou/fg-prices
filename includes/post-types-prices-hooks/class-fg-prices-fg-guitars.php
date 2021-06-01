<?php

class FG_Prices_FG_Guitars extends FG_Prices_Post_Types_Prices_Hooks {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		$this->price_meta_key                = 'fgg_pricing_price';
		$this->multicurrency_prices_meta_key = 'fgg_pricing_multicurrency_prices';

		add_filter( 'fg_guitars_pricing_fields', array( $this, 'post_type_fields' ) );
		add_filter( 'fg_guitars_post_type_get_price', array( $this, 'post_type_get_price' ), 10, 2 );
		add_filter( 'fg_guitars_post_type_get_extra_option_price', array( $this, 'post_type_get_extra_option_price' ), 10, 3 );
	}

	public function post_type_fields( $fields ) {
		$fields = parent::post_type_fields( $fields );

		if ( ! empty( $fields['pricing_items']['fields']['extra_option_price'] ) ) {

			$fields['pricing_items']['fields']['extra_option_price']['before_field'] = '<label>' . FG_Prices_Settings::instance()->get_old_currency() . '</label>&nbsp;';

			$fields['pricing_items']['fields']['multicurrency_prices'] = array(
				'name' => $fields['pricing_items']['fields']['extra_option_price']['name'] . ' (' . __( 'Extra Currencies', 'fg-prices' ) . ')',
				'type' => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
			);

		}

		return $fields;

	}

	public function post_type_get_extra_option_price( $price,  $item, $post_id ) {

		$old_currency = FG_Prices_Settings::instance()->get_old_currency();

		$multicurrency_prices = ! empty( $item['multicurrency_prices'] ) ? $item['multicurrency_prices'] : array();

		if ( ! empty( $old_currency ) ) {
			$multicurrency_prices[ $old_currency ] = $price;
		}

		return apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );
	}

}