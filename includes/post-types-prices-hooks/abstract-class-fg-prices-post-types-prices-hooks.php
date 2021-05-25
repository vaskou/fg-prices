<?php

abstract class FG_Prices_Post_Types_Prices_Hooks {

	protected $price_meta_key;
	protected $multicurrency_prices_meta_key;

	public function price_field_type( $field_type ) {
		return 'hidden';
	}

	public function post_type_fields( $fields ) {
		if ( ! empty( $fields['price'] ) ) {
			$temp_fields = array();

			foreach ( $fields as $key => $field ) {
				$temp_fields[ $key ] = $field;
				if ( 'price' == $key ) {
					$temp_fields['multicurrency_prices'] = array(
						'name' => $fields['price']['name'] . ' (' . __( 'Extra Currencies', 'fg-prices' ) . ')',
						'type' => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
					);
				}
			}

			$fields = $temp_fields;

			$fields['price']['before_field'] = '<label>' . FG_Prices_Settings::instance()->get_old_currency() . '</label>&nbsp;';
		}

		return $fields;
	}

	public function post_type_get_price( $price, $post_id ) {

		$old_currency = FG_Prices_Settings::instance()->get_old_currency();

		$multicurrency_prices = get_post_meta( $post_id, $this->multicurrency_prices_meta_key, true );

		$multicurrency_prices = ! empty( $multicurrency_prices ) ? $multicurrency_prices : array();

		if ( ! empty( $old_currency ) ) {
			$multicurrency_prices[ $old_currency ] = $price;
		}

		return apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );
	}

}