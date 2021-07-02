<?php

class FG_Prices_FG_Pickups extends FG_Prices_Post_Types_Prices_Hooks {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		$this->price_meta_key                = 'fgp_specifications_price';
		$this->multicurrency_prices_meta_key = 'fgp_specifications_multicurrency_prices';

		add_filter( 'fg_pickups_specifications_fields', array( $this, 'post_type_fields' ) );
		add_filter( 'fg_pickups_post_type_get_price', array( $this, 'post_type_get_price' ), 10, 2 );
		add_filter( 'fg_pickups_post_type_get_price_set', array( $this, 'post_type_get_price_set' ), 10, 2 );
	}

	public function post_type_fields( $fields ) {
		$fields = parent::post_type_fields( $fields );

		if ( ! empty( $fields['price_set'] ) ) {
			$temp_fields = array();

			foreach ( $fields as $key => $field ) {
				$temp_fields[ $key ] = $field;
				if ( 'price_set' == $key ) {
					$temp_fields['multicurrency_prices_set'] = array(
						'name' => $fields['price_set']['name'] . ' (' . __( 'Extra Currencies', 'fg-prices' ) . ')',
						'type' => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
					);
				}
			}

			$fields = $temp_fields;

			$fields['price_set']['before_field'] = '<label>' . FG_Prices_Settings::instance()->get_old_currency() . '</label>&nbsp;';
		}

		return $fields;
	}

	public function post_type_get_price_set( $price, $post_id ) {

		$old_currency = FG_Prices_Settings::instance()->get_old_currency();

		$multicurrency_prices = get_post_meta( $post_id, 'fgp_specifications_multicurrency_prices_set', true );

		$multicurrency_prices = ! empty( $multicurrency_prices ) ? $multicurrency_prices : array();

		if ( ! empty( $old_currency ) ) {
			$multicurrency_prices[ $old_currency ] = $price;
		}

		return apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );
	}

}