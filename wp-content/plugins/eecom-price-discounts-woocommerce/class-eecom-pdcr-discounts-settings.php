<?php 
/** ********************************************************

Copyright © 2015 Envision Ecommerce (http://www.envisionecommerce.com/store/)

************************************************************/


if ( !defined( 'ABSPATH' ) ) die;

if ( !class_exists( 'WC_Integration' ) ) 
	return;
	
class EecomWoo_Pdcr_Discounts_Settings extends WC_Integration {

	function __construct() {

			
		$this->id = 'eecomwoo_pdcr_discounts';

		$this->method_title = __( 'Custom User Roles For Discounts', 'eecompdcr' );

		$this->method_description = sprintf( __( '', 'eecompdcr' ), '' );
		
		$this->init_form_fields();

		$this->init_settings();

		add_action( 'woocommerce_update_options_integration_' . $this->id , array( &$this, 'process_admin_options') );
		
		add_action( 'wp_ajax_eecom_get_uniqid', array( &$this, 'get_id' ) );

	}

	
	function init_form_fields() {
		

	}
	
	
	function get_id() { 
	
		die( json_encode( array( 'id' => uniqid() ) ) );
	
	}
	
	
	function admin_options() { 
	$eecom_pdcr_plugin_data    = get_plugin_data( dirname(__FILE__).'/eecom-price-discounts-woocommerce.php');
		?>
					<style>
					#eecom_header {
					background-color: #01150c;
					border-top-left-radius: 5px;
					border-top-right-radius: 5px;
					height: 100px;
					}
					#eecom_header .panelinfo {
					color: #fff;
					float: right;
					margin-right: 20px;
					margin-top: 15px;
					width: 25%;
					}
					.logo {
					float: left;
					padding: 10px;
					width: 20%;
					}
					.eecom-admin .form-table {
					margin: 10px !important;
					}
					.eecom-admin h3 {
					margin-left: 10px;
					}
					.eecom-admin {
					background: rgba(161, 237, 50, 0.27);
					}
					</style>
		<div class="eecom-admin">
	
	<div id="eecom_header">
		<div class="logo">
			<img src="<?php echo EECOM_PDCR_PLUGIN_WEBURL.'includes/images/admin_logo.png';?>" alt="Eecom" />
		</div>
		<div class="panelinfo">
			<span class="themename"><?php echo $eecom_pdcr_plugin_data['Name']; ?> Plugin</span><br/>
			<span class="themename"><?php _e('Plugin Version','eecompdcr');?> : <?php  echo $eecom_pdcr_plugin_data['Version']; ?></span>
			<div>
				<span>
				<!--<a href="#" target="_blank">FAQ</a>&nbsp;|&nbsp;-->
				<a href="<?php echo EECOM_PDCR_PLUGIN_WEBURL ?>documentation" target="_blank">Documentation</a>&nbsp;|&nbsp;
				<a href="http://www.envisionecommerce.com/store/helpdesk/" target="_blank">Help Desk</a>
			</div>		
		</div>
	</div>
		
		<h3><?php echo isset( $this->method_title ) ? $this->method_title : __( 'Settings', 'eecomwoo_pdcr_discounts' ) ; ?></h3>

		<?php echo isset( $this->method_description ) ? wpautop( $this->method_description ) : ''; ?>

		<table class="form-table">
			<?php $this->min_settings() ?>
			<?php $this->generate_settings_html(); ?>
		</table>

		<div><input type="hidden" name="section" value="<?php echo $this->id; ?>" /></div>
		</div>
		<?php
	}
	
	
	function min_settings() { 
		global $wp_roles, $woocommerce;

		if ( !isset( $wp_roles->roles ) )
			return;
			
		$settings = get_option( 'woocommerce_'. $this->id . '_settings' );
		
		$defaults = array(
				'show_regular_price' => '',
				'show_savings' => '',
				'show_regular_price_label' => __( 'Regularly', 'eecomwoo_pdcr_discounts' ),
				'show_savings_label' => __( 'You Save', 'eecomwoo_pdcr_discounts' ),
		);
		
		$settings = wp_parse_args( $settings, $defaults );
		
		?>
		<script>
		jQuery( document ).ready( function( $ ) { 
			$( "#eecom_add_new_role" ).click( function() { 
			
				var uid = null;
				
				$.post( ajaxurl, { action:'eecom_get_uniqid' }, function( data ) { 
				
					try { 
						var j = $.parseJSON( data );
						
						uid = j.id;
						
					} catch( err ) { 
				
						alert( '<?php _e( 'An error occurred. Try again.', 'eecomwoo_pdcr_discounts' )?>');
						return false;
				
					}
				
					var html = '\
						<tr>\
						<td>\
							<label class="">\
							<input type="text" name="ignite_level_name[ignite_level_' + uid + ']" placeholder="<?php _e( 'Enter a role name','eecomwoo_pdcr_discounts' )?>" value="">\
							</label>\
						</td>\
						<td>\
						</td>\
						</tr>\
					';
					
					$( '.roles_table' ).append( html );
					
					return false;
				
				});
				

			})
		})
		</script>
		
		<style>
			.help_tip.tiered { width: 16px; float: none !important; }
		</style>
		
		<tr valign="top">
			<th class="titledesc" scope="row">
				<label for="roles">
				<?php _e( 'Display Regular Price of Products', 'eecomwoo_pdcr_discounts' )?>
				</label>
			</th>
			<td class="forminp ign_roles">	
				<input type="checkbox" value="yes" name="ignitewoo_tiered_show_regular_price" <?php checked( $settings['show_regular_price'], 'yes', true ) ?>>  
				<input type="text" placeholder="Text With Regular price" value="<?php echo $settings['show_regular_price_label'] ?>" name="ignitewoo_tiered_show_regular_price_label"> 
				<img class="help_tip tiered" src="<?php echo $woocommerce->plugin_url() ?>/assets/images/help.png" data-tip="<?php _e( 'Check this to display the regular price.', 'eecomwoo_pdcr_discounts' )?>">
			</td>
		</tr>
		<tr valign="top">
			<th class="titledesc" scope="row">
				<label for="roles">
				<?php echo sprintf( __( 'Display %s Savings/Discounts', 'eecomwoo_pdcr_discounts' ), get_woocommerce_currency_symbol() ) ?>
				</label>
			</th>
			<td class="forminp ign_roles">	
				<input type="checkbox" value="yes" name="ignitewoo_tiered_show_savings" <?php checked( $settings['show_savings'], 'yes', true ) ?>> 
				<input type="text" value="<?php echo $settings['show_savings_label'] ?>" placeholder="Text With Discount Price" name="ignitewoo_tiered_show_savings_label"> 
				<img class="help_tip tiered" src="<?php echo $woocommerce->plugin_url() ?>/assets/images/help.png" data-tip="<?php _e( 'Check this to display the amount being saved.', 'eecomwoo_pdcr_discounts' )?>">
			</td>
		</tr>
		<tr valign="top">
			<th class="titledesc" scope="row">
				<label for="roles">
				<?php echo sprintf( __( "Enable Discounts in Percentage", 'eecomwoo_pdcr_discounts' ), get_woocommerce_currency_symbol() ) ?>
				</label>
			</th>
			<td class="forminp ign_roles">	
				<input type="checkbox" value="yes" name="ignitewoo_tiered_percent_discount" <?php checked( $settings['percent_discount'], 'yes', true ) ?>>
				<img class="help_tip tiered" src="<?php echo $woocommerce->plugin_url() ?>/assets/images/help.png" data-tip="<?php _e( 'Option allows to add Discount price in percent. if we add 10 in the discount field for a user role. 10% discount on regular price will be enable for user role (Leave the field unchecked for default price discount)', 'eecomwoo_pdcr_discounts' )?>">
			</td>
		</tr>
		<tr valign="top">
			<th class="titledesc" scope="row">
				<label for="roles">
				<?php _e( 'Pricing Roles', 'eecomwoo_pdcr_discounts' )?>
				</label>
			</th>
			<td class="forminp ign_roles">	
				<table width="50%" class="roles_table">
					<tr>
						<th>
							<strong><?php _e( 'Role Name', 'eecomwoo_pdcr_discounts' ) ?></strong></th>
						<th>
							<strong><?php _e( 'Action', 'eecomwoo_pdcr_discounts' ) ?></strong>
							<img class="help_tip tiered" src="<?php echo $woocommerce->plugin_url() ?>/assets/images/help.png" data-tip="<?php _e( 'When you delete a role then any users with that role will have their role changed to customer', 'eecomwoo_pdcr_discounts' )?>">
						</th>
					</tr>
		<?php

		asort( $wp_roles->roles );

		foreach( $wp_roles->roles as $role => $data ) { 

			if ( 'ignite_level_' != substr( $role, 0, 13 ) )
				continue;
			?>
					<tr>
						<td>
							<label class="">
								<span><?php echo stripslashes( $data['name'] ) ?></span> 
							</label>
						</td>
						<td>
							<input type="checkbox" value="<?php echo $role ?>" style="" id="ignite_level_<?php echo $role ?>" name="ignite_level_delete[<?php echo $role ?>]" class="input-text wide-input "> 
							&nbsp;<span>Delete Role</span>
						</td>
					</tr>
					

			<?php
		}
		?>
				</table>
			</td>
		</tr>
		
		<tr>
			<th></th>
			<td><button type="button" class="button" id="eecom_add_new_role"><?php _e( 'Add New Role', 'eecomwoo_pdcr_discounts' )?></button></td>
		<?php 
	}
	
	
	function process_admin_options() {
		global $wp_roles;

		if ( !isset( $wp_roles->roles ) )
			return;

		parent::process_admin_options();

		if ( !empty( $_POST['ignite_level_name' ] ) ) { 
		
			foreach( $_POST['ignite_level_name' ] as $key => $irole ) { 

				if ( '' == trim( $irole ) )
					continue;
				
				foreach( $wp_roles->roles as $role => $data ) 
					if ( $role == $irole )
						continue;
				
				add_role( $key , __( trim( $irole ), 'eecomwoo_pdcr_discounts' ), array(
					'read' => true,
					'edit_posts' => false,
					'delete_posts' => false
				) );
				
			}
			
		}

		if ( !empty( $_POST[ 'ignite_level_delete' ] ) ) { 

			foreach( $_POST[ 'ignite_level_delete' ] as $key => $irole ) { 

				$users_of_blog = get_users();
				
				foreach ( ( array ) $users_of_blog as $user ) {

					foreach ( ( array ) $user->roles as $role => $data ) {
					
						if ( $role == $irole ) { 

							$userdata = new WP_User( $user->data->ID );
							
							$userdata->remove_role( $irole );
							
							$userdata->add_role( 'customer' );
							
						}
						
					}
					
				}

				remove_role( $key );
				
			}

		}
		

		$settings = get_option( 'woocommerce_'. $this->id . '_settings' );

		$settings['show_regular_price'] =  isset( $_POST['ignitewoo_tiered_show_regular_price'] ) ? $_POST['ignitewoo_tiered_show_regular_price'] : '';
		
		$settings['show_regular_price_label'] = isset( $_POST['ignitewoo_tiered_show_regular_price_label'] ) ? $_POST['ignitewoo_tiered_show_regular_price_label'] : '';
		
		$settings['show_savings_label'] = isset( $_POST['ignitewoo_tiered_show_savings_label'] ) ? $_POST['ignitewoo_tiered_show_savings_label'] : '';
		
		$settings['show_savings'] = isset( $_POST['ignitewoo_tiered_show_savings'] ) ? $_POST['ignitewoo_tiered_show_savings'] : '';
		
		$settings['percent_discount'] = isset( $_POST['ignitewoo_tiered_percent_discount'] ) ? $_POST['ignitewoo_tiered_percent_discount'] : '';
		
		update_option( 'woocommerce_'.  $this->id . '_settings', $settings );

		
	}

}