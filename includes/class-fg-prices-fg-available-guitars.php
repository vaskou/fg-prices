<?php

class FG_Prices_FG_Available_Guitars {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		add_filter( 'fg_available_guitars_price_field_type', array( $this, 'price_field_type' ) );
		add_filter( 'fg_available_guitars_fields', array( $this, 'available_guitars_fields' ) );
		add_filter( 'fg_available_guitars_post_type_get_price', array( $this, 'available_guitars_post_type_get_price' ), 10, 2 );

	}

	public function price_field_type( $field_type ) {
		return 'hidden';
	}

	public function available_guitars_fields( $fields ) {
		$post_id = ! empty( $_REQUEST['post'] ) ? $_REQUEST['post'] : 0;

		if ( ! empty( $fields['price'] ) ) {
			$default = get_post_meta( $post_id, 'fg_available_guitars_price', true );

			$fields['multicurrency_prices'] = array(
				'name'    => $fields['price']['name'],
				'type'    => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
				'default' => ! empty( $default ) ? $default : '',
			);

			$fields['price']['sanitization_cb'] = array( $this, 'old_price_sanitization' );
		}

		return $fields;
	}

	public function available_guitars_post_type_get_price( $price, $post_id ) {

		$multicurrency_prices = get_post_meta( $post_id, 'fg_available_guitars_multicurrency_prices', true );

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

		if ( isset( $field->data_to_save['fg_available_guitars_multicurrency_prices'][ $default_currency ] ) ) {
			$value = sanitize_text_field( $field->data_to_save['fg_available_guitars_multicurrency_prices'][ $default_currency ] );
		}

		return $value;
	}
}