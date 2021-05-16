<?php

/**
 * @wordpress-plugin
 * Plugin Name:       FremeditiGuitars - Prices
 * Description:       FremeditiGuitars - Prices
 * Version:           1.0.0
 * Author:            Vasilis Koutsopoulos
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fg-prices
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die();

define( 'FG_PRICES_VERSION', '1.0.0' );
define( 'FG_PRICES_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'FG_PRICES_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'FG_PRICES_PLUGIN_DIR_NAME', basename( FG_PRICES_PLUGIN_DIR_PATH ) );
define( 'FG_PRICES_PLUGIN_URL', plugins_url( FG_PRICES_PLUGIN_DIR_NAME ) );

include 'vendor/autoload.php';

include 'includes/class-fg-prices.php';
include 'includes/class-fg-prices-dependencies.php';
include 'includes/class-fg-prices-settings.php';

include 'includes/cmb2-fields/cmb2-multicurrency-prices/cmb2-multicurrency-prices.php';

include 'includes/post-types-prices-hooks/abstract-class-fg-prices-post-types-prices-hooks.php';
include 'includes/post-types-prices-hooks/class-fg-prices-fg-available-guitars.php';
include 'includes/post-types-prices-hooks/class-fg-prices-fg-pickups.php';

FG_Prices::instance();

