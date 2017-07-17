<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

?>

	<?php
global $product;
$sentient_breadcrumb_text = __("You are here:  ","insperia");
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		//do_action( 'woocommerce_before_main_content' );
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
		<?php
		$sentinet_related = $product->get_related( '4' );
		if( sizeof( $sentinet_related ) == 0 ){
			/*Do Nothing*/
		} else { ?>
			<div class="sentient-portfolio-related-items-main-container">
				<div class="sentient-portfolio-related-items-main-container-internal">
					<h2 class="text-center styled-header wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<?php echo __('Related Products','Insperia-child')?>
							<span class="header-style">
								<i class="fa fa-shopping-cart"></i>
							</span>
					</h2>
					<?php  woocommerce_output_related_products(); ?>
				</div>
			</div>
		<?php }	?>
	</div>
	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
