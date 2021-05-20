<?php

use WordpressCustomSettings\SettingsSetup;
use WordpressCustomSettings\SettingSection;
use WordpressCustomSettings\SettingField;

class FG_Prices_Settings extends SettingsSetup {

	private static $_instance;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	protected function __construct() {
		$this->set_submenu_parent_slug( 'options-general.php' );

		$this->page_title = 'Wordpress Custom Settings';
		$this->menu_title = 'Wordpress Custom Settings';
		$this->menu_slug  = 'wordpress_custom_settings';

		$this->set_page_title( __( 'FG Prices Settings', 'fg-prices' ) );
		$this->set_menu_title( __( 'FG Prices Settings', 'fg-prices' ) );
		$this->set_menu_slug( 'fg-prices' );

		$this->add_section( new SettingSection( 'currencies', __( 'Currencies', 'fg-prices' ) ) );

		$currencies = FG_Prices_Currencies::get_currencies();
		$args       = array(
			'options' => $currencies
		);

		$settings = array(
			new SettingField( 'fg_currencies', __( 'Currencies', 'fg-prices' ), 'text', 'currencies' ),
			new SettingField( 'fg_default_currency', __( 'Default Currency', 'fg-prices' ), 'select', 'currencies', $args ),
		);

		foreach ( $settings as $setting ) {
			$this->add_setting_field( $setting );
		}

		parent::__construct();
	}

	public function settings_field_callback( $args ) {
		parent::settings_field_callback( $args );

		$field_name = $args['field_name'];

		$setting = get_option( $field_name );

		$type = ! empty( $args['type'] ) ? $args['type'] : 'text';

		switch ( $type ) {
			case 'select':
				$options = ! empty( $args['options'] ) ? $args['options'] : array();
				?>
                <select name="<?php echo $field_name; ?>">
					<?php foreach ( $options as $key => $option ): ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $setting, $key ) ?>><?php echo $option; ?></option>
					<?php endforeach; ?>
                </select>
				<?php

				break;
		}
	}

	public function get_default_currency() {
		$currencies = $this->get_setting( 'fg_currencies' );
		$currencies = explode( ',', $currencies );

		$default_currency = $this->get_setting( 'fg_default_currency' );

		return ! empty( $default_currency ) && ! empty( $currencies[ $default_currency ] ) ? $default_currency : reset( $currencies );

	}
}
