<?php
/*
Main class Control Main feature of  plugin
Required Class File Name class-eecom-pdcr-discounts.php
*/
class eecom_pdcr_discounts { 

	var $roles;

	function __construct() {

		add_action( 'init', array( &$this, 'load_plugin_textdomain' ) );

		add_action( 'init', array( &$this, 'init' ), 9999999 );
		// this lets the plugin to check mode of discounts
		$this->id = 'eecomwoo_pdcr_discounts';		
		$settings = get_option( 'woocommerce_'. $this->id . '_settings' );
		
		// this lets the plugin adjust the price so it shows up in the cart on the fly
		// triggers when someone clicks "Add to Cart" from a product page
		add_filter( 'woocommerce_get_cart_item_from_session', array( &$this, 'get_item_from_session' ), -1, 1 );

		// this helps with mini carts such as the one in the ShelfLife theme 
		// gets accurate pricing into the session before theme displays it on the screen
		// helps when "add to cart" does not redirect to cart page immediately
		// Deprecate this? 
		//add_action('woocommerce_before_calculate_totals', array( &$this, 'predisplay_calculate_and_set_session'), 9999999, 1 );

		add_filter( 'woocommerce_get_price', array( &$this, 'maybe_return_price' ), 999, 2 );

		add_action( 'woocommerce_variable_product_bulk_edit_actions', array( &$this, 'bulk_edit' ) );
		
		if($settings['percent_discount'] == 'yes'){
		add_action( 'woocommerce_product_after_variable_attributes', array( &$this, 'add_variable_discount_attributes'), 10, 3 );
		// Discount HOOK for the Product
		add_action( 'woocommerce_product_options_pricing', array( &$this, 'add_simple_discount_price' ), 1 );
		} else {
		add_action( 'woocommerce_product_after_variable_attributes', array( &$this, 'add_variable_attributes'), 10, 3 );
		// Discount HOOK for the Product
		add_action( 'woocommerce_product_options_pricing', array( &$this, 'add_simple_price' ), 1 );
		}		
	}

	
	function load_plugin_textdomain() {

		$locale = apply_filters( 'plugin_locale', get_locale(), 'eecomwoo_pdcr_discounts' );

		load_textdomain( 'eecomwoo_pdcr_discounts', WP_LANG_DIR.'/woocommerce/eecomwoo_pdcr_discounts-'.$locale.'.mo' );

		$plugin_rel_path = apply_filters( 'eecom_translation_file_rel_path', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		load_plugin_textdomain( 'eecomwoo_pdcr_discounts', false, $plugin_rel_path );

}

	
	// add the new role, same as 'customer' role with a different name actually
	// add actions
	function init() { 

		@session_start();
		
		add_action( 'woocommerce_process_product_meta_simple', array( &$this, 'process_product_meta' ), 1, 1 );

		add_action( 'woocommerce_process_product_meta_variable', array( &$this, 'process_product_meta_variable' ), 999, 1 );

		// Regular price displays, before variations are selected by a buyer
		add_filter( 'woocommerce_grouped_price_html', array( &$this, 'maybe_return_wholesale_price' ), 1, 2 );
		add_filter( 'woocommerce_variable_price_html', array( &$this, 'maybe_return_wholesale_price' ), 1, 2 );

		// Javscript related
		add_filter( 'woocommerce_variation_sale_price_html', array( &$this, 'maybe_return_variation_price' ), 1, 2 );
		add_filter( 'woocommerce_variation_price_html', array( &$this, 'maybe_return_variation_price' ), 1, 2 );
		add_filter( 'woocommerce_variable_empty_price_html', array( &$this, 'maybe_return_variation_price_empty' ), 999, 2 );

		add_filter( 'woocommerce_product_is_visible', array( &$this, 'variation_is_visible' ), 99999, 2 );

		add_filter( 'woocommerce_available_variation', array( &$this, 'maybe_adjust_variations' ), 1, 3 );

		add_filter( 'woocommerce_is_purchasable', array( &$this, 'is_purchasable' ), 1, 2 );

		add_filter( 'woocommerce_sale_price_html', array( &$this, 'maybe_return_wholesale_price' ), 1, 2 );
		add_filter( 'woocommerce_price_html', array( &$this, 'maybe_return_wholesale_price' ), 1, 2 );
		add_filter( 'woocommerce_empty_price_html', array( &$this, 'maybe_return_wholesale_price' ), 1, 2 );

		add_filter( 'woocommerce_get_cart_item_from_session', array( &$this, 'get_item_from_session' ), 999, 1 );

		$this->settings = get_option( 'woocommerce_eecomwoo_pdcr_discounts_settings' );

		$defaults = array(
				'show_regular_price' => '',
				'show_savings' => '',
				'show_regular_price_label' => __( 'Regularly', 'eecomwoo_pdcr_discounts' ),
				'show_savings_label' => __( 'You Save', 'eecomwoo_pdcr_discounts' ),
				'show_savings' => '',
		);
		
		$this->settings = wp_parse_args( $this->settings, $defaults );

	}

	function get_item_from_session( $item_data = '' ) { 
		global $current_user, $woocommerce;

		if ( !$current_user ) 
			$current_user = get_currentuserdata();
			
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			
		foreach( $this->roles as $role => $name ) {
		
			if ( !current_user_can( $role ) )
				continue;

			$_product = get_product( $item_data['product_id'] ); 

			if ( isset( $item_data['variation_id'] ) && 'variable' == $_product->product_type ) 
				$level_price = get_post_meta( $item_data['variation_id' ], '_' . $role . '_price', true );

			else if ( 'simple' == $_product->product_type || 'external' == $_product->product_type )
				$level_price = get_post_meta( $item_data['product_id' ], '_' . $role . '_price', true );


			else // all other product types - possibly incompatible with custom product types added by other plugins\
				$level_price = get_post_meta( $item_data['product_id' ], '_' . $role . '_price', true );

			if ( $level_price ) { 

				$item_data['data']->price = $level_price;
				
				$item_data['data']->regular_price = $level_price;


			}

		}

		return $item_data;

	}

	
	function maybe_return_wholesale_price( $price, $_product ) { 
		global $current_user;

		if ( !isset( $current_user->ID ) ) 
			$current_user = get_currentuserdata(); 

		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			
		foreach( $this->roles as $role => $name ) {
		
			if ( !current_user_can( $role ) ) 
				continue;

			$vtype = 'variable';

			if ( $_product->is_type('grouped') ) { 

				$min_price = '';
				$max_price = '';

				foreach ( $_product->get_children() as $child_id ) { 

					$child_price = get_post_meta( $child_id, '_' . $role . '_price', true );

					if ( !$child_price ) 
						continue;

					if ( $child_price < $min_price || $min_price == '' ) $min_price = $child_price;

					if ( $child_price > $max_price || $max_price == '' ) $max_price = $child_price;

				}


				$price = '<span class="from">' . __('From:', 'eecomwoo_pdcr_discounts') . ' </span>' . woocommerce_price( $min_price );

			} elseif ( $_product->is_type( $vtype ) ) {

				$wprice_min = get_post_meta( $_product->id, 'min_variation_' . $role . '_price', true );
				
				$wprice_max = get_post_meta( $_product->id, 'max_variation_' . $role . '_price', true );

				if ( $wprice_min !== $wprice_max )
					$price = '<span class="from">' . __( 'From:', 'eecomwoo_pdcr_discounts') . $wprice_min . ' </span>';

				if ( !empty( $wprice_min ) && !empty( $wprice_max ) && $wprice_min == $wprice_max ) 
					return $price;
				
				else if ( !empty( $wprice_min ) )
					$price = '<span class="from">' . __( 'From:', 'eecomwoo_pdcr_discounts') . ' ' . woocommerce_price( $wprice_min ) . ' </span>';
					
				else { 
				
					$wprice_min = get_post_meta( $_product->id, '_min_variation_regular_price', true );
					
					$wprice_max = get_post_meta( $_product->id, '_max_variation_regular_price', true );
				
					if ( $wprice_min !== $wprice_max )
						$price = '<span class="from">' . __( 'From:', 'eecomwoo_pdcr_discounts') . $wprice_min . ' </span>';

					if (  !empty( $wprice_min ) && !empty( $wprice_max ) && $wprice_min == $wprice_max ) 
						return $price;
					
					else if ( !empty( $wprice_min ) )
						$price = '<span class="from">' . __( 'From:', 'eecomwoo_pdcr_discounts') . ' ' . woocommerce_price( $wprice_min ) . ' </span>';

				}

			} else { 

				$wprice_min = get_post_meta( $_product->id, '_' . $role . '_price', true );
					
				if ( isset( $wprice_min ) && $wprice_min > 0 )
					$price = woocommerce_price( $wprice_min );

				elseif ( '' === $wprice_min ) {
				
					$price = get_post_meta( $_product->id, '_price', true );
					if ( !empty( $price ) )
						$price = woocommerce_price( $price ); 
						
				} elseif ( 0 == $wprice_min ) 
					$price = __( 'Free!', 'eecomwoo_pdcr_discounts' );
				
				if ( !empty( $wprice_min ) && 'yes' == $this->settings['show_regular_price'] || 'yes' == $this->settings['show_savings'] ) { 
				
					$rprice = get_post_meta( $_product->id, '_regular_price', true );

					if ( empty( $wprice_min ) )
						continue; 
						
					if ( floatval( $rprice ) > floatval( $wprice_min ) && 'yes' == $this->settings['show_regular_price'] ) 
						$price .= '<br><span class="normal_price">' . $this->settings['show_regular_price_label'] . ' ' . woocommerce_price( $rprice ) . '</span>';
					
					$savings = ( floatval( $rprice ) - floatval( $wprice_min ) );
					
					if ( ( $savings < $rprice ) && 'yes' == $this->settings['show_savings'] ) 
						$price .= '<br><span class="normal_price savings">' . $this->settings['show_savings_label'] . ' ' . woocommerce_price( $savings ) . '</span>';
						
				}
			}

		}

		return $price; 

	}


	function is_purchasable( $purchasable, $_product ) { 
		global $current_user;

		if ( !isset( $current_user->ID ) ) 
			$current_user = get_currentuserdata(); 
			
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return $purchasable;

		foreach( $this->roles as $role => $name ) {

			if ( !current_user_can( $role ) )
				continue;

			$is_variation = $_product->is_type( 'variation' );

			if ( !$is_variation ) 
				$is_variation = $_product->is_type( 'variable' );

			if ( $is_variation  ) { 
			
				// Variable products
				if ( !isset( $_product->variation_id ) )
					return $purchasable;

				$price = get_post_meta( $_product->variation_id, 'min_variation_' . $role . '_price', true );

				if ( !isset( $price ) )
					return $purchasable;

			} else { 
			
				// Simple products
				$price = get_post_meta( $_product->id, '_' . $role . '_price', false );

				if ( !empty( $price ) )
					return true;
				else 
					return $purchasable;
					
					
			}
		}
		
		return $purchasable;

	}


	function maybe_return_price( $price = '', $_product ) { 
		global $current_user;

		if ( !isset( $current_user->ID ) ) 
			$current_user = get_currentuserdata(); 
			
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return $price;
			
		foreach( $this->roles as $role => $name ) {
		
			if ( !current_user_can( $role ) )
				continue;

			if ( isset( $_product->variation_id ) ) {

				if ( isset( $_product->variation_id ) ) 
					$wholesale = get_post_meta( $_product->variation_id, '_' . $role . '_price', true );
				else 
					$wholesale = '';

				if ( intval( $wholesale ) > 0 ) 
					$_product->product_custom_fields[ '_' . $role . '_price' ] = array( $wholesale );


				if ( isset( $_product->product_custom_fields[ '_' . $role . '_price' ] ) && is_array( $_product->product_custom_fields[ '_' . $role . '_price'] ) && $_product->product_custom_fields[ '_' . $role . '_price'][0] > 0 ) {

					$price = $_product->product_custom_fields[ '_' . $role . '_price'][0];

				} elseif ( $_product->price === '' ) 

					$price = '';

				elseif ($_product->price == 0 ) 

					$price = __( 'Free!', 'eecomwoo_pdcr_discounts' );

				return $price; 

			}

			$rprice = get_post_meta( $_product->id, '_' . $role . '_price', true );

			if ( !empty( $rprice ) )
				return $rprice;
		}

		return $price;
		

	}

	
	function maybe_adjust_variations( $variation = '', $obj = '' , $variation_obj  = '') { 
		global $current_user;

		if ( !isset( $current_user->ID ) ) 
			$current_user = get_currentuserdata(); 
			
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			
		foreach( $this->roles as $role => $name ) {
		
			if ( !current_user_can( $role ) ) { 
				continue;

			}

			$price = $this->maybe_return_variation_price( '', $variation_obj );
			
			$variation['price_html'] = '<span class="price">' . $price . '</span>';

			if ( ( 'yes' == $this->settings['show_regular_price'] || 'yes' == $this->settings['show_savings'] ) ) { 
	
				$reg_price = get_post_meta( $variation['variation_id'], '_regular_price', true );

				$role_price = get_post_meta( $variation['variation_id'], '_' . $role . '_price', true );

				if ( ( floatval( $role_price ) < floatval( $reg_price ) ) && 'yes' == $this->settings['show_regular_price'] ) 
					$variation['price_html']  .= '<br><span class="price normal_price">' . $this->settings['show_regular_price_label'] . ' <span class="amount">' . woocommerce_price( $reg_price ) . '</span></span>';
				
				$savings = ( floatval( $reg_price ) - floatval( $role_price ) );

				if ( $savings < $reg_price && 'yes' == $this->settings['show_savings'] ) 
					$variation['price_html']  .= '<br><span class="price normal_price savings">' . $this->settings['show_savings_label'] . ' <span class="amount">' . woocommerce_price( $savings ) . '</span></span>';
					
			}


		}
		
		return $variation;

	}


	// For WooCommerce 2.x flow, to ensure product is visible as long as a role price is set
	function variation_is_visible( $visible, $vid ) {
		global $product;

		if ( !isset( $product->children ) || count( $product->children ) <= 0 )
			return $visible;

		$variation = new eecom_pdcr_dummy_variation();

		$variation->variation_id = $vid;

		$res = $this->maybe_return_variation_price( 'xxxxx', $variation );

		if ( !isset( $res ) || empty( $res ) || '' == $res )
			$res = false;
		else
			$res = true;

		return $res;
	}


	// Runs during the woocommerce_variable_empty_price_html filter call, used here in this way for debugging purposes
	// This is used for WooCommerce 2.x compatibility
	function maybe_return_variation_price_empty( $price, $_product ) {
		global $product;

		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			
		foreach( $this->roles as $role => $name ) { 
			
			if ( !current_user_can( $role  ) )
				continue;

			$min_variation_wholesale_price = get_post_meta( $_product->id, 'min_variation_' . $role . '_price' , true );
			
			$max_variation_wholesale_price = get_post_meta( $_product->id, 'max_variation_' . $role . '_price', true );

			if ( $min_variation_wholesale_price !== $max_variation_wholesale_price )
				$price = '<span class="from">' . __( 'From:', 'eecomwoo_pdcr_discounts') . ' ' .  woocommerce_price( $min_variation_wholesale_price ) . ' </span>';
				
			else 
				$price = '<span class="from">' . woocommerce_price( $min_variation_wholesale_price ) . ' </span>';
		}
		
		return $price;

	}


	// Handles getting prices for variable products
	// Used by woocommerce_variable_add_to_cart() function to generate Javascript vars that are later 
	// automatically injected on the public facing side into a single product page.
	// This price is then displayed when someone selected a variation in a dropdown
	function maybe_return_variation_price( $price, $_product ) {
		global $current_user, $product; // parent product object - global

		// Sometimes this hook runs when the price is empty but wholesale price is not, 
		// So check for that and handle returning a price for archive page view
		// $attrs = $_product->get_attributes();
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
		
		$is_variation = $_product->is_type( 'variation' );

		if ( !$is_variation )
			$is_variation = $_product->is_type( 'variable' );


		if ( !isset( $_product->variation_id ) && !$is_variation ) 
			    return $price;

		if ( !isset( $current_user->ID ) ) 
			$current_user = get_currentuserdata(); 

				
		foreach( $this->roles as $role => $name ) { 
		
			if ( $is_variation && current_user_can( $role ) ) { 

				$price = woocommerce_price( get_post_meta( $_product->variation_id, '_' . $role . '_price', true ) );

				return $price;

			}
		}
		
		foreach( $this->roles as $role => $name ) { 
		
			if ( current_user_can( $role ) )  { 

					$wholesale = get_post_meta( $_product->variation_id, '_' . $role . '_price', true );

					if ( intval( $wholesale ) > 0 ) 
						$product->product_custom_fields[ '_' . $role . '_price'] = array( $wholesale );

					if ( is_array( $product->product_custom_fields[ '_' . $role . '_price' ] ) && $product->product_custom_fields[ '_' . $role . '_price'][0] > 0 ) {

						$price = woocommerce_price( $product->product_custom_fields[ '_' . $role . '_price'][0] );

					} elseif ( $product->price === '' ) 

						$price = '';

					elseif ($product->price == 0 ) 

						$price = __( 'Free!', 'eecomwoo_pdcr_discounts' );



			} 

		}
		
		return $price;

	}


	// process simple product meta
	function process_product_meta( $post_id, $post = '' ) {
		
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
		
		foreach( $this->roles as $role => $name ) { 

			if ( '' !==  stripslashes( $_POST[ $role . '_price'] ) ){
				update_post_meta( $post_id, '_' . $role . '_price', stripslashes( $_POST[ $role . '_price' ] ) );
				update_post_meta( $post_id, '_' . $role . '_discount_percent', stripslashes( $_POST[ $role . '_discount_percent' ] ) );
			}
			else{
				delete_post_meta( $post_id, '_' . $role . '_price' );
				delete_post_meta( $post_id, '_' . $role . '_discount_percent' );
				}

		}
	}
	

	// process variable product meta
	function process_product_meta_variable( $post_id ) {

		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			

		$variable_post_ids = $_POST['variable_post_id'];
		
		if ( empty( $variable_post_ids ) )
			return;
		
		foreach( $this->roles as $role => $name ) { 

			foreach( $variable_post_ids as $key => $id ) { 
			
				if ( empty( $id ) || absint( $id ) <= 0 ) 
					continue;
					
				update_post_meta( $id, '_' . $role . '_price', floatval( $_POST[ $role .  '_price' ][ $key ] ) );
				
				update_post_meta( $id, '_' . $role . '_discount_percent', floatval( $_POST[ $role .  '_discount_percent' ][ $key ] ) );
			
			}

		}

		$post_parent = $post_id;
		
		$children = get_posts( array(
				    'post_parent' 	=> $post_parent,
				    'posts_per_page'=> -1,
				    'post_type' 	=> 'product_variation',
				    'fields' 		=> 'ids'
			    ) );

		$lowest_price = '';

		$highest_price = '';

		if ( $children ) {

			foreach( $this->roles as $role => $name ) { 
			
				foreach ( $children as $child ) {
			
					$child_price = get_post_meta( $child, '_' . $role . '_price', true );

					if ( !$child_price ) continue;
		
					// Low price
					if ( !is_numeric( $lowest_price ) || $child_price < $lowest_price ) $lowest_price = $child_price;

					
					// High price
					if ( $child_price > $highest_price )
						$highest_price = $child_price;
				}
				
				update_post_meta( $post_parent, '_' . $role . '_price', $lowest_price );
				
				//update_post_meta( $post_parent, '_' . $role . '_discount_percent', $lowest_price );
				
				update_post_meta( $post_parent, 'min_variation_' . $role . '_price' , $lowest_price );
				
				update_post_meta( $post_parent, 'max_variation_' . $role . '_price', $highest_price );

			}


		}
		
	}
	
	
	function bulk_edit() { 
			
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			
		foreach( $this->roles as $role => $name ) { 
		
		?>
		
		<option value="<?php echo $role ?>_price"><?php _e( $name . ' Price', 'eecomwoo_pdcr_discounts' ); ?></option>
		
		<?php
		
		}
	}
	
	
	function add_variable_attributes( $loop, $variation_data, $variation ) { 
		
		$this->get_roles();
		
		$my_variation_id = $variation->ID;
		
		if ( empty( $this->roles ) )
			return;
		
		foreach( $this->roles as $role => $name ) {
		
			$wprice = get_post_meta( $my_variation_id, '_' . $role . '_price', true );
			
			if ( !$wprice )
				$wprice = '';
			?>
			<tr>
				<td>
					<div>
					<label><?php echo $name; echo ' ('.get_woocommerce_currency_symbol().')'; ?> <a class="tips" data-tip="<?php _e( 'Enter the price for ', 'eecomwoo_pdcr_discounts' ); echo $name ?>" href="#">[?]</a></label>
					<input class="<?php echo $role ?>_price" type="number" size="99" name="<?php echo $role ?>_price[<?php echo $loop; ?>]" value="<?php echo $wprice ?>" step="any" min="0" placeholder="<?php _e( 'Set price ( optional )', 'eecomwoo_pdcr_discounts' ) ?>"/>
					</div>
					
				</td>
			</tr>
			<?php
		}
	}
	
	function add_simple_price() { 
		global $thepostid;
		
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			
		foreach( $this->roles as $role => $name ) { 
		
			$wprice = get_post_meta( $thepostid, '_' . $role . '_price', true );
		
			woocommerce_wp_text_input( array( 'id' => $role . '_price', 'class' => 'wc_input_price short', 'label' => $name . ' (' . get_woocommerce_currency_symbol() . ')', 'description' => '', 'type' => 'number', 'custom_attributes' => array(
						'step' 	=> 'any',
						'min'	=> '0'
					), 'value' => $wprice ) );
					
		}
	}

	
	function get_roles() {
		global $wp_roles; 
		
		if ( !empty( $this->roles ) )
			return;
			
		if ( class_exists( 'WP_Roles' ) ) 
		    if ( !isset( $wp_roles ) ) 
			$wp_roles = new WP_Roles();  
	
		foreach( $wp_roles->roles as $role => $data ) 
			if ( 'ignite_level_' == substr( $role, 0, 13 ) )
				$this->roles[ $role ] = $data['name'];

	}
	
	/*******************Start Code for Percent Discount**************/
	
	function add_simple_discount_price() {
	
		global $thepostid;
		
		$this->get_roles();
		
		if ( empty( $this->roles ) )
			return;
			
		foreach( $this->roles as $role => $name ) { 
		
			$wprice = get_post_meta( $thepostid, '_' . $role . '_price', true );
			$wperdiscount = get_post_meta( $thepostid, '_' . $role . '_discount_percent', true );
		
			woocommerce_wp_text_input( array( 'id' => $role . '_price', 'name'=> $role . '_discount_percent', 'class' => 'wc_input_price short_percent', 'label' => $name . ' (' . get_woocommerce_currency_symbol() . ')', 'description' => '', 'type' => 'number', 'custom_attributes' => array(
						'step' 	=> 'any',
						'min'	=> '0'
					), 'value' => $wperdiscount ) );
					
			woocommerce_wp_hidden_input( array( 'id' => $role . '_price', 'class' => $role . '_price', 'label' => $name . ' (' . get_woocommerce_currency_symbol() . ')', 'description' => '', 'type' => 'number', 'custom_attributes' => array(
						'step' 	=> 'any',
						'min'	=> '0'
					), 'value' => $wprice ) );
					
		} ?>
		<script>
		jQuery( document ).ready( function( $ ) { 
			$( ".short_percent" ).blur( function() {	
				var perdiscount = $(this).val();
				var fieldid = $(this).attr('id');				
				var regular_price = $("#_regular_price").val();
				var minusamout = parseFloat(parseInt((regular_price/100)*perdiscount));
				var resultamt = parseFloat(regular_price - minusamout);
				/*****add result in field****/
				$( "."+fieldid ).val(resultamt);
			})
		});
		</script>
		<?php	
	}
	
	function add_variable_discount_attributes( $loop, $variation_data, $variation ) { 
		
		$this->get_roles();
		
		$my_variation_id = $variation->ID;
		
		if ( empty( $this->roles ) )
			return;
		
		foreach( $this->roles as $role => $name ) {
		
			$wprice = get_post_meta( $my_variation_id, '_' . $role . '_price', true );
			$wprdiscount = get_post_meta( $my_variation_id, '_' . $role . '_discount_percent', true );

			if ( !$wprice )
				$wprice = '';
			?>
			<tr>
				<td>
					<div>
					<label><?php echo $name; echo '('.get_woocommerce_currency_symbol().')'; ?> <a class="tips" data-tip="<?php _e( 'Enter the price for ', 'eecomwoo_pdcr_discounts' ); echo $name ?>" href="#">[?]</a></label>
					<input id="<?php echo $role ?>_price[<?php echo $loop; ?>]" class="per_v_discount" type="number" size="99" name="<?php echo $role ?>_discount_percent[<?php echo $loop; ?>]" value="<?php echo $wprdiscount ?>" step="any" min="0" placeholder="<?php _e( 'Set price ( optional )', 'eecomwoo_pdcr_discounts' ) ?>"/>
					<input class="eecom_change_discount" type="hidden" size="99" name="<?php echo $role ?>_price[<?php echo $loop; ?>]" value="<?php echo $wprice ?>" step="any" min="0" placeholder="<?php _e( 'Set price ( optional )', 'eecomwoo_pdcr_discounts' ) ?>"/>
					</div>
					
				</td>
			</tr>
		<?php
		} ?>
		<script>
		jQuery( document ).ready( function( $ ) { 
			$( ".per_v_discount" ).blur( function() {	
				var perdiscount = $(this).val();
				var regular_price = $(this).parent().parent().find('.variable_pricing').find('.form-row-first').find('input[type="text"]').val();
				var minusamout = parseFloat(parseInt((regular_price/100)*perdiscount));
				var resultamt = parseFloat(regular_price - minusamout);
				$(this).parent().find('.eecom_change_discount').val(resultamt);
			})
		});
		</script>
	<?php }
}
?>