<?php

/**
 * @wordpress-plugin
 * Plugin Name:       FremeditiGuitars - Prices
 * Description:       FremeditiGuitars - Prices
 * Version:           1.1.3
 * Author:            Vasilis Koutsopoulos
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fg-prices
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die();

define( 'FG_PRICES_VERSION', '1.1.3' );
define( 'FG_PRICES_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'FG_PRICES_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'FG_PRICES_PLUGIN_DIR_NAME', basename( FG_PRICES_PLUGIN_DIR_PATH ) );
define( 'FG_PRICES_PLUGIN_URL', plugins_url( FG_PRICES_PLUGIN_DIR_NAME ) );

include 'vendor/autoload.php';

include 'includes/class-fg-prices.php';

FG_Prices::instance();

