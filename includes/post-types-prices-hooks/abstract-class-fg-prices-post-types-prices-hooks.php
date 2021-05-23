<?php

abstract class FG_Prices_Post_Types_Prices_Hooks {

	protected $price_meta_key;
	protected $multicurrency_prices_meta_key;

	protected function __construct() {
//		add_filter( 'fg_prices_cmb_multicurrency_prices_after_sanitization', array( $this, 'save_default_price' ), 10, 5 );
	}

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

			$fields['price']['before_field'] = '<label>' . FG_Prices_Settings::instance()->get_default_currency() . '</label>&nbsp;';

//			$fields['price']['sanitization_cb'] = array( $this, 'old_price_sanitization' );
		}

		return $fields;
	}

	public function post_type_get_price( $price, $post_id ) {

		$default_currency = FG_Prices_Settings::instance()->get_default_currency();

		$multicurrency_prices = get_post_meta( $post_id, $this->multicurrency_prices_meta_key, true );

		$multicurrency_prices = ! empty( $multicurrency_prices ) ? $multicurrency_prices : array();

		if ( ! empty( $default_currency ) ) {
			$multicurrency_prices[ $default_currency ] = $price;
		}

		return apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );
	}

	public function save_default_price( $sanitized_val, $val, $object_id, $field_args, $sanitizer ) {

		$default_currency = FG_Prices_Settings::instance()->get_default_currency();

		if ( isset( $sanitizer->field->data_to_save[ $this->price_meta_key ] ) ) {
			$sanitized_val[ $default_currency ] = sanitize_text_field( $sanitizer->field->data_to_save[ $this->price_meta_key ] );
		}

		return $sanitized_val;
	}

	/**
	 * @param $value mixed
	 * @param $field_args array
	 * @param $field CMB2_Field
	 *
	 * @return mixed
	 */
	public function old_price_sanitization( $value, $field_args, $field ) {

		$default_currency = FG_Prices_Settings::instance()->get_default_currency();

		if ( isset( $field->data_to_save[ $this->multicurrency_prices_meta_key ][ $default_currency ] ) ) {
			$value = sanitize_text_field( $field->data_to_save[ $this->multicurrency_prices_meta_key ][ $default_currency ] );
		}

		return $value;
	}
}