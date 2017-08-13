<?php
/*
* Plugin Name:  Price and discounts based on Custom Roles in WooCommerce
* Short Description:  The plugin allows you to create custom roles in woocommerce. This is not a default feature. The plugin also allows you to set discounts of a product based on custom roles and then give discount based on roles. Will help store owners increase sales based on customer groups.
* Description:  The plugin allows you to create custom roles in woocommerce. This is not a default feature. The plugin also allows you to set discounts of a product based on custom roles and then give discount based on roles. Will help store owners increase sales based on customer groups.
* Category:     Extension
* Text Domain:  eecompdcr
* Copyright:    Copyright © 2015 Envision Ecommerce (http://www.envisionecommerce.com/store/)
* Author:       Envision Ecommerce
* terms of use  http://www.envisionecommerce.com/store/terms-of-use
* License: 		http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
* Version:      Release: 3.0
*/

/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/** define EECOM_CATALOGUE_MAIN_FILE constants **/
define("EECOM_PDCR_MAIN_FILE", 'eecom-price-discounts-woocommerce.php');

/** Check Woocomerce active, must include plugin.php to use is_plugin_active() **/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/** Check Woocomerce active, must include plugin.php to use is_plugin_active() **/
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	/** define constants **/
	define("EECOM_PDCR_PLUGIN_WEBURL", plugin_dir_url( __FILE__ ));
	define("EECOM_PDCR_PLUGIN_URL", plugin_dir_path( __FILE__ ));
} else {
	/** Deactivate the plugin, and display our error notification */
	define("EECOM_PDCR_PLUGIN_URL", plugin_dir_path( __FILE__ ));
	deactivate_plugins( EECOM_PDCR_PLUGIN_URL.EECOM_PDCR_MAIN_FILE );
	add_action( 'admin_notices' , 'display_admin_notice_error_discounts' );
}

/** Display our error admin notice if WooCommerce is not installed+active **/

function display_admin_notice_error_discounts() {
	?>	
	<!-- hide the 'Plugin Activated' default message -->
	<style>
	#message.updated {
		display: none;
	}
	</style>
	<!-- display our error message -->
	<div class="error">
		<p><?php _e( '"Price and discounts Plugin" could not be activated because WooCommerce is not installed and active.', 'Price and discounts based on Custom Roles in WooCommerce' ); ?></p>
		<p><?php _e( 'Please install and activate ', 'Woocommerce Plugin' ); ?>
		<a href="<?php echo admin_url( 'plugin-install.php?tab=search&type=term&s=WooCommerce+-+excelling+eCommerce' ); ?>" title="WooCommerce">WooCommerce</a>
		<?php _e( ' before activating the plugin.', 'Price and discounts based on Custom Roles in WooCommerce' ); ?></p>
	</div>
	<?php
}
/** Required Main Class Functions **/

require_once( dirname( __FILE__ ) . '/class-eecom-pdcr-discounts.php' );

$eecom_pdcr_discounts = new eecom_pdcr_discounts();

class eecom_pdcr_dummy_variation {

	function is_type() {
		return true;
	}

}

add_action( 'plugins_loaded', 'eecom_pdcr_init', 1 );

function eecom_pdcr_init() { 

	require_once( dirname( __FILE__ ) . '/class-eecom-pdcr-discounts-settings.php' );

	add_action( 'woocommerce_integrations', 'eecomwoo_pdcr_discounts_init'  );
}


function eecomwoo_pdcr_discounts_init( $integrations ) {

	$integrations[] = 'EecomWoo_Pdcr_Discounts_Settings';
	
	return $integrations;
}