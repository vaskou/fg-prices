<?php

class FG_Prices_FG_Pickups {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function __construct() {
		add_filter( 'fg_pickups_specifications_price_field_type', array( $this, 'price_field_type' ) );
		add_filter( 'fg_pickups_specifications_fields', array( $this, 'specifications_fields' ) );

	}

	public function price_field_type( $field_type ) {
		return 'hidden';
	}

	public function specifications_fields( $fields ) {
		$post_id = ! empty( $_GET['post'] ) ? $_GET['post'] : 0;

		if ( ! empty( $fields['price'] ) ) {
			$default = get_post_meta( $post_id, 'fgp_specifications_price', true );

			$fields['multicurrency_prices'] = array(
				'name'    => $fields['price']['name'],
				'type'    => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
				'default' => ! empty( $default ) ? $default : ''
			);
		}

		return $fields;
	}
}