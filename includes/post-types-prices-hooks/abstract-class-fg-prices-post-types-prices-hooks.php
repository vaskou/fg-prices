<?php

abstract class FG_Prices_Post_Types_Prices_Hooks {

	protected $price_meta_key;
	protected $multicurrency_prices_meta_key;

	public function price_field_type( $field_type ) {
		return 'hidden';
	}

	public function post_type_fields( $fields ) {
		$post_id = ! empty( $_REQUEST['post'] ) ? $_REQUEST['post'] : 0;

		if ( ! empty( $fields['price'] ) ) {
			$default = get_post_meta( $post_id, $this->price_meta_key, true );

			$fields['multicurrency_prices'] = array(
				'name'    => $fields['price']['name'],
				'type'    => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
				'default' => ! empty( $default ) ? $default : '',
			);

			$fields['price']['sanitization_cb'] = array( $this, 'old_price_sanitization' );
		}

		return $fields;
	}

	public function post_type_get_price( $price, $post_id ) {

		$multicurrency_prices = get_post_meta( $post_id, $this->multicurrency_prices_meta_key, true );

		$default_currency = FG_Prices_Settings::instance()->get_default_currency();

		if ( ! empty( $default_currency ) && ! empty( $multicurrency_prices[ $default_currency ] ) ) {
			$price = $multicurrency_prices[ $default_currency ];
		}

		$price = apply_filters( 'fg_prices_get_multicurrency_prices', $price, $multicurrency_prices );

		return $price;
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