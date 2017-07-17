<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.12
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-success woo-alert"><?php echo wp_kses_post( $message ); ?></div>
		</div>
	</div>
<?php endforeach; ?>
