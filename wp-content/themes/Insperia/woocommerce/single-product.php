<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.12
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		
		/*do_action( 'woocommerce_before_main_content' );*/
	global $product;
	$sentient_breadcrumb_text = __("You are here:  ","insperia");
	
	?>
	
	<!-- Page Title Section
	================================================== -->	
	<section class="splash-banner page-header-wrap parallax">
		<div class="section pattern-wrap color1">
			<div class="container">
				<h2 class="page-header h1 wow fadeInUp"><?php the_title(); ?></h2>
				<ol class="breadcrumb">
					<li> <a href="<?php echo esc_url(home_url()); ?>"> <i class="fa fa-home"></i> </a> </li>
					<li class="active"><?php echo get_the_title(); ?></li>
				</ol>
			</div>
		</div>
	</section>	
	<!-- product -->
	<div class="section shop">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>
			<hr class="">
			<?php
			$sentinet_related = $product->get_related( '4' );
			if( sizeof( $sentinet_related ) == 0 ){
				/*Do Nothing*/
			} else { ?>
				<div class="sentient-portfolio-related-items-main-container">
					<div class="sentient-portfolio-related-items-main-container-internal">
						<h3 class="stronger text-center styled-header wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
							Related Products
							<span class="header-style">
								<i class="fa fa-gift"></i>
							</span>
						</h3>					
						<?php  woocommerce_output_related_products(); ?>
					</div>
				</div>				
			<?php }	?>				
		</div>
	</div>
	

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		
		/*Removed by Sentient*/
		/*do_action( 'woocommerce_sidebar' );*/
	?>

<?php get_footer( 'shop' ); ?>