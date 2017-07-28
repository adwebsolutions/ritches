<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<!-- Page Title Section
================================================== -->
<section class="splash-banner page-header-wrap parallax">
	<div class="section pattern-wrap color1">
		<div class="container">
			<h1 class="page-header h1 wow fadeInUp"><?php woocommerce_page_title(); ?></h1>
			<?php
			if(get_post_meta(get_option( 'woocommerce_shop_page_id' ), 'Title Description', true) != ''){ ?>
				<p class="page-sub-title wow fadeInUp"><?php echo esc_attr(get_post_meta(get_option( 'woocommerce_shop_page_id' ), 'Title Description', true)); ?></p>
			<?php } ?>
			<ol class="breadcrumb">
				<li> <a href="<?php echo esc_url(home_url()); ?>"> <i class="fa fa-home"></i> </a> </li>
				<li class="active"><?php woocommerce_page_title(); ?></li>
			</ol>
		</div>
	</div>
</section>
<!-- WooCommerce Filter Section
================================================== -->
<div class="filter-options">
	<div class="container filters">
		<?php woocommerce_result_count(); ?>
		<?php woocommerce_catalog_ordering(); ?>
	</div>
</div>


<!-- WooCommerce Check Layout if Full/With Sidebar
================================================== -->
<?php
if(of_get_option('shop_layout',$prof_default) == 'With Sidebar'){
	$sidebarClass = 'with-sidebar';
	$colClass = 'col-lg-9 col-sm-8';
} else {
	$sidebarClass = '';
	$colClass = 'col-lg-12';
}

?>
<!-- WooCommerce Shop Page - Started
================================================== -->
<div class="section shop <?php echo esc_attr($sidebarClass); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr($colClass); ?>">
				<?php
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */

				/*do_action( 'woocommerce_before_main_content' );*/
				?>

				<?php if ( have_posts() ) : ?>

					<?php
						/**
						 * woocommerce_before_shop_loop hook.
						 *
						 * @hooked wc_print_notices - 10
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						//do_action( 'woocommerce_before_shop_loop' );
					?>

					<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php
								/**
								 * woocommerce_shop_loop hook.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );
							?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>

					<?php
						/**
						 * woocommerce_after_shop_loop hook.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						//do_action( 'woocommerce_after_shop_loop' );
					?>
				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>
				<?php
				global $wp_query;
				$sentient_pagination = '';
				$sentient_page_text = __("Page","insperia");
				$sentient_of_text = __("of","insperia");
				$total = $wp_query->max_num_pages;


				if ( $total > 1 ) {
					if ( !$current_page = get_query_var('paged') ){$current_page = 1;}
					$sentient_pagination = '<span class="number-of-pages hidden-xs">' . esc_attr($sentient_page_text) . ' ' . esc_attr($current_page) . ' ' . esc_attr($sentient_of_text) . ' ' . esc_attr($total) . '</span>';
				} else {
					$sentient_pagination = '';
				}

				echo $sentient_pagination;

				woocommerce_pagination();
				?>
			</div>

			<!-- WooCommerce Shop Page Sidebar
                    ================================================== -->
			<?php if(of_get_option('shop_layout',$prof_default) == 'With Sidebar'){ ?>
				<div class="col-lg-3 col-sm-4">
					<aside class="project wow fadeInRight">
						<div class="aside-wrap">
							<?php get_sidebar(); ?>
						</div>
					</aside>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php get_footer( 'shop' ); ?>
