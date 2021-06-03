<?php

class CMB2_Type_Multicurrency_Prices {

	const FIELD_TYPE = 'multicurrency_prices';

	private $currencies;
	private $old_currency;
	private $settings_page_url;

	private static $single_instance;

	public static function instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	public function __construct() {
		$fg_prices_settings = FG_Prices_Settings::instance();

		$this->currencies = $fg_prices_settings->get_currencies();

		$this->old_currency = $fg_prices_settings->get_old_currency();

		$this->settings_page_url = $fg_prices_settings->get_settings_page_url();

		$field_type = self::FIELD_TYPE;
		add_action( "cmb2_render_{$field_type}", array( $this, 'render' ), 10, 5 );
		add_filter( "cmb2_sanitize_{$field_type}", array( $this, 'sanitize' ), 10, 5 );
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

		if ( ! empty( $this->currencies ) ):
			?>
            <div class="multicurrency-prices-field-wrapper">
				<?php

				foreach ( $this->currencies as $currency ):
					$currency_code = $currency;

					$type = 'number';

					if ( $currency_code == $this->old_currency ) {
						continue;
					}

					$default_value = $currency_code == $this->old_currency ? $field->get_default() : '';

					$args = array(
						'type'  => $type,
						'id'    => $field_type->_id( '_multicurrency_price_' . $currency_code ),
						'name'  => $field_type->_name( '[' . $currency_code . ']' ),
						'value' => isset( $escaped_value[ $currency_code ] ) && '' != $escaped_value[ $currency_code ] ? $escaped_value[ $currency_code ] : $default_value,
						'class' => 'cmb2-text-small',
					);

					?>
                    <div class="multicurrency-price-<?php echo $currency_code; ?>">
						<?php if ( 'hidden' != $type ): ?>
                            <label><?php echo $currency; ?></label>
						<?php endif; ?>
						<?php echo $field_type->input( $args ); ?>
                    </div>
				<?php
				endforeach;
				?>

            </div>
		<?php else: ?>
            <div class="multicurrency-prices-field-wrapper">
                <a href="<?php echo esc_url( $this->settings_page_url ); ?>" target="_blank"><span><?php _e( 'Please select the currencies from the settings page', 'fg-prices' ); ?></span></a>
            </div>
		<?php

		endif;

		echo ob_get_clean();

		$field_type->_desc( true, true );
	}

	public function sanitize( $sanitized_val, $val, $object_id, $field_args, $sanitizer ) {

		if ( ! is_array( $val ) ) {
			return array();
		}

		foreach ( $val as $key => $value ) {
			$sanitized_value = sanitize_text_field( $value );
			$sanitized_value = isset( $sanitized_value ) && '' != $sanitized_value ? intval( $sanitized_value ) : '';

			$sanitized_val[ $key ] = is_int( $sanitized_value ) ? $sanitized_value : '';
		}

		return apply_filters( 'fg_prices_cmb_multicurrency_prices_after_sanitization', $sanitized_val, $val, $object_id, $field_args, $sanitizer );
	}

	public function escape_value( $escaped_value, $val ) {

		if ( ! is_array( $val ) ) {
			$default_currency = $this->old_currency;
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
