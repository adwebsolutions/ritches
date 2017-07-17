<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function wc_enqueue_scripts(){
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts','wc_enqueue_scripts');

/**
 * Description for product_cat page to aid users.
 *
 * @access public
 * @return void
 */
function wc_product_brand_description() {
	echo wpautop( __( 'Product brands for your store can be managed here. To change the order of brands on the front-end you can drag and drop to sort them. To see more brands listed click the "screen options" link at the top of the page.', 'luxury-wp' ) );
}

add_action( 'product_brand_pre_add_form', 'wc_product_brand_description' );

/**
 * Create thumbnail field
 */
function wc_add_brans_thumbnail(){
	global $woocommerce;
?>
	<div class="form-field">
		<label><?php _e( 'Thumbnail', 'luxury-wp' ); ?></label>
		<div id="product_brand_thumbnail" style="float:left;margin-right:10px;">
			<img src="<?php echo wc_placeholder_img_src(); ?>" width="60px" height="60px" />
		</div>
		<div style="line-height:60px;">
			<input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" />
			<button type="submit" class="upload_image_button button"><?php _e('Upload/Add image', 'luxury-wp'); ?></button>
			<button type="submit" class="remove_image_button button"><?php _e('Remove image', 'luxury-wp'); ?></button>
		</div>
		<script type="text/javascript">
	
			 // Only show the "remove image" button when needed
			 if ( ! jQuery('#product_brand_thumbnail_id').val() )
				 jQuery('.remove_image_button').hide();
	
			// Uploading files
			var file_frame;
	
			jQuery(document).on( 'click', '.upload_image_button', function( event ){
	
				event.preventDefault();
	
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}
	
				// Create the media frame.
				file_frame = wp.media.frames.downloadable_file = wp.media({
					title: '<?php echo esc_js(__( 'Choose an image', 'luxury-wp' )); ?>',
					button: {
						text: '<?php echo esc_js(__( 'Use image', 'luxury-wp' )); ?>',
					},
					multiple: false
				});
	
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					attachment = file_frame.state().get('selection').first().toJSON();
	
					jQuery('#product_brand_thumbnail_id').val( attachment.id );
					jQuery('#product_brand_thumbnail img').attr('src', attachment.url );
					jQuery('.remove_image_button').show();
				});
	
				// Finally, open the modal.
				file_frame.open();
			});
	
			jQuery(document).on( 'click', '.remove_image_button', function( event ){
				jQuery('#product_brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
				jQuery('#product_brand_thumbnail_id').val('');
				jQuery('.remove_image_button').hide();
				return false;
			});
	
		</script>
		<div class="clear"></div>
	</div>	
<?php 
}

add_action('product_brand_add_form_fields','wc_add_brans_thumbnail');

function wc_edit_brand_thumbnail($term, $taxonomy ){
	global $woocommerce;
	$image 			= '';
	$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
	if ($thumbnail_id) :
		$image = wp_get_attachment_url( $thumbnail_id );
	else :
		$image = wc_placeholder_img_src();
	endif;
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php _e('Thumbnail', 'luxury-wp'); ?></label></th>
		<td>
			<div id="product_brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo esc_url($image); ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>" />
				<button type="submit" class="upload_image_button button"><?php _e('Upload/Add image', 'luxury-wp'); ?></button>
				<button type="submit" class="remove_image_button button"><?php _e('Remove image', 'luxury-wp'); ?></button>
			</div>
			<script type="text/javascript">

				jQuery(function(){

					 // Only show the "remove image" button when needed
					 if ( ! jQuery('#product_brand_thumbnail_id').val() )
						 jQuery('.remove_image_button').hide();

					// Uploading files
					var file_frame;

					jQuery(document).on( 'click', '.upload_image_button', function( event ){

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php echo esc_js(__( 'Choose an image', 'luxury-wp' )); ?>',
							button: {
								text: '<?php echo esc_js(__( 'Use image', 'luxury-wp' )); ?>',
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							attachment = file_frame.state().get('selection').first().toJSON();

							jQuery('#product_brand_thumbnail_id').val( attachment.id );
							jQuery('#product_brand_thumbnail img').attr('src', attachment.url );
							jQuery('.remove_image_button').show();
						});

						// Finally, open the modal.
						file_frame.open();
					});

					jQuery(document).on( 'click', '.remove_image_button', function( event ){
						jQuery('#product_brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
						jQuery('#product_brand_thumbnail_id').val('');
						jQuery('.remove_image_button').hide();
						return false;
					});
				});

			</script>
			<div class="clear"></div>
		</td>
	</tr>
<?php 
}
add_action('product_brand_edit_form_fields','wc_edit_brand_thumbnail',10,3);

/**
 * wc_brand_thumbnail_save function.
 *
 * @access public
 * @param mixed $term_id Term ID being saved
 * @param mixed $tt_id
 * @param mixed $taxonomy Taxonomy of the term being saved
 * @return void
 */
function wc_brand_thumbnail_save( $term_id, $tt_id, $taxonomy ) {
	if ( isset( $_POST['product_brand_thumbnail_id'] ) )
		update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['product_brand_thumbnail_id'] ) );

}

add_action( 'created_term', 'wc_brand_thumbnail_save', 10,3 );
add_action( 'edit_term', 'wc_brand_thumbnail_save', 10,3 );

/**
 * Thumbnail column added to brand admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */
function wc_product_brand_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['thumb'] = __( 'Image', 'luxury-wp' );

	unset( $columns['cb'] );

	return array_merge( $new_columns, $columns );
}

add_filter( 'manage_edit-product_brand_columns', 'wc_product_brand_columns' );

/**
 * Thumbnail column value added to brand admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */
function wc_product_brand_column( $columns, $column, $id ) {
	global $woocommerce;
	if ( $column == 'thumb' ) {
		$image 			= '';
		$thumbnail_id 	= get_woocommerce_term_meta( $id, 'thumbnail_id', true );

		if ($thumbnail_id)
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		else
			$image = wc_placeholder_img_src();

		$columns .= '<img src="' . $image . '" alt="Thumbnail" class="wp-post-image" height="48" width="48" />';

	}

	return $columns;
}

add_filter( 'manage_product_brand_custom_column', 'wc_product_brand_column', 10, 3 );

/**
 * sort_brands function.
 */
function wc_product_brand_sortable($sortable ){
	$sortable[] = 'product_brand';
	return $sortable;
}

add_filter( 'woocommerce_sortable_taxonomies','wc_product_brand_sortable');
/**--------------woocommerce_admin_settings--------------*/

/**
 * wc_product_brand_add_admin_settings function
 */
function wc_product_brand_get_admin_settings(){
	return  apply_filters( 'wc_product_brand_settings_fields', array(
		array(
			'name' => __( 'Brands Options', 'luxury-wp' ),
			'type' => 'title',
			'id' => 'product_brand' ),
		array(
			'name' 		=> __( 'Show description', 'luxury-wp' ),
			'desc' 		=> __( 'Show/hide the product brand description on the archive page.', 'luxury-wp' ),
			'id' 		=> 'wc_product_brand_show_desc',
			'type' 		=> 'checkbox',
		),
		array(
			'type' => 'sectionend',
			'id' => 'brands_archives'
		),
	) );	
}


/**
 * wc_product_brand_add_admin_settings function
 */
function wc_product_brand_add_admin_settings(){
	woocommerce_admin_fields(wc_product_brand_get_admin_settings());
	
}

add_action( 'woocommerce_settings_catalog_options_after','wc_product_brand_add_admin_settings');

/**
 * wc_product_brand_save_admin_settings function
 */
function wc_product_brand_save_admin_settings(){
	woocommerce_update_options(wc_product_brand_get_admin_settings());
}

add_action('woocommerce_update_options_products','wc_product_brand_save_admin_settings');

/**
 * wc_permalink_settings_add function
 */
function wc_permalink_settings_add(){
	add_settings_field(
		'wc_product_brand_slug',      		// id
		__( 'Product brand base', 'luxury-wp' ), 	// setting title
		'wc_product_brand_slug_input',  		// display callback
		'permalink',                 				// settings page
		'optional'                  				// settings section
	);
}

add_action( 'admin_init', 'wc_permalink_settings_add' );

/**
 * wc_permalink_settings_save function
 */
function wc_permalink_settings_save(){
	if (is_admin()){
		if (isset($_POST['wc_product_brand_slug'])){
			
			$wc_product_brand_slug = woocommerce_clean( $_POST['wc_product_brand_slug'] );
			
			$permalinks = get_option( 'woocommerce_permalinks' );
			if ( ! $permalinks )
				$permalinks = array();
			
			$permalinks['brand_base'] 	= untrailingslashit( $wc_product_brand_slug );
			
			update_option( 'woocommerce_permalinks', $permalinks );
		}
	}
	return;
}

add_action( 'before_woocommerce_init', 'wc_permalink_settings_save' );

/**
 * wc_product_brand_slug_input function
 */
function wc_product_brand_slug_input(){
	$permalinks = get_option( 'woocommerce_permalinks' );
	?>
	<input name="wc_product_brand_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['brand_base'] ) ) echo esc_attr( $permalinks['brand_base'] ); ?>" placeholder="<?php echo _x('product-brand', 'slug', 'luxury-wp') ?>" />
	<?php
}

/****-------------- manage_product_posts_custom_column -------------*/

/**
 * Columns for Products page
 *
 * @access public
 * @param mixed $columns
 * @return array
 */

function wc_edit_product_columns($existing_columns){
	global $woocommerce;
	$columns = array();
	foreach ($existing_columns as $key=>$column){
		if($key=='product_cat'){
			$columns[$key] =$column;
			$columns['product_brand'] = __( 'Brands', 'luxury-wp' );
		}else{
			$columns[$key]=$column;
		}
	}
	return $columns;
}

add_filter( 'manage_edit-product_columns', 'wc_edit_product_columns' );

/**
 * Custom Columns for Products page
 *
 * @access public
 * @param mixed $column
 * @return void
 */
function wc_custom_product_columns( $column ) {
	global $post, $woocommerce, $the_product;
	switch ($column) {
		case 'product_brand':
			if ( ! $terms = get_the_terms( $post->ID, $column ) ) {
				echo '<span class="na">&ndash;</span>';
			} else {
				foreach ( $terms as $term ) {
					$termlist[] = '<a href="' . admin_url( 'edit.php?' . $column . '=' . $term->slug . '&post_type=product' ) . ' ">' . $term->name . '</a>';
				}
				echo implode( ', ', $termlist );
			}
		break;
	}
}

add_action('manage_product_posts_custom_column', 'wc_custom_product_columns', 2 );

/**
 * Filter products by brand, uses slugs for option values.
 *
 * @access public
 * @return void
 */
function wc_products_by_brand(){
	global $typenow, $wp_query;
    if ($typenow=='product') :
    	wc_product_dropdown_brands($show_counts = 1, $hierarchical = 1, $show_uncategorized = 0);
    endif;
}

add_action('restrict_manage_posts','wc_products_by_brand');

