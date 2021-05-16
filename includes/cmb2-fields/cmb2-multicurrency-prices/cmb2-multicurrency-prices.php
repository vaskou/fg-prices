<?php

class CMB2_Type_Multicurrency_Prices {

	const FIELD_TYPE = 'multicurrency_prices';

	private $currencies;
	private $default_currency;

	private static $single_instance;

	public static function instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	public function __construct() {
		$currencies       = FG_Prices_Settings::instance()->get_setting( 'fg_currencies' );
		$this->currencies = explode( ',', $currencies );

		$this->default_currency = FG_Prices_Settings::instance()->get_default_currency();

		$field_type = self::FIELD_TYPE;
		add_action( "cmb2_render_{$field_type}", array( $this, 'render' ), 10, 5 );
		add_filter( "cmb2_sanitize_{$field_type}", array( $this, 'sanitize' ), 10, 2 );
		add_filter( "cmb2_types_esc_{$field_type}", array( $this, 'escape_value' ), 10, 2 );
	}


	/**
	 * @param $field         CMB2_Field
	 * @param $escaped_value mixed
	 * @param $object_id     int
	 * @param $object_type   string
	 * @param $field_type    CMB2_Types
	 */
	public function render( $field, $escaped_value, $object_id, $object_type, $field_type ) {
		ob_start();

		?>
        <div class="multicurrency-prices-field-wrapper">
			<?php

			foreach ( $this->currencies as $currency ):
				$currency_code = $currency;

				$default_value = $currency_code == $this->default_currency ? $field->get_default() : '';

				$args = array(
					'type'  => 'number',
					'id'    => $field_type->_id( '_multicurrency_price_' . $currency_code ),
					'name'  => $field_type->_name( '[' . $currency_code . ']' ),
					'value' => isset( $escaped_value[ $currency_code ] ) && '' != $escaped_value[ $currency_code ] ? $escaped_value[ $currency_code ] : $default_value,
					'class' => 'cmb2-text-small',
				);

				?>
                <div class="multicurrency-price-<?php echo $currency_code; ?>">
                    <label><?php echo $currency; ?></label>
					<?php echo $field_type->input( $args ); ?>
                </div>
			<?php
			endforeach;
			?>

        </div>
		<?php

		echo ob_get_clean();

		$field_type->_desc( true, true );
	}

	public function sanitize( $sanitized_val, $val ) {

		if ( ! is_array( $val ) ) {
			return array();
		}

		foreach ( $val as $key => $value ) {
			$sanitized_value = sanitize_text_field( $value );
			$sanitized_value = isset( $sanitized_value ) && '' != $sanitized_value ? intval( $sanitized_value ) : '';

			$sanitized_val[ $key ] = is_int( $sanitized_value ) ? $sanitized_value : '';
		}

		return $sanitized_val;
	}

	public function escape_value( $escaped_value, $val ) {

		if ( ! is_array( $val ) ) {
			$default_currency = $this->default_currency;
			if ( ! empty( $default_currency ) ) {
				$val = array( $default_currency => $val );
			} else {
				return array();
			}
		}

		foreach ( $val as $key => $value ) {
			$escaped_value[ $key ] = esc_attr( $value );
		}

		return $escaped_value;
	}

}

CMB2_Type_Multicurrency_Prices::instance();
