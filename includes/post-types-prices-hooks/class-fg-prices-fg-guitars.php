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

	}

	public function post_type_fields( $fields ) {
		$fields = parent::post_type_fields( $fields );

		if ( ! empty( $fields['pricing_items']['fields']['extra_option_price'] ) ) {

			$fields['pricing_items']['fields']['extra_option_price']['before_field'] = '<label>' . FG_Prices_Settings::instance()->get_default_currency() . '</label>&nbsp;';

			$fields['pricing_items']['fields']['multicurrency_prices'] = array(
				'name' => $fields['pricing_items']['fields']['extra_option_price']['name'] . ' (' . __( 'Extra Currencies', 'fg-prices' ) . ')',
				'type' => CMB2_Type_Multicurrency_Prices::FIELD_TYPE,
			);

		}

		return $fields;

	}


	/**
	 * @param $data
	 * @param $object_id
	 * @param $a
	 * @param CMB2_Field $field
	 *
	 * @return mixed
	 */
	public function get_meta_value( $data, $object_id, $a, $field ) {

		if ( 'fgg_pricing_pricing_items' == $a['field_id'] && 'multicurrency_prices' == $field->args( '_id' ) ) {

			if ( 'cmb2_field_no_override_val' === $data ) {
				$data = 'options-page' === $a['type']
					? cmb2_options( $a['id'] )->get( $a['field_id'] )
					: get_metadata( $a['type'], $a['id'], $a['field_id'], ( $a['single'] || $a['repeat'] ) );
			}

			if ( $field->group ) {

				if ( ! isset( $data[ $field->group->index ][ $field->args( '_id' ) ] ) || '' != $data[ $field->group->index ][ $field->args( '_id' ) ] ) {
					if ( isset( $data[ $field->group->index ]['extra_option_price'] ) ) {
						$data[ $field->group->index ][ $field->args( '_id' ) ] = $data[ $field->group->index ]['extra_option_price'];
					}

				}

			}
		}

		return $data;
	}

}