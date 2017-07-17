<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.12
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>

<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				
				/*do_action( 'woocommerce_before_shop_loop_item_title' );*/

				$sale_text = __("Sale!","insperia");
				
				if((get_post_meta( get_the_ID(), '_sale_price', true) != get_post_meta( get_the_ID(), '_regular_price', true) && get_post_meta( get_the_ID(), '_sale_price', true) == get_post_meta( get_the_ID(), '_price', true))){
					$sale = '<span class="onsale">' . $sale_text . '</span>';
				} else {
					$sale = '';
				}	
			?>
			
			<a href="<?php the_permalink(); ?>">
				<?php echo $sale;?>
			</a>
			<div class="product-wrap">
				<a href="<?php the_permalink(); ?>">
					<?php echo get_the_post_thumbnail(get_the_ID() , array(292,9999)); ?>
				</a>
				<a class="add-to-cart-btn button add_to_cart_button product_type_simple added" data-product_sku="" data-product_id="<?php the_ID(); ?>" rel="nofollow" href="<?php echo do_shortcode('[add_to_cart_url id="' . the_ID() . '"]'); ?>"><?php _e("Add to cart" , "insperia"); ?></a>				
			</div>
			<a href="<?php the_permalink(); ?>">
				<h3><?php the_title(); ?></h3>
				<?php
					$insperia_currency_sale = get_woocommerce_currency_symbol();
					$insperia_get_variation_id = get_post_meta( get_the_ID(), '_min_price_variation_id', true );
					$insperia_currency_sale = get_woocommerce_currency_symbol();
				?>
				<span class="price">
					<?php
						if( $insperia_get_variation_id != '' ) { ?>
							<ins><span class="amount"><?php _e("From: " , "insperia"); echo $insperia_currency_sale . get_post_meta( $insperia_get_variation_id, '_price', true ); ?></span></ins>
					<?php } else { 
									
						$insperia_sale = get_post_meta( get_the_ID(), '_sale_price', true);
						if($insperia_sale == ''){
							$insperia_price = '<ins><span class="amount">' . $insperia_currency_sale . get_post_meta( get_the_ID(), '_regular_price', true) . '</span></ins>';
							echo $insperia_price;
						} else {
							$insperia_price = '<del><span class="amount">' . $insperia_currency_sale . get_post_meta( get_the_ID(), '_regular_price', true) . '</span></del>';
							echo $insperia_price . '<ins><span class="amount">' . $insperia_currency_sale . get_post_meta( get_the_ID(), '_sale_price', true) . '</span></ins>';
						}
						
					 } ?>
				</span>
			 </a>
</li>


