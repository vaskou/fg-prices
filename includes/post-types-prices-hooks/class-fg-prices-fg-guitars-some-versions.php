<?php

class FG_Prices_FG_Guitars_Some_Versions extends FG_Prices_Post_Types_Prices_Hooks {

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

		add_filter( 'fg_guitars_some_versions_fields', array( $this, 'post_type_fields' ) );
		add_filter( 'fg_guitars_some_versions__featured_guitar_price', [ $this, 'get_featured_guitar_price' ], 10, 2 );
		add_filter( 'fg_guitars_some_versions__price_range_from', [ $this, 'get_price_range_from' ], 10, 2 );
		add_filter( 'fg_guitars_some_versions__price_range_to', [ $this, 'get_price_range_to' ], 10, 2 );
	}

	public function post_type_fields( $fields ) {
		$price_field_names = [
			'featured_guitar_price',
			'price_range_from',
			'price_range_to',
		];

		foreach ( $price_field_names as $field_name ) {

			if ( ! empty( $fields[ $field_name ] ) ) {
				$temp_fields = array();

				foreach ( $fields as $key => $field ) {
					$temp_fields[ $key ] = $field;
					if ( $field_name == $key ) {
						$temp_fields[ 'multicurrency_' . $field_name ] = array(
							'name' => $fields[ $field_name ]['name'] . ' (' . __( 'Extra Currencies', 'fg-prices' ) . ')',
							'type' => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
						);
					}
				}

				$fields = $temp_fields;

				$fields[ $field_name ]['before_field'] = '<label>' . FG_Prices_Settings::instance()->get_old_currency() . '</label>&nbsp;';
			}

		}

		return $fields;
	}

	public function get_featured_guitar_price( $price, $post_id ) {
		$old_currency = FG_Prices_Settings::instance()->get_old_currency();

		$multicurrency_prices = get_post_meta( $post_id, 'fgg_some_versions_multicurrency_featured_guitar_price', true );

		$multicurrency_prices = ! empty( $multicurrency_prices ) ? $multicurrency_prices : array();

		if ( ! empty( $old_currency ) ) {
			$multicurrency_prices[ $old_currency ] = $price;
		}

		return apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );
	}

	public function get_price_range_from( $price, $post_id ) {
		$old_currency = FG_Prices_Settings::instance()->get_old_currency();

		$multicurrency_prices = get_post_meta( $post_id, 'fgg_some_versions_multicurrency_price_range_from', true );

		$multicurrency_prices = ! empty( $multicurrency_prices ) ? $multicurrency_prices : array();

		if ( ! empty( $old_currency ) ) {
			$multicurrency_prices[ $old_currency ] = $price;
		}

		return apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );
	}

	public function get_price_range_to( $price, $post_id ) {
		$old_currency = FG_Prices_Settings::instance()->get_old_currency();

		$multicurrency_prices = get_post_meta( $post_id, 'fgg_some_versions_multicurrency_price_range_to', true );

		$multicurrency_prices = ! empty( $multicurrency_prices ) ? $multicurrency_prices : array();

		if ( ! empty( $old_currency ) ) {
			$multicurrency_prices[ $old_currency ] = $price;
		}

		return apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );
	}

}