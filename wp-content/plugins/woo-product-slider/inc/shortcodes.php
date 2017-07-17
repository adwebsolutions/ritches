<?php

// WooCommerce product slider shortcode
function woo_product_slider_free_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'id'            => '01',
		'title'         => '',
		'color'         => '#e74c3c',
		'pagination'    => 'true',
		'nav'           => 'true',
		'auto_play'     => 'true',
		'items'         => '4',
		'stop_on_hover' => 'true',
	), $atts, 'woo-product-slider' ) );


	$que = new WP_Query(
		array( 'posts_per_page' => '-1', 'post_type' => 'product' )
	);


	$outline = '';

	$outline .= '<style>
div#sp-woo-product-slider-free' . $id . '.wpsf-product-section .slick-arrow:hover,
div.wpsf-slider-section .wpsf-cart-button a:hover,
div#sp-woo-product-slider-free' . $id . '.wpsf-product-section ul.slick-dots li button{background-color: ' . $color . '; border-color: ' . $color . '; color: #fff; }

div.wpsf-slider-section .wpsf-product-title a:hover{
	color: ' . $color . ';
}
</style>';


	$outline .= '
	    <script type="text/javascript">
	            jQuery(document).ready(function() {
				jQuery("#sp-woo-product-slider-free' . $id . '").slick({
			        infinite: true,
			        dots: ' . $pagination . ',
			        pauseOnHover: ' . $stop_on_hover . ',
			        slidesToShow: ' . $items . ',
			        slidesToScroll: 1,
			        autoplay: ' . $auto_play . ',
		            arrows: ' . $nav . ',
		            prevArrow: "<div class=\'slick-prev\'><i class=\'fa fa-angle-left\'></i></div>",
	                nextArrow: "<div class=\'slick-next\'><i class=\'fa fa-angle-right\'></i></div>",
		            responsive: [
						    {
						      breakpoint: 1000,
						      settings: {
						        slidesToShow: 3
						      }
						    },
						    {
						      breakpoint: 700,
						      settings: {
						        slidesToShow: 2
						      }
						    },
						    {
						      breakpoint: 460,
						      settings: {
						        slidesToShow: 1
						      }
						    }
						  ]
		        });

		    });
	    </script>';

	$outline .= '<div class="wpsf-slider-section">';
	$outline .= '<h2 class="wpsf-section-title">' . $title . '</h2>';
	$outline .= '<div id="sp-woo-product-slider-free' . $id . '" class="wpsf-product-section">';

	if ( $que->have_posts() ) {
		while ( $que->have_posts() ) : $que->the_post();
			global $product;
			$branch_name = 'product_brand-'.wp_get_post_terms($que->post->ID,'product_brand',array("fields" => "slugs"))[0];
			$outline .= '<div class="wpsf-product '.$branch_name.'">';
			$outline .= '<a href="' . esc_url( get_the_permalink() ) . '">';
			if ( has_post_thumbnail( $que->post->ID ) ) {
				$outline .= get_the_post_thumbnail( $que->post->ID, 'shop_catalog_image_size', array( 'class' => "wpsf-product-img" ) );
			} else {
				$outline .= '<img id="place_holder_thm" src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
			}
			$outline .= '</a>';
			$outline .= '<div class="wpsf-product-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';

			if ( class_exists( 'WooCommerce' ) && $price_html = $product->get_price_html() ) {
				$outline .= '<div class="wpsf-product-price">' . $price_html . '</div>';
			};

//			$outline .= '<div class="wpsf-cart-button">' . do_shortcode( '[add_to_cart id="' . get_the_ID() . '"]' ) . '</div>';
			$outline .= '</div>';

		endwhile;
	} else {
		$outline .= '<h2 class="sp-not-found-any-product-f">' . __( 'Not found any product', 'woo_product_slider' ) . '</h2>';
	}
	$outline .= '</div>';
	$outline .= '</div>';


	wp_reset_query();

	return $outline;

}

add_shortcode( 'woo-product-slider', 'woo_product_slider_free_shortcode' );