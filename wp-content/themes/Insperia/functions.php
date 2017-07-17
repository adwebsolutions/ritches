<?php

/*------------------------------------------------------*/
/* Insperia functions.php Started */
/*------------------------------------------------------*/


/*------------------------------------------------------
Insperia, After Theme Setup - Started
-------------------------------------------------------*/

add_action('after_setup_theme', 'insperia_setup');

function insperia_setup(){

	/* Add theme-supported features here. */
	add_theme_support( 'post-thumbnails' ); 	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header');
	add_theme_support( 'post-formats', array('video','audio','chat','link','gallery','quote') );
	add_theme_support('woocommerce');
	add_theme_support( 'title-tag' );
	
	/* Add custom actions here. */
	add_action('wp_enqueue_scripts', 'insperia_load_theme_fonts', 30);
	add_action('wp_enqueue_scripts', 'insperia_load_theme_scripts' );
	add_action('wp_enqueue_scripts', 'insperia_load_theme_styles');	
	/*add_action('widgets_init', 'insperia_recent_comments_registration');	
	add_action('widgets_init', 'insperia_recent_posts_registration');		*/
	
	add_action( 'add_meta_boxes', 'insperia_add_sidebar_metabox' );  
	add_action( 'save_post', 'insperia_save_sidebar_postdata' );  
	add_action( 'tgmpa_register', 'insperia_register_required_plugins' );		
	
	
	/* Add custom filters here. */	
	add_filter('wp_list_categories','categories_postcount_filter');
	add_filter('get_search_form', 'insperia_search_form' );
	add_filter('wp_generate_attachment_metadata', 'insperia_retina_support_attachment_meta', 10, 2 );
	add_filter('delete_attachment', 'insperia_delete_retina_support_images' );
	add_filter('request', 'insperia_request_filter' );
	add_filter('excerpt_length', 'insperia_custom_excerpt_length', 999 );
	add_filter('excerpt_more', 'insperia_excerpt_more_string');
	add_filter('widget_text', 'do_shortcode');	
	add_filter('loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );	
	
	/* Add ceditor Styles here. */	
	add_editor_style();
	
	/* Add Insperia Content Width. */
	if ( ! isset( $content_width ) ){ $content_width = 1170;}	

	/* Add Custom Background. */
	add_theme_support( 'custom-background');
	
	/* Load Text Domain. */
	load_theme_textdomain('insperia', get_template_directory() . '/languages');
}

/*------------------------------------------------------
Insperia, After Theme Setup - End
-------------------------------------------------------*/


/*------------------------------------------------------*/
/* TGM_Plugin_Activation class Started*/
/*------------------------------------------------------*/

require_once ('admin/tgm/class-tgm-plugin-activation.php');

function insperia_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	 
	$sentient_layerslider_path = get_template_directory() . '/admin/lib/plugins/layersliderwp.zip';
	$sentient_vc_path = get_template_directory() . '/admin/lib/plugins/visual-composer.zip';
	$identity_revslider_path = get_template_directory() . '/admin/lib/plugins/revslider.zip';
	$identity_posts_path = get_template_directory() . '/admin/lib/plugins/ProfTeamExtensions.zip';
	$sentient_envato = get_template_directory() . '/admin/lib/plugins/envato-wordpress-toolkit-master.zip';
	
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme	
		array(
			'name'     				=> 'Layerslider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> $sentient_layerslider_path, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '5.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> $sentient_vc_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.4.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> $identity_revslider_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),			
		
		
		array(
			'name'     				=> 'ProfTeam Extensions', // The plugin name
			'slug'     				=> 'ProfTeamExtensions', // The plugin slug (typically the folder name)
			'source'   				=> $identity_posts_path, // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Envato WordPress Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
			'source'   				=> $sentient_envato, // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.7.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		
		
        array(
            'name'      => 'contact-form-7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
		
        array(
            'name'      => 'woocommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
        ),
		
        array(
            'name'      => 'newsletter',
            'slug'      => 'newsletter',
            'required'  => false,
        ),		
		
			
	);
	
	
	$theme_text_domain = 'insperia';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       // Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'insperia'),
			'menu_title'                       			=> __( 'Install Plugins', 'insperia' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'insperia' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'insperia' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'insperia' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'insperia' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'insperia' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/**************************************/
/*TGM_Plugin_Activation class End*/
/**************************************/



/***************************************************/
/*Set Visual Composer as Theme Function - Started*/
/***************************************************/

if(function_exists('vc_set_as_theme')) vc_set_as_theme();

/***************************************************/
/*Set Visual Composer as Theme Function - End*/
/***************************************************/



/***************************************************/
/*Load Insperia Fonts - Started*/
/***************************************************/
function insperia_load_theme_fonts() {

	global $prof_default;
	$Protocol = is_ssl() ? 'https' : 'http';	
	
	if(of_get_option('select_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('select_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('select_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");				
	} elseif(of_get_option('select_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'siteFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('select_font',$prof_default));		
	}
	
	if(of_get_option('h1_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h1_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h1_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h1_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingOneFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h1_font',$prof_default));		
	}
	
	if(of_get_option('h2_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h2_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h2_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h2_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingTwoFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h2_font',$prof_default));		
	}	
	
	if(of_get_option('h3_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h3_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h3_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h3_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingThreeFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h3_font',$prof_default));		
	}	
	
	if(of_get_option('h4_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h4_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h4_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h4_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingFourFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h4_font',$prof_default));		
	}		
	
	if(of_get_option('h5_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h5_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h5_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h5_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingFiveFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h5_font',$prof_default));		
	}		
	
	if(of_get_option('h6_font',$prof_default) == 'Open+Sans'){
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,300,700,800,bold");		
	} elseif(of_get_option('h6_font',$prof_default) == 'Merriweather+Sans') {
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700,700italic,800,800italic");			
	} elseif(of_get_option('h6_font',$prof_default) == 'Source+Sans+Pro') {	
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300italic,300,400italic,600,600italic,700italic,700,900,900italic");					
	} elseif(of_get_option('h6_font',$prof_default) == 'Lato') {	
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext");
	} else {
		wp_enqueue_style( 'headingSixFont', "$Protocol://fonts.googleapis.com/css?family=" . of_get_option('h6_font',$prof_default));		
	}			
		
}

/***************************************************/
/*Load Insperia Fonts - End*/
/***************************************************/



/***************************************************/
/*Load Insperia Styles - Started*/
/***************************************************/
function insperia_load_theme_styles() {

	global $prof_default;

	wp_register_style('insperia-usage', get_template_directory_uri().'/styles/insperia-usage.css');
	wp_register_style('insperia-icons', get_template_directory_uri().'/styles/insperia-icons.css');	
	wp_register_style('insperia-custom', get_template_directory_uri().'/insperia-styles.css');
	wp_register_style('main', get_template_directory_uri().'/styles/insperia/main.css');	
	wp_register_style('style', get_stylesheet_uri());
	
	
	wp_enqueue_style( 'style');	
	wp_enqueue_style( 'insperia-icons');	
	wp_enqueue_style( 'insperia-usage');	
	wp_enqueue_style('main');		
	wp_enqueue_style( 'insperia-custom');	
}

/***************************************************/
/*Load Insperia Styles - End*/
/***************************************************/



/***************************************************/
/*Load Insperia Scripts - Started*/
/***************************************************/
function insperia_load_theme_scripts() {
	global $is_IE;
	global $prof_default;
	
	wp_enqueue_script('prof.common', get_template_directory_uri().'/js/prof.common.js',false,false,true);		
	wp_enqueue_script('retina', get_template_directory_uri().'/js/retina.js', '', '', true);
	wp_enqueue_script('jquery.timeago', get_template_directory_uri().'/js/jquery.timeago.js', '', '', true);
	
	wp_enqueue_script('modernizr', get_template_directory_uri().'/js/insperia/vendor/modernizr-2.6.2-respond-1.1.0.min.js', '', '', true);
	
	if(is_page_template( 'comingsoon.php' )){	
		wp_enqueue_script('flipclock', get_template_directory_uri().'/js/insperia/flipclock.js', '', '', true);
	}
	
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/insperia/vendor/bootstrap.min.js', '', '', true);

	if(is_page_template( 'portfolio-four-columns.php' ) || is_page_template( 'portfolio-three-columns.php' ) || is_page_template( 'portfolio-two-columns.php' ) || is_page_template( 'homepage.php' ) || is_page_template( 'page-full.php' ) || is_page_template( 'blog-masonry.php' ) || is_page_template( 'comingsoon.php' )){
		wp_enqueue_script('nivo-lightbox', get_template_directory_uri().'/js/insperia/nivo-lightbox.min.js', '', '', true);	
	}		
	
	wp_enqueue_script('parallax', get_template_directory_uri().'/js/insperia/parallax.js', '', '', true);
	wp_enqueue_script('jquery.utilcarousel.min', get_template_directory_uri().'/js/insperia/jquery.utilcarousel.min.js', '', '', true);
	
	if(is_page_template('homepage.php')){	
		wp_enqueue_script('totemticker', get_template_directory_uri().'/js/insperia/totemticker.js', '', '', true);		
	}
	
	wp_enqueue_script('jquery.easing', get_template_directory_uri().'/js/insperia/jquery.easing.1.3.js', '', '', true);		
	wp_enqueue_script('jquery-css-transform', get_template_directory_uri().'/js/insperia/jquery-css-transform.js', '', '', true);			
	wp_enqueue_script('jquery.quicksand', get_template_directory_uri().'/js/insperia/jquery.quicksand.js', '', '', true);		
	wp_enqueue_script('excanvas', get_template_directory_uri().'/js/insperia/excanvas.js', '', '', true);		
	wp_enqueue_script('easy-pie-chart', get_template_directory_uri().'/js/insperia/jquery.easy-pie-chart.js', '', '', true);
	
	if(is_page_template('homepage.php')){
		wp_enqueue_script('mediaelement-and-player', get_template_directory_uri().'/js/insperia/mediaelement-and-player.min.js', '', '', true);
	}	
	
	if(is_page_template('blog-masonry.php') || is_page_template('homepage.php') || is_page_template( 'page-full.php' ) || is_home()){
		wp_enqueue_script('masonry', get_template_directory_uri().'/js/insperia/masonry.js', '', '', true);	
	}
		
	wp_enqueue_script('wow.min', get_template_directory_uri().'/js/insperia/wow.min.js', '', '', true);	
	wp_enqueue_script('appear-count', get_template_directory_uri().'/js/insperia/appear-count.js', '', '', true);		
	wp_enqueue_script('flexslider-min', get_template_directory_uri().'/js/insperia/jquery.flexslider-min.js', '', '', true);
	
	if(of_get_option('select_backtotop',$prof_default) == 'On'){
		wp_enqueue_script('scrolltotop', get_template_directory_uri().'/js/insperia/scrolltotop.js', '', '', true);
	}
		
	wp_enqueue_script('main', get_template_directory_uri().'/js/insperia/main.js', '', '', true);		
	wp_enqueue_script('google-jsapi', get_template_directory_uri().'/js/insperia/google-jsapi.js', '', '', true);	
      
	if ( $is_IE ) {
		wp_enqueue_script('html5','http://html5shim.googlecode.com/svn/trunk/html5.js',false,false,true);
	}

}
/***************************************************/
/*Load Insperia Scripts - End*/
/***************************************************/



/***************************************************/
/*Insperia Retina Functions - Started*/
/***************************************************/

/**
* Retina images
*
* This function is attached to the 'wp_generate_attachment_metadata' filter hook.
*/

function insperia_retina_support_attachment_meta( $metadata, $attachment_id ) {
	foreach ( $metadata as $key => $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $image => $attr ) {
				if ( is_array( $attr ) )
					insperia_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
			}
		}
	}

	return $metadata;
}


/**
 * Create retina-ready images
 *
 * Referenced via retina_support_attachment_meta().
 */
function insperia_retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}

/**
 * Delete retina-ready images
 *
 * This function is attached to the 'delete_attachment' filter hook.
 */
function insperia_delete_retina_support_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    $upload_dir = wp_upload_dir();
	
	if(is_array($meta)){	
		$path = pathinfo( $meta['file'] );

		foreach ( $meta as $key => $value ) {
			if ( 'sizes' === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
				}
			}
		}
	}
}
/***************************************************/
/*Insperia Retina Functions - End*/
/***************************************************/



/***************************************************/
/*Identity General Array's that will be used - Started*/
/***************************************************/
$insperia_yes_no_arr = array(__("Yes", "insperia") => "yes", __("No", "insperia") => "no");
$insperia_align = array(__("Align Left", "insperia") => "left", __("Align Right", "insperia") => "right", __("Align Center", "insperia") => "center");
$insperia_animation = array(__("Fade Up", "insperia") => "up", __("Fade Down", "insperia") => "down", __("Fade Left", "insperia") => "left", __("Fade Right", "insperia") => "right", __("None", "insperia") => "none");
$insperia_button_arr = array(__("X Large", "insperia") => "xl", __("Large", "insperia") => "lg", __("Default", "insperia") => "default"); 
$insperia_services_styles_arr = array(__("Style One", "insperia") => "style1", __("Style Two", "insperia") => "style2", __("Style Three", "insperia") => "style3", __("Style Four", "insperia") => "style4");
$insperia_animation_arr = array(__("Top", "insperia") => "top", __("Bottom", "insperia") => "bottom", __("Left", "insperia") => "left", __("Right", "insperia") => "right");
$insperia_icon_arr = array(
__("Align Left", "sentient") => "<i class='fa fa-align-left fa-5x'></i> align-left",
__("Align Center", "sentient") => "align-center",
__("Align Right", "sentient") => "align-right",
__("Align Justify", "sentient") => "align-justify",
__("Arrows", "sentient") => "arrows",
__("Arrow Left", "sentient") => "arrow-left",
__("Arrow Right", "sentient") => "arrow-right",
__("Arrow Up", "sentient") => "arrow-up",
__("Arrow Down", "sentient") => "arrow-down",
__("Asterisk", "sentient") => "asterisk",
__("Arrows V", "sentient") => "arrows-v",
__("Arrows H", "sentient") => "arrows-h",
__("Arrow Circle Left", "sentient") => "arrow-circle-left",
__("Arrow Circle Right", "sentient") => "arrow-circle-right",
__("Arrow Circle Up", "sentient") => "arrow-circle-up",
__("Arrow Circle Down", "sentient") => "arrow-circle-down",
__("Arrows Alt", "sentient") => "arrows-alt",
__("Ambulance", "sentient") => "ambulance",
__("Adn", "sentient") => "adn",
__("Angle Double Left", "sentient") => "angle-double-left",
__("Angle Double Right", "sentient") => "angle-double-right",
__("Angle Double Up", "sentient") => "angle-double-up",
__("Angle Double Down", "sentient") => "angle-double-down",
__("Angle Left", "sentient") => "angle-left",
__("Angle Right", "sentient") => "angle-right",
__("Angle Up", "sentient") => "angle-up",
__("Angle Down", "sentient") => "angle-down",
__("Anchor", "sentient") => "anchor",
__("Android", "sentient") => "android",
__("Apple", "sentient") => "apple",
__("Archive", "sentient") => "archive",
__("Automobile", "sentient") => "automobile",
__("Bars", "sentient") => "bars",
__("Backward", "sentient") => "backward",
__("Ban", "sentient") => "ban",
__("Bar Code", "sentient") => "barcode",
__("Bank", "sentient") => "bank",
__("Bell", "sentient") => "bell",
__("Book", "sentient") => "book",
__("Bookmark", "sentient") => "bookmark",
__("Bold", "sentient") => "bold",
__("Bullhorn", "sentient") => "bullhorn",
__("Briefcase", "sentient") => "briefcase",
__("Bolt", "sentient") => "bolt",
__("Beer", "sentient") => "beer",
__("Behance", "sentient") => "behance",
__("Behance Square", "sentient") => "behance-square",
__("Bitcoin", "sentient") => "bitcoin",
__("Bitbucket", "sentient") => "bitbucket",
__("Bitbucket-square", "sentient") => "bitbucket-square",
__("Bomb", "sentient") => "bomb",
__("BTC", "sentient") => "glass",
__("Bullseye", "sentient") => "bullseye",
__("Bug", "sentient") => "bug",
__("Building", "sentient") => "building",
__("Check", "sentient") => "check",
__("Cog", "sentient") => "cog",
__("Camera", "sentient") => "camera",
__("Chevron Left", "sentient") => "chevron-left",
__("Chevron Right", "sentient") => "chevron-right",
__("Check Circle", "sentient") => "check-circle",
__("Cross Hairs", "sentient") => "crosshairs",
__("Compress", "sentient") => "compress",
__("Calendar", "sentient") => "calendar",
__("Comment", "sentient") => "comment",
__("Chevron Up", "sentient") => "hevron-up",
__("Chevron Down", "sentient") => "chevron-down",
__("Camera Retro", "sentient") => "camera-retro",
__("Cogs", "sentient") => "cogs",
__("Comments", "sentient") => "comments",
__("Credit Card", "sentient") => "credit-card",
__("Certificate", "sentient") => "certificate",
__("Chain", "sentient") => "chain",
__("Cloud", "sentient") => "cloud",
__("Cut", "sentient") => "cut",
__("Copy", "sentient") => "copy",
__("Caret Down", "sentient") => "caret-down",
__("Caret Up", "sentient") => "caret-up",
__("Caret Left", "sentient") => "caret-left",
__("Caret Right", "sentient") => "caret-right",
__("Columns", "sentient") => "columns",
__("Clipboard", "sentient") => "clipboard",
__("Cloud Download", "sentient") => "cloud-download",
__("Cloud Upload", "sentient") => "cloud-upload",
__("Coffee", "sentient") => "coffee",
__("Cutlery", "sentient") => "cutlery",
__("Car", "sentient") => "car",
__("Cab", "sentient") => "cab",
__("Chevron Circle Left", "sentient") => "chevron-circle-left",
__("Chevron Circle Right", "sentient") => "chevron-circle-right",
__("Chevron Circle Up", "sentient") => "chevron-circle-up",
__("Chevron Circle Down", "sentient") => "chevron-circle-down",
__("Check Square", "sentient") => "check-square",
__("Child", "sentient") => "child",
__("Chain Broken", "sentient") => "chain-broken",
__("Circle", "sentient") => "circle",
__("Circle Thin", "sentient") => "circle-thin",
__("CNY", "sentient") => "cny",
__("Code", "sentient") => "code",
__("Compass", "sentient") => "compass",
__("Code Pen", "sentient") => "codepen",
__("css3", "sentient") => "css3",
__("Cube", "sentient") => "cube",
__("Cubes", "sentient") => "cubes",
__("Download", "sentient") => "download",
__("Dedent", "sentient") => "dedent",
__("Dashboard", "sentient") => "dashboard",
__("Database", "sentient") => "database",
__("Deviantart", "deviantart") => "glass",
__("Desktop", "sentient") => "desktop",
__("Delicious", "sentient") => "delicious",
__("Drupal", "sentient") => "drupal",
__("Dribbble", "sentient") => "dribbble",
__("Dropbox", "sentient") => "dropbox",
__("Dollar", "sentient") => "dollar",
__("Digg", "sentient") => "digg",
__("Exchange", "sentient") => "exchange",
__("Eject", "sentient") => "eject",
__("Expand", "sentient") => "expand",
__("Exclamation Circle", "sentient") => "exclamation-circle",
__("Eye", "sentient") => "eye",
__("Eye Slash", "sentient") => "eye-slash",
__("Exclamation Triangle", "sentient") => "exclamation-triangle",
__("External Link", "sentient") => "external-link",
__("Envelope", "sentient") => "envelope",
__("Empire", "sentient") => "empire",
__("Envelope Square", "sentient") => "envelope-square",
__("External Link Square", "sentient") => "external-link-square",
__("Eraser", "sentient") => "eraser",
__("Exclamation", "sentient") => "exclamation",
__("Ellipsis Horizontal", "sentient") => "ellipsis-h",
__("Ellipsis Vertical", "sentient") => "ellipsis-v",
__("Euro", "sentient") => "euro",
__("Eur", "sentient") => "eur",
__("Flash", "sentient") => "flash",
__("Fighter Jet", "sentient") => "fighter-jet",
__("Film", "sentient") => "film",
__("Flag", "sentient") => "flag",
__("Font", "sentient") => "font",
__("Fast Backward", "sentient") => "fast-backward",
__("Forward", "sentient") => "forward",
__("Fast Forward", "sentient") => "fast-forward",
__("Fire", "sentient") => "fire",
__("folder", "sentient") => "folder",
__("Folder Open", "sentient") => "folder-open",
__("Facebook Square", "sentient") => "facebook-square",
__("Facebook", "sentient") => "facebook",
__("Filter", "sentient") => "filter",
__("Flask", "sentient") => "flask",
__("Fax", "sentient") => "fax",
__("Female", "sentient") => "female",
__("Foursquare", "sentient") => "foursquare",
__("Fire Extinguisher", "sentient") => "fire-extinguisher",
__("Flag Checkered", "sentient") => "flag-checkered",
__("Folder Open", "sentient") => "folder-open-o",
__("File", "sentient") => "file",
__("File Text", "sentient") => "file-text",
__("Flickr", "sentient") => "flickr",
__("Google Plus Square", "google-plus-square") => "glass",
__("Google Plus", "sentient") => "google-plus",
__("Gavel", "sentient") => "gavel",
__("Glass", "sentient") => "glass",
__("Gear", "sentient") => "gear",
__("Gift", "sentient") => "gift",
__("Gears", "sentient") => "gears",
__("Github-Square", "sentient") => "github-square",
__("Github", "sentient") => "github",
__("Globe", "sentient") => "globe",
__("Group", "sentient") => "group",
__("Git Square", "sentient") => "git-square",
__("GE", "sentient") => "ge",
__("Google", "sentient") => "google",
__("Graduation Cap", "sentient") => "graduation-cap",
__("Git Tip", "sentient") => "gittip",
__("GBP", "sentient") => "gbp",
__("Gamepad", "sentient") => "gamepad",
__("Github Alt", "sentient") => "github-alt",
__("Git", "sentient") => "git",
__("Heart", "sentient") => "heart",
__("Home", "sentient") => "home",
__("Headphones", "sentient") => "headphones",
__("Header", "sentient") => "header",
__("History", "sentient") => "history",
__("hacker-news", "sentient") => "hacker-news",
__("html5", "sentient") => "html5",
__("H Square", "sentient") => "h-square",
__("Italic", "sentient") => "italic",
__("Indent", "sentient") => "indent",
__("image", "sentient") => "image",
__("Info Circle", "sentient") => "info-circle",
__("Inverse", "sentient") => "inverse",
__("Inbox", "sentient") => "inbox",
__("Institution", "sentient") => "institution",
__("Instagram", "sentient") => "instagram",
__("INR", "sentient") => "inr",
__("Info", "sentient") => "info",
__("JS Fiddle", "sentient") => "jsfiddle",
__("Joomla", "sentient") => "joomla",
__("JPY", "sentient") => "jpy",
__("Key", "sentient") => "key",
__("KRW", "sentient") => "krw",
__("Linkedin Square", "sentient") => "linkedin-square",
__("Link", "sentient") => "link",
__("List ul", "sentient") => "list-ul",
__("List ol", "sentient") => "list-ol",
__("Linkedin", "sentient") => "linkedin",
__("Legal", "sentient") => "legal",
__("List", "sentient") => "list-alt",
__("Lock", "sentient") => "lock",
__("List", "sentient") => "list",
__("Leaf", "sentient") => "leaf",
__("Life Bouy", "sentient") => "life-bouy",
__("Life Saver", "sentient") => "life-saver",
__("Language", "sentient") => "language",
__("Laptop", "sentient") => "laptop",
__("Level Up", "sentient") => "level-up",
__("Level Down", "sentient") => "level-down",
__("Long Arrow Down", "sentient") => "long-arrow-down",
__("Long Arrow Up", "sentient") => "long-arrow-up",
__("Long Arrow Left", "sentient") => "long-arrow-left",
__("Long Arrow Right", "sentient") => "long-arrow-right",
__("Linux", "sentient") => "linux",
__("Life Ring", "sentient") => "life-ring",
__("Magnet", "sentient") => "magnet",
__("Magic", "sentient") => "magic",
__("Money", "sentient") => "money",
__("Medkit", "sentient") => "medkit",
__("Music", "sentient") => "music",
__("Minus Circle", "sentient") => "minus-circle",
__("Mail Forward", "sentient") => "mail-forward",
__("Minus", "sentient") => "minus",
__("Mortar Board", "sentient") => "mortar-board",
__("Male", "sentient") => "male",
__("Minus Square", "sentient") => "minus-square",
__("Maxcdn", "sentient") => "maxcdn",
__("Mobile Phone", "sentient") => "mobile-phone",
__("mobile", "sentient") => "mobile",
__("Mail Reply", "sentient") => "mail-reply",
__("Microphone", "sentient") => "microphone",
__("Microphone Slash", "sentient") => "microphone-slash",
__("Navicon", "sentient") => "navicon",
__("Open Comment", "sentient") => "comment-o",
__("Open comments", "sentient") => "comments-o",
__("Open Lightbulb", "sentient") => "lightbulb-o",
__("Open Bell", "sentient") => "bell-o",
__("Open File Text", "sentient") => "file-text-o",
__("Open Building", "sentient") => "building-o",
__("Open Hospital", "sentient") => "hospital-o",
__("Open Envelope", "sentient") => "envelope-o",
__("Open Star", "sentient") => "star-o",
__("Open Trash", "sentient") => "trash-o",
__("Open File", "sentient") => "file-o",
__("Open Clock", "sentient") => "clock-o",
__("Open Arrow Circle Down", "sentient") => "arrow-circle-o-down",
__("Open Arrow Circle Up", "sentient") => "arrow-circle-o-up",
__("Open Play Circle", "sentient") => "play-circle-o",
__("Outdent", "sentient") => "outdent",
__("Open Picture", "sentient") => "picture-o",
__("Open Pencil Square", "sentient") => "pencil-square-o",
__("Open Share Square", "sentient") => "share-square-o",
__("Open Check Square", "sentient") => "check-square-o",
__("Open Times Circle", "sentient") => "times-circle-o",
__("Open Check Circle", "sentient") => "check-circle-o",
__("Open Bar Chart", "sentient") => "bar-chart-o",
__("Open Thumbs Up", "sentient") => "thumbs-o-up",
__("Open Thumbs Down", "sentient") => "thumbs-o-down",
__("Open Heart", "sentient") => "heart-o",
__("Open Lemon", "sentient") => "lemon-o",
__("Open Square", "sentient") => "square",
__("Open Bookmark", "sentient") => "bookmark-o",
__("Open hdd", "sentient") => "hdd-o",
__("Open Hand Right", "sentient") => "hand-o-right",
__("Open Hand Left", "sentient") => "hand-o-left",
__("Open Hand Up", "sentient") => "hand-o-up",
__("Open Hand Down", "sentient") => "hand-o-down",
__("Open Files", "sentient") => "files-o",
__("Open Floppy", "sentient") => "floppy-o",
__("Open Circle", "sentient") => "circle-o",
__("Open Folder", "sentient") => "folder-o",
__("Open Smile", "sentient") => "smile-o",
__("Open Frown", "sentient") => "frown-o",
__("Open Meh", "sentient") => "meh-o",
__("Open Keyboard", "sentient") => "keyboard-o",
__("Open Flag", "sentient") => "flag-o",
__("Open Calendar", "sentient") => "calendar-o",
__("Open Minus Square", "sentient") => "minus-square-o",
__("Open Caret Square Down", "sentient") => "caret-square-o-down",
__("Open Caret Square Up", "sentient") => "caret-square-o-up",
__("Open Caret Square Right", "sentient") => "caret-square-o-right",
__("Open Sun", "sentient") => "sun-o",
__("Open Moon", "sentient") => "moon-o",
__("Open Arrow Circle Right", "sentient") => "arrow-circle-o-right",
__("Open Arrow Circle Left", "sentient") => "arrow-circle-o-left",
__("Open Caret Square Left", "sentient") => "caret-square-o-left",
__("Open Dot Circle", "sentient") => "dot-circle-o",
__("Open Plus Square", "sentient") => "plus-square-o",
__("Open ID", "sentient") => "openid",
__("Open File pdf", "sentient") => "file-pdf-o",
__("Open File Word", "sentient") => "file-word-o",
__("Open File Eexcel", "sentient") => "file-excel-o",
__("Open File Powerpoint", "sentient") => "file-powerpoint-o",
__("Open File Photo", "sentient") => "file-photo-o",
__("Open File Picture", "sentient") => "file-picture-o",
__("Open File Image", "sentient") => "file-image-o",
__("Open File Zip", "sentient") => "file-zip-o",
__("Open File Archive", "sentient") => "file-archive-o",
__("Open File Sound", "sentient") => "file-sound-o",
__("Open File Audio", "sentient") => "file-audio-o",
__("Open File Movie", "sentient") => "file-movie-o",
__("Open File Video", "sentient") => "file-video-o",
__("Open File Code", "sentient") => "file-code-o",
__("Open Circle Notch", "sentient") => "circle-o-notch",
__("Open Send", "sentient") => "send-o",
__("Open Paper Plane", "sentient") => "paper-plane-o",
__("Pinterest", "sentient") => "pinterest",
__("Pinterest Square", "sentient") => "pinterest-square",
__("Paste", "sentient") => "paste",
__("Power Off", "sentient") => "power-off",
__("Print", "sentient") => "print",
__("Photo", "sentient") => "photo",
__("Play", "sentient") => "play",
__("Pause", "sentient") => "pause",
__("Plus Circle", "sentient") => "plus-circle",
__("Plus", "sentient") => "plus",
__("Plane", "sentient") => "plane",
__("Phone", "sentient") => "phone",
__("phone-square", "sentient") => "Phone Square",
__("Paper Clip", "sentient") => "paperclip",
__("Puzzle Piece", "sentient") => "puzzle-piece",
__("Play Circle", "sentient") => "play-circle",
__("Pencil Square", "sentient") => "pencil-square",
__("Page Lines", "sentient") => "pagelines",
__("Pied Piper Square", "sentient") => "pied-piper-square",
__("Pied Piper", "sentient") => "pied-piper",
__("Pied Piper Alt", "sentient") => "pied-piper-alt",
__("Paw", "sentient") => "paw",
__("Paper Plane", "sentient") => "paper-plane",
__("Paragraph", "sentient") => "paragraph",
__("Plus Square", "sentient") => "plus-square",
__("QR Code", "sentient") => "qrcode",
__("Question Circle", "sentient") => "question-circle",
__("Question", "sentient") => "question",
__("QQ", "sentient") => "qq",
__("Quote Left", "sentient") => "quote-left",
__("Quote Right", "sentient") => "quote-right",
__("Random", "sentient") => "random",
__("Retweet", "sentient") => "retweet",
__("Rss", "sentient") => "rss",
__("Reorder", "sentient") => "reorder",
__("Rotate Left", "sentient") => "rotate-left",
__("Road", "sentient") => "road",
__("Rotate Right", "sentient") => "rotate-right",
__("Repeat", "sentient") => "repeat",
__("Refresh", "sentient") => "refresh",
__("Reply", "sentient") => "reply",
__("Rocket", "sentient") => "rocket",
__("Rss Square", "sentient") => "rss-square",
__("Rupee", "sentient") => "rupee",
__("RMB", "sentient") => "rmb",
__("Ruble", "sentient") => "ruble",
__("Rouble", "sentient") => "rouble",
__("Rub", "sentient") => "rub",
__("Renren", "sentient") => "renren",
__("Reddit", "sentient") => "reddit",
__("Reddit Square", "sentient") => "reddit-square",
__("Recycle", "sentient") => "recycle",
__("RA", "sentient") => "ra",
__("Rebel", "sentient") => "rebel",
__("Step Backward", "sentient") => "step-backward",
__("Stop", "sentient") => "stop",
__("Step Forward", "sentient") => "step-forward",
__("Share", "sentient") => "share",
__("Shopping Cart", "sentient") => "shopping-cart",
__("Star Half", "sentient") => "star-half",
__("Sign Out", "sentient") => "sign-out",
__("Sign In", "sentient") => "sign-in",
__("Scissors", "sentient") => "scissors",
__("Save", "sentient") => "save",
__("Square", "sentient") => "square",
__("Strikethrough", "sentient") => "strikethrough",
__("Sort", "sentient") => "sort",
__("Sort Down", "sentient") => "sort-down",
__("Sort Desc", "sentient") => "sort-desc",
__("Sort Up", "sentient") => "sort-up",
__("Sort Asc", "sentient") => "sort-asc",
__("Sitemap", "sentient") => "sitemap",
__("Search", "sentient") => "search",
__("Star", "sentient") => "star",
__("Stethoscope", "sentient") => "stethoscope",
__("Suitcase", "sentient") => "suitcase",
__("Search Plus", "sentient") => "search-plus",
__("Search Minus", "sentient") => "search-minus",
__("Signal", "sentient") => "signal",
__("Spinner", "sentient") => "Spinner",
__("Superscript", "sentient") => "superscript",
__("Subscript", "sentient") => "subscript",
__("Shield", "sentient") => "shield",
__("Share Square", "sentient") => "share-square",
__("Sort Alpha Asc", "sentient") => "sort-alpha-asc",
__("Sort Alpha Desc", "sentient") => "sort-alpha-desc",
__("Sort Amount ASC", "sentient") => "sort-amount-asc",
__("Sort Amount Desc", "sentient") => "sort-amount-desc",
__("Sort Numeric Asc", "sentient") => "sort-numeric-asc",
__("Sort Numeric Desc", "sentient") => "sort-numeric-desc",
__("Stack Overflow", "sentient") => "stack-overflow",
__("Skype", "sentient") => "skype",
__("Stack Exchange", "sentient") => "stack-exchange",
__("Space Shuttle", "sentient") => "space-shuttle",
__("Slack", "sentient") => "Slack",
__("Stumbleupon Circle", "sentient") => "stumbleupon-circle",
__("Stumbleupon", "sentient") => "stumbleupon",
__("Spoon", "sentient") => "spoon",
__("Steam", "sentient") => "steam",
__("Steam Square", "sentient") => "steam-square",
__("Spotify", "sentient") => "spotify",
__("Sound Cloud", "sentient") => "soundcloud",
__("Support", "sentient") => "support",
__("Send", "sentient") => "send",
__("Sliders", "sentient") => "sliders",
__("Share Alt", "sentient") => "share-alt",
__("Share Alt Square", "sentient") => "share-alt-square",
__("Tag", "sentient") => "tag",
__("Tags", "sentient") => "tags",
__("Text Height", "sentient") => "text-height",
__("Text Width", "sentient") => "text-width",
__("Times Circle", "sentient") => "times-circle",
__("Twitter Square", "sentient") => "twitter-square",
__("Thumb Tack", "sentient") => "thumb-tack",
__("Trophy", "sentient") => "trophy",
__("Twitter", "sentient") => "twitter",
__("Tasks", "sentient") => "tasks",
__("Truck", "sentient") => "truck",
__("Tachometer", "sentient") => "tachometer",
__("Thumbnail Large", "sentient") => "th-large",
__("Thumbnail", "sentient") => "th",
__("Thumbnail List", "sentient") => "th-list",
__("Times", "sentient") => "times",
__("Ticket", "sentient") => "ticket",
__("Toggle Down", "sentient") => "toggle-down",
__("Toggle Up", "sentient") => "toggle-up",
__("Toggle Right", "sentient") => "toggle-right",
__("Thumbs Up", "sentient") => "thumbs-up",
__("Thumbs Down", "sentient") => "thumbs-down",
__("Tumblr", "sentient") => "tumblr",
__("Tumblr Square", "sentient") => "tumblr-square",
__("Trello", "sentient") => "trello",
__("Toggle Left", "sentient") => "toggle-left",
__("Turkish Lira", "sentient") => "turkish-lira",
__("Try", "sentient") => "try",
__("Taxi", "sentient") => "taxi",
__("Tree", "sentient") => "tree",
__("Tencent Weibo", "sentient") => "tencent-weibo",
__("Tablet", "sentient") => "tablet",
__("Terminal", "sentient") => "terminal",
__("Upload", "sentient") => "upload",
__("Unlock", "sentient") => "unlock",
__("Users", "sentient") => "users",
__("Underline", "sentient") => "underline",
__("Unsorted", "sentient") => "unsorted",
__("Undo", "sentient") => "undo",
__("User md", "sentient") => "user-md",
__("Umbrella", "sentient") => "umbrella",
__("User", "sentient") => "user",
__("Unlock Alt", "sentient") => "unlock-alt",
__("USD", "sentient") => "usd",
__("University", "sentient") => "university",
__("Unlink", "sentient") => "unlink",
__("Volume Off", "sentient") => "volume-off",
__("Volume Down", "sentient") => "volume-down",
__("Volume Up", "sentient") => "volume-up",
__("Video Camera", "sentient") => "video-camera",
__("VK", "sentient") => "vk",
__("Vimeo Square", "sentient") => "vimeo-square",
__("Vine", "sentient") => "vine",
__("Warning", "sentient") => "warning",
__("Wrench", "sentient") => "wrench",
__("Won", "sentient") => "won",
__("Windows", "sentient") => "windows",
__("Weibo", "sentient") => "weibo",
__("Wheel Chair", "sentient") => "wheelchair",
__("WordPress", "sentient") => "wordpress",
__("We Chat", "sentient") => "wechat",
__("Weixin", "sentient") => "weixin",
__("Xing", "sentient") => "xing",
__("Xing Square", "sentient") => "xing-square",
__("YEN", "sentient") => "yen",
__("Youtube Square", "sentient") => "youtube-square",
__("Youtube", "sentient") => "youtube",
__("Youtube Play", "sentient") => "youtube-play",
__("Yahoo", "sentient") => "yahoo",
__("Bed", "sentient") => "bed",
__("Buy Sell Ads", "sentient") => "buysellads",
__("Cart Arrow Down", "sentient") => "cart-arrow-down",
__("Cart Plus", "sentient") => "cart-plus",
__("Connect Develop", "sentient") => "connectdevelop",
__("Dash Cube", "sentient") => "dashcube",
__("Diamond", "sentient") => "diamond",
__("Facebook Official", "sentient") => "facebook-official",
__("Forum Bee", "sentient") => "forumbee",
__("Heartbeat", "sentient") => "heartbeat",
__("Hotel", "sentient") => "hotel",
__("Lean Pub", "sentient") => "leanpub",
__("Mars", "sentient") => "mars",
__("Mars Double", "sentient") => "mars-double",
__("Mars Stroke", "sentient") => "mars-stroke",
__("Mars Stroke Horizontal", "sentient") => "mars-stroke-h",
__("Mars Stroke Vertical", "sentient") => "mars-stroke-v",
__("Medium", "sentient") => "medium",
__("Mercury", "sentient") => "mercury",
__("Motorcycle", "sentient") => "motorcycle",
__("Neuter", "sentient") => "neuter",
__("Pinterest Character", "sentient") => "pinterest-p",
__("Sellsy", "sentient") => "sellsy",
__("Server", "sentient") => "server",
__("Ship", "sentient") => "ship",
__("Shirt Sin Bulk", "sentient") => "shirtsinbulk",
__("Sky Atlas", "sentient") => "skyatlas",
__("Street View", "sentient") => "street-view",
__("Subway", "sentient") => "subway",
__("Train", "sentient") => "train",
__("Trans Gender", "sentient") => "transgender",
__("Trans Gender Alt", "sentient") => "transgender-alt",
__("User Plus", "sentient") => "user-plus",
__("User Secret", "sentient") => "user-secret",
__("User Times", "sentient") => "user-times",
__("Venus", "sentient") => "venus",
__("Venus Double", "sentient") => "venus-double",
__("Venus Mars", "sentient") => "venus-mars",
__("Via Coin", "sentient") => "viacoin",
__("Whatsapp", "sentient") => "whatsapp",
);

$insperia_alert_arr = array(
__("Warning", "insperia") => "warning",
__("Danger", "insperia") => "danger",
__("Success", "insperia") => "success",
__("Information", "insperia") => "info"
);

/***************************************************/
/*Insperia General Array's that will be used - End*/
/***************************************************/




/***************************************************/
/*Insperia Search Query Function - Started*/
/***************************************************/
if(!is_admin()){
    add_action('init', 'insperia_search_query_fix');
    function insperia_search_query_fix(){
        if(isset($_GET['s']) && $_GET['s']==''){
            $_GET['s']=' ';
        }
    }
}

function insperia_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}
/***************************************************/
/*Insperia Search Query Function - End*/
/***************************************************/



/***************************************************/
/*Insperia Add Post Thumbnails size - Started*/
/***************************************************/
	
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 500, 500, true );
	set_post_thumbnail_size( 600, 800, true );
	set_post_thumbnail_size( 900, 9999, true );
	set_post_thumbnail_size( 360, 300, true );
	set_post_thumbnail_size( 80, 80, true );
	set_post_thumbnail_size( 380, 255, true );		
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'insperia-team', 500, 500, true ); //(cropped)
	add_image_size( 'insperia-portfolio-small', 600, 800, true ); //(cropped)
	add_image_size( 'insperia-blog-big', 900, 9999, true ); //(cropped)
	add_image_size( 'insperia-blog-small', 360, 300, true ); //(cropped)
	add_image_size( 'insperia-testimonial-thumb', 80, 80, true ); //(cropped)
	add_image_size( 'insperia-portfolio-thumb', 380, 255, true ); //(cropped)			
}

/***************************************************/
/*Insperia Add Post Thumbnails sizes - End*/
/***************************************************/



/***************************************************/
/*Insperia Menu Fall Back Function - Started */
/***************************************************/
function insperia_menu_fall_back(){
	
	echo '<ul class="nav navbar-nav navbar-right ">';
	wp_list_pages(
      array(
        'title_li'  => '',
      	'sort_column'=> 'menu_order',
      )
    );
    echo '</ul>';	

}
/***************************************************/
/*Insperia Menu Fall Back Function - End */
/***************************************************/



/***************************************************/
/*Insperia excerpt string function - Started */
/***************************************************/
function insperia_excerpt_more_string( $more ) {
	return '...';
}
/***************************************************/
/*Insperia excerpt string function - End */
/***************************************************/



/***************************************************/
/*Insperia excerpt length Function - Started */
/***************************************************/
function insperia_custom_excerpt_length( $length ) {
	return 80;
}
/***************************************************/
/*Insperia excerpt length Function - End */
/***************************************************/



/***************************************************/
/*Insperia , Add Shortcodes to Visual Composer - Started */
/***************************************************/

/* Here we will check if the Visual Composer is activated */

if(function_exists('vc_map')){

	
	/*------------------------------------------------------
	Insperia Homepage Row Start - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Row Begin" , "insperia"),
	   "base" => "homepage_container",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Color?" , "insperia"),
			 "param_name" => "type",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose No it will put the background image." , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Background color for your Row" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "insperia"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => __("Please Choose Font color for your Row" , "insperia")
		  ),
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image" , "insperia"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Background Image for your Row" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Position" , "insperia"),
			 "param_name" => "backgroundposition",
			 "value" => "0 0",
			 "description" => __("Background Position for your row background (e.g. 0 0 , center center , ...etc)" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Size" , "insperia"),
			 "param_name" => "backgroundsize",
			 "value" => "100%",
			 "description" => __("Background Size for your row background (e.g. 100% , 50% , ...etc)" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it Parallax" , "insperia"),
			 "param_name" => "parallax",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Do you want to make Background Image Parallax?" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image Repeat" , "insperia"),
			 "param_name" => "repeat",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Do you want to Repeat Background Image?" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Top" , "insperia"),
			 "param_name" => "paddingtop",
			 "value" => "40px",
			 "description" => __("Distance between row and content from top side" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Bottom" , "insperia"),
			 "param_name" => "paddingbottom",
			 "value" => "40px",
			 "description" => __("Distance between row and content from bottom side" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Top" , "insperia"),
			 "param_name" => "bordertop",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Do you want to display border on the top of the row" , "insperia")
		  )
	   )
	) );


	
	/*------------------------------------------------------
	Insperia Homepage Row Wide Start - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Row Wide Begin" , "insperia"),
	   "base" => "homepage_container_wide",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Color?" , "insperia"),
			 "param_name" => "type",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose No it will put the background image." , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#FFFFFF",
			 "description" => __("Please Choose Background color for your Row" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Font color" , "insperia"),
			 "param_name" => "font",
			 "value" => "#787878",
			 "description" => __("Please Choose Font color for your Row" , "insperia")
		  ),
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image" , "insperia"),
			 "param_name" => "background",
			 "value" => "",
			 "description" => __("Please Choose Background Image for your Row" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Image Repeat" , "insperia"),
			 "param_name" => "repeat",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Do you want to Repeat Background Image?" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Top" , "insperia"),
			 "param_name" => "paddingtop",
			 "value" => "40px",
			 "description" => __("Distance between row and content from top side" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Padding from Bottom" , "insperia"),
			 "param_name" => "paddingbottom",
			 "value" => "40px",
			 "description" => __("Distance between row and content from bottom side" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Top" , "insperia"),
			 "param_name" => "bordertop",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Do you want to display border on the top of the row" , "insperia")
		  )
	   )
	) );


	
	/*------------------------------------------------------
	Insperia Homepage Row End - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Row End" , "insperia"),
	   "base" => "homepage_container_end",
	   "class" => "",
	   "show_settings_on_create" => true,   
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Bottom" , "insperia"),
			 "param_name" => "borderbottom",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Do you want to display border on the bottom of the row" , "insperia")
		  )
		)
	) );



	
	/*------------------------------------------------------
	Insperia Text - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Text Block" , "insperia"),
	   "base" => "insperia_text",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text Block Content" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#999",
			 "description" => __("Please Choose Font color for your Text Block" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the Text align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Text Animation effect" , "insperia")
		  )
	   )
	) );		
		
	
	
	/*------------------------------------------------------
	Insperia Heading with Icon - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Heading with Icon" , "insperia"),
	   "base" => "insperia_heading_icon",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon" , "insperia"),
			 "param_name" => "icon",
			 "value" => $insperia_icon_arr,
			 "description" => __("Choose Icon for your heading" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Text Size (Pixels)" , "insperia"),
			 "param_name" => "size",
			 "value" => "16px",
			 "description" => __("Enter Heading Text Size (Pixels)" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Icon Color" , "insperia"),
			 "param_name" => "iconcolor",
			 "value" => "#242526",
			 "description" => __("Please Choose Icon color for your Heading" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the heading align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );		
	
	
	/*------------------------------------------------------
	Insperia Clients - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Clients" , "insperia"),
	   "base" => "insperia_clients",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Clients Images" , "insperia"),
			 "param_name" => "images",
			 "value" => "",
			 "description" => __("Please Choose Clients Images for your Clients section" , "insperia")
		  )
		  )
	   )
	);	
	

	
	/*------------------------------------------------------
	Insperia H1 - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia H1" , "insperia"),
	   "base" => "insperia_heading_one",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the heading align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );		
	
	
	
	/*------------------------------------------------------
	Insperia H2 - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia H2" , "insperia"),
	   "base" => "insperia_heading_two",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the heading align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );		
	
	
	
	/*------------------------------------------------------
	Insperia H3 - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia H3" , "insperia"),
	   "base" => "insperia_heading_three",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the heading align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );	
	
	
	
	/*------------------------------------------------------
	Insperia H4 - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia H4" , "insperia"),
	   "base" => "insperia_heading_four",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the heading align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );



	/*------------------------------------------------------
	Insperia H5 - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia H5" , "insperia"),
	   "base" => "insperia_heading_five",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the heading align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );	
	

	
	/*------------------------------------------------------
	Insperia H6 - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia H6" , "insperia"),
	   "base" => "insperia_heading_six",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Align" , "insperia"),
			 "param_name" => "align",
			 "value" => $insperia_align,
			 "description" => __("Here you will choose the heading align" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );	
	

	
	/*------------------------------------------------------
	Insperia List Items - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia List Item" , "insperia"),
	   "base" => "insperia_list_item",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("List Text" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter List Text" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon" , "insperia"),
			 "param_name" => "icon",
			 "value" => $insperia_icon_arr,
			 "description" => __("Choose Icon for your List Item" , "insperia")
		  ),	  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("List Item color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your List Item" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("List Item Icon Color" , "insperia"),
			 "param_name" => "iconcolor",
			 "value" => "#242526",
			 "description" => __("Please Choose Icon color for your List Item" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it Rotate?" , "insperia"),
			 "param_name" => "rotate",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Choose if you want your list item icon to rotate" , "insperia")
		  )
	   )
	) );		
	
	/*------------------------------------------------------
	Insperia Page Section - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Page Section" , "sentient"),
	   "base" => "insperia_page_section",
	   "class" => "",
	   "category" => __('Content' , "sentient"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter a unique ID" , "sentient"),
			 "param_name" => "id",
			 "value" => "",
			 "description" => __("This ID must be unique and should not be duplicated in this page" , "sentient")
		  )
	   )
	) );
	
	/*------------------------------------------------------
	Insperia Pricing Table - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Pricing Table" , "insperia"),
	   "base" => "insperia_pricing_table",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table Plan Name" , "insperia"),
			 "param_name" => "planname",
			 "value" => "",
			 "description" => __("Enter Table Plan Name" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table Ribbon Title" , "insperia"),
			 "param_name" => "ribbon",
			 "value" => "",
			 "description" => __("Enter Table Ribbon Title or keep it empty to hide" , "insperia")
		  ),	  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose color for your Table" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table Price Currency" , "insperia"),
			 "param_name" => "currency",
			 "value" => "",
			 "description" => __("Enter Table Price Currency" , "insperia")
		  ),	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table Price Amount" , "insperia"),
			 "param_name" => "amount",
			 "value" => "",
			 "description" => __("Enter Table Price Amount" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table period" , "insperia"),
			 "param_name" => "period",
			 "value" => "",
			 "description" => __("Enter Table period" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table brief description" , "insperia"),
			 "param_name" => "desc",
			 "value" => "",
			 "description" => __("Enter Table brief description" , "insperia")
		  ),	
		  array(
			 "type" => "textarea_raw_html",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table content" , "insperia"),
			 "param_name" => "tablecontent",
			 "value" => base64_encode( '' ),
			 "description" => __("Enter Table content as list items and each item should be inside < li > < /li >, also if you want to use red X icon then use < span class='glyphicon glyphicon-remove no' >< /span > and for the green check icon then use < span class='glyphicon glyphicon-ok yes' >< /span >" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table link URL" , "insperia"),
			 "param_name" => "link",
			 "value" => "",
			 "description" => __("Enter Table link URL" , "insperia")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Table link button Title" , "insperia"),
			 "param_name" => "buttonname",
			 "value" => "",
			 "description" => __("Enter Table link button Title" , "insperia")
		  )		  
	   )
	) );		
	

	/*------------------------------------------------------
	Insperia Underlined - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Underlined Title" , "insperia"),
	   "base" => "insperia_heading_underlined",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Title" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Heading Title" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Make it stronger?" , "insperia"),
			 "param_name" => "stronger",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("If you choose Yes it will be add more font weight to the heading" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#242526",
			 "description" => __("Please Choose Font color for your Heading" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Font Size" , "insperia"),
			 "param_name" => "size",
			 "value" => "24px",
			 "description" => __("Enter Heading Font Size in Pixels" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );


	
	/*------------------------------------------------------
	Insperia Icons - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Services Icon" , "insperia"),
	   "base" => "insperia_icons",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Icon Style" , "insperia"),
			 "param_name" => "iconstyle",
			 "value" => $insperia_services_styles_arr,
			 "description" => __("Choose icon style for your service layout" , "insperia")
		  ),		   
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Icon" , "insperia"),
			 "param_name" => "icon",
			 "value" => $insperia_icon_arr,
			 "description" => __("Choose icon for your service" , "insperia")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Title" , "insperia"),
			 "param_name" => "title",
			 "value" => "",
			 "description" => __("Enter Title" , "insperia")
		  ),		  
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Content" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Content" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Link (For Style 4 only)" , "insperia"),
			 "param_name" => "link",
			 "value" => "",
			 "description" => __("Enter URL" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Link Text (For Style 4 only)" , "insperia"),
			 "param_name" => "linktext",
			 "value" => "",
			 "description" => __("Enter Link Text" , "insperia")
		  )
	   )
	) );		
	


	/*------------------------------------------------------
	Insperia Contact Details - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Contact Details" , "insperia"),
	   "base" => "insperia_contact_details",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Company Name" , "insperia"),
			 "param_name" => "companyname",
			 "value" => "",
			 "description" => __("Your Company Name" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Details Title" , "insperia"),
			 "param_name" => "detailstitle",
			 "value" => "Contact Details",
			 "description" => __("Contact Details" , "insperia")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address line 1" , "insperia"),
			 "param_name" => "addressone",
			 "value" => "",
			 "description" => __("Enter Company Address line 1" , "insperia")
		  ),   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address line 2" , "insperia"),
			 "param_name" => "addresstwo",
			 "value" => "",
			 "description" => __("Enter Address line 2" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Address section Phone #" , "insperia"),
			 "param_name" => "addressphone",
			 "value" => "",
			 "description" => __("Enter Address section Phone #" , "insperia")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Company Phone #" , "insperia"),
			 "param_name" => "phone",
			 "value" => "",
			 "description" => __("Enter Company Phone #" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Company Phone #2" , "insperia"),
			 "param_name" => "phonetwo",
			 "value" => "",
			 "description" => __("Enter Company Phone #2 (If any)" , "insperia")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Company Email Address" , "insperia"),
			 "param_name" => "email",
			 "value" => "",
			 "description" => __("Enter Company Email Address" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Company Website" , "insperia"),
			 "param_name" => "website",
			 "value" => "",
			 "description" => __("Enter Company Website" , "insperia")
		  )
	   )
	) );			
	
	
	
	/*------------------------------------------------------
	Insperia Animated Numbers - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Animated Numbers" , "insperia"),
	   "base" => "insperia_animated_numbers",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Circle Background Color" , "insperia"),
			 "param_name" => "circlebg",
			 "value" => "#ffffff",
			 "description" => __("Please Choose Circle Background color for your Animated Number" , "insperia")
		  ),	   
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers Icon" , "insperia"),
			 "param_name" => "icon",
			 "value" => $insperia_icon_arr,
			 "description" => __("Choose icon for your Animated Number" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon color" , "insperia"),
			 "param_name" => "iconcolor",
			 "value" => "#787878",
			 "description" => __("Please Choose Icon color for your Animated Number" , "insperia")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers Title" , "insperia"),
			 "param_name" => "title",
			 "value" => "",
			 "description" => __("Enter Title" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title color" , "insperia"),
			 "param_name" => "titlecolor",
			 "value" => "#787878",
			 "description" => __("Please Choose Title color for your Animated Number" , "insperia")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers Value" , "insperia"),
			 "param_name" => "number",
			 "value" => "",
			 "description" => __("Enter Number Value" , "insperia")
		  ),	
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Number color" , "insperia"),
			 "param_name" => "numbercolor",
			 "value" => "#242526",
			 "description" => __("Please Choose Number color for your Animated Number" , "insperia")
		  ),			  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Heading Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose heading Animation effect" , "insperia")
		  )
	   )
	) );	
	
	
	/*------------------------------------------------------
	Insperia Testimonial - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Testimonial" , "insperia"),
	   "base" => "insperia_testimonial",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Testimonials" , "insperia"),
			 "param_name" => "number",
			 "value" => "",
			 "description" => __("Enter Number of Testimonials to display" , "insperia")
		  ),			  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Choose Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Choose animation effect for your Testimonials" , "insperia")
		  )
	   )
	) );	
	
	
	/*------------------------------------------------------
	Insperia Portfolio - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Portfolio" , "insperia"),
	   "base" => "insperia_portfolio",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Portfolio Items" , "insperia"),
			 "param_name" => "number",
			 "value" => "9",
			 "description" => __("Enter Number of Portfolio to display" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Portfolio Page URL" , "insperia"),
			 "param_name" => "link",
			 "value" => "http://www.example.com",
			 "description" => __("Enter your Portfolio Page URL in order to insert a 'View Full Portfolio' button under your items, or keep it empty to hide" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Label" , "insperia"),
			 "param_name" => "portbutton",
			 "value" => "View Full Portfolio",
			 "description" => __("If you want to show a button for Full Portfolio then enter Button Label" , "insperia")
		  ),  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Button Animation effect" , "insperia")
		  )		  
	   )
	) );		
	
			
	/*------------------------------------------------------
	Insperia Portfolio Style 2 - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Portfolio Style 2" , "insperia"),
	   "base" => "insperia_portfolio_styletwo",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Portfolio Items" , "insperia"),
			 "param_name" => "number",
			 "value" => "9",
			 "description" => __("Enter Number of Portfolio to display" , "insperia")
		  )  
	   )
	) );		
	
	
	
	/*------------------------------------------------------
	Insperia Portfolio - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Portfolio Carousel Slider" , "insperia"),
	   "base" => "insperia_portfolio_slider",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Portfolio Items" , "insperia"),
			 "param_name" => "number",
			 "value" => "9",
			 "description" => __("Enter Number of Portfolio to display" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Section Title" , "insperia"),
			 "param_name" => "title",
			 "value" => "Some of our featured work",
			 "description" => __("Enter Portfolio section Title here" , "insperia")
		  ),		  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Portfolio Page URL" , "insperia"),
			 "param_name" => "link",
			 "value" => "http://www.example.com",
			 "description" => __("Enter your Portfolio Page URL in order to insert a 'View Full Portfolio' button under your items, or keep it empty to hide" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Label" , "insperia"),
			 "param_name" => "portbutton",
			 "value" => "View Full Portfolio",
			 "description" => __("If you want to show a button for Full Portfolio then enter Button Label" , "insperia")
		  ),  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Button Animation effect" , "insperia")
		  )		  
	   )
	) );			
	
	
	
	/*------------------------------------------------------
	Insperia Portfolio Full Slider - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Portfolio Full Slider" , "insperia"),
	   "base" => "insperia_portfolio_full_slider",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Portfolio Items" , "insperia"),
			 "param_name" => "number",
			 "value" => "9",
			 "description" => __("Enter Number of Portfolio to display" , "insperia")
		  )  
	   )
	) );		
		
	
	/*------------------------------------------------------
	Insperia Products Four per row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Products Four Columns" , "insperia"),
	   "base" => "insperia_products_four_col",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of products" , "insperia"),
			 "param_name" => "noofposts",
			 "value" => "8",
			 "description" => __("Number of products to display" , "insperia")
		  )
	   )
	) );	
	
	
	/*------------------------------------------------------
	Insperia Portfolio - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Button" , "insperia"),
	   "base" => "insperia_button",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Background color" , "insperia"),
			 "param_name" => "background",
			 "value" => "#f64747",
			 "description" => __("Please Choose a Background color for your Button" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Font color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#fffff",
			 "description" => __("Please Choose a Font color for your Button" , "insperia")
		  ),	
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Border color" , "insperia"),
			 "param_name" => "border",
			 "value" => "#f64747",
			 "description" => __("Please Choose a Border color for your Button" , "insperia")
		  ),			  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Text / Label" , "insperia"),
			 "param_name" => "title",
			 "value" => "Button Title",
			 "description" => __("Enter Button Text / Label" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button URL" , "insperia"),
			 "param_name" => "link",
			 "value" => "http://www.example.com",
			 "description" => __("Enter Button URL" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Size" , "insperia"),
			 "param_name" => "size",
			 "value" => $insperia_button_arr,
			 "description" => __("Choose Button Size" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Do you want to display icon inside your button?" , "insperia"),
			 "param_name" => "iconoption",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Enable/Disable button icon" , "insperia")
		  ),  		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Icon" , "insperia"),
			 "param_name" => "icon",
			 "value" => $insperia_icon_arr,
			 "description" => __("Here you will choose Button Icon" , "insperia")
		  )		  
	   )
	) );		
	
	
	
	/*------------------------------------------------------
	Insperia Services With Image - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Services with Images" , "insperia"),
	   "base" => "insperia_services_with_image",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Service Image" , "insperia"),
			 "param_name" => "image",
			 "description" => __("Upload your image here" , "insperia")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Service Title here" , "insperia"),
			 "param_name" => "title",
			 "value" => "Title Goes Here",
			 "description" => __("Services Title here" , "insperia")
		  ),
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter Service Description here" , "insperia"),
			 "param_name" => "description",
			 "value" => "Description Goes Here",
			 "description" => __("Services Description here" , "insperia")
		  )  
	   )
	) );		
	
		
	
	/*------------------------------------------------------
	insperia_blog Blog - Four per Row - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Blog" , "insperia"),
	   "base" => "insperia_blog",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Blog items you want to display" , "insperia"),
			 "param_name" => "noofposts",
			 "value" => "4",
			 "description" => __("Number of Blog Items to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Blog Animation effect" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Blog Page URL" , "insperia"),
			 "param_name" => "link",
			 "value" => "http://www.example.com",
			 "description" => __("Enter your Blog Page URL in order to insert a 'View Full Blog' button under your items, or keep it empty to hide" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Button Label" , "insperia"),
			 "param_name" => "blogbutton",
			 "value" => "View Full Posts",
			 "description" => __("If you want to show a button for Full Blog then enter Button Label" , "insperia")
		  )		  
	   )
	) );	
	
	
	/*------------------------------------------------------
	Insperia Blog Timeline - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Blog Timeline" , "insperia"),
	   "base" => "insperia_blog_timeline",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please enter No.# of Blog items you want to display" , "insperia"),
			 "param_name" => "noofposts",
			 "value" => "4",
			 "description" => __("Number of Blog Items to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Animation effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Blog Animation effect" , "insperia")
		  )  
	   )
	) );	
	
	
	/*------------------------------------------------------
	Insperia Services - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Services" , "insperia"),
	   "base" => "insperia_services",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Services Items" , "insperia"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Services Items to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Services Tab effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Service Tab Animation effect" , "insperia")
		  )		  
	   )
	) );		
	
		
	/*------------------------------------------------------
	Insperia Duties - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Duties" , "insperia"),
	   "base" => "insperia_duties",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Duties Items" , "insperia"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Duty Items to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Duties Section effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Duties Section Animation effect" , "insperia")
		  )		
	   )
	) );			
		
	
	/*------------------------------------------------------
	Insperia Popover - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Popover" , "insperia"),
	   "base" => "insperia_popover",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Popover Title" , "insperia"),
			 "param_name" => "title",
			 "value" => "Title",
			 "description" => __("Enter Popover Title" , "insperia")
		  ),	   
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Popover Content" , "insperia"),
			 "param_name" => "text",
			 "value" => "Content",
			 "description" => __("Enter Popover Content" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Tooltip link" , "insperia"),
			 "param_name" => "link",
			 "value" => "http://www.example.com",
			 "description" => __("Enter link URL" , "insperia")
		  ),		  		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Tooltip hover Position" , "insperia"),
			 "param_name" => "position",
			 "value" => $insperia_animation_arr,
			 "description" => __("Here you will choose Tooltip hover Position" , "insperia")
		  )		
	   )
	) );						

		
	/*------------------------------------------------------
	Insperia Tooltip - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Tooltip" , "insperia"),
	   "base" => "insperia_tooltip",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Tooltip text" , "insperia"),
			 "param_name" => "text",
			 "value" => "Text",
			 "description" => __("Enter Tooltip Text" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Tooltip link" , "insperia"),
			 "param_name" => "link",
			 "value" => "http://www.example.com",
			 "description" => __("Enter link URL" , "insperia")
		  ),		  		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Tooltip hover Position" , "insperia"),
			 "param_name" => "position",
			 "value" => $insperia_animation_arr,
			 "description" => __("Here you will choose Tooltip hover Position" , "insperia")
		  )		
	   )
	) );			
	
	
	/*------------------------------------------------------
	Insperia Skills - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Skills" , "insperia"),
	   "base" => "insperia_skills",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Skills Items" , "insperia"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Skill Items to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Skills Section effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Skills Section Animation effect" , "insperia")
		  )		
	   )
	) );			
	
	
	
	/*------------------------------------------------------
	Insperia Team Members - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Team Members" , "insperia"),
	   "base" => "insperia_team_members",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Team Members" , "insperia"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Team Members to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Team Members Section effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Team Members Section Animation effect" , "insperia")
		  )		
	   )
	) );			
	
	
	/*------------------------------------------------------
	Insperia Team Members - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Team Members With Details" , "insperia"),
	   "base" => "insperia_team_members_details",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Team Members" , "insperia"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Team Members to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Team Members Section effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Team Members Section Animation effect" , "insperia")
		  )		
	   )
	) );	
	
	
	/*------------------------------------------------------
	Insperia Team Members Style Two - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Team Members Style 2" , "insperia"),
	   "base" => "insperia_team_members_style_two",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Numbers of Team Members" , "insperia"),
			 "param_name" => "number",
			 "value" => "6",
			 "description" => __("Enter Number of Team Members to display" , "insperia")
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Team Members Section effect" , "insperia"),
			 "param_name" => "animation",
			 "value" => $insperia_animation,
			 "description" => __("Here you will choose Team Members Section Animation effect" , "insperia")
		  )		
	   )
	) );			

	
	/*------------------------------------------------------
	Insperia Alert Box - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Alert Box" , "insperia"),
	   "base" => "insperia_alert_box",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Please a Type" , "insperia"),
			 "param_name" => "type",
			 "value" => $insperia_alert_arr,
			 "description" => __("The Type of the Alert Box" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Alert Text" , "insperia"),
			 "param_name" => "text",
			 "value" => "Normal Message! Your Message Here",
			 "description" => __("Enter Alert Text" , "insperia")
		  )
	   )
	) );	
	
		
	/*------------------------------------------------------
	Insperia Skill Bar - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Skill Bar" , "insperia"),
	   "base" => "insperia_skill_bar",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar Text" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Bar Text or keep it empty to hide text" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar Percentage" , "insperia"),
			 "param_name" => "percentage",
			 "value" => "20%",
			 "description" => __("Enter Bar Percentage and put % at the end of the number" , "insperia")
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Bar color" , "insperia"),
			 "param_name" => "color",
			 "value" => "#000",
			 "description" => __("Please Choose a color for your Skill Bar" , "insperia")
		  ),		  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Do you want to add striped lines?" , "insperia"),
			 "param_name" => "iconoption",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Enable/Disable striped lines" , "insperia")
		  )	  
	   )
	) );		
	
	
	/*------------------------------------------------------
	Insperia Wells - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Wells" , "insperia"),
	   "base" => "insperia_wells",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Well Text" , "insperia"),
			 "param_name" => "text",
			 "value" => "",
			 "description" => __("Enter Well Text" , "insperia")
		  )  
	   )
	) );			
		

	/*------------------------------------------------------
	Insperia Laptop Slider Images - VC
	-------------------------------------------------------*/	
	vc_map( array(
	   "name" => __("Insperia Laptop Slider" , "insperia"),
	   "base" => "insperia_laptop_slider",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Slide Images" , "insperia"),
			 "param_name" => "images",
			 "value" => $insperia_yes_no_arr,
			 "description" => __("Upload your images here" , "insperia")
		  )		  
	   )
	) );		
	

	/*------------------------------------------------------
	Insperia Map - VC
	-------------------------------------------------------*/
	vc_map( array(
	   "name" => __("Insperia Map" , "insperia"),
	   "base" => "insperia_map",
	   "class" => "",
	   "category" => __('Content' , "insperia"),
	   "params" => array(	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map Height" , "insperia"),
			 "param_name" => "mapheight",
			 "value" => "470px",
			 "description" => __("Please Enter Map Height in Pixels" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map Latitude" , "insperia"),
			 "param_name" => "latitude",
			 "value" => "-37.809674",
			 "description" => __("Please Enter Map Latitude Value" , "insperia")
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Map embed Longitude" , "insperia"),
			 "param_name" => "longitude",
			 "value" => "144.954718",
			 "description" => __("Please Enter Map Longitude Value" , "insperia")
		  )	  
	   )
	) );		
}

/*------------------------------------------------------
Insperia Sidebar Functions - Started
-------------------------------------------------------*/

if ( function_exists('register_sidebar') ){
register_sidebar(array(
	'name' => 'default',
	'id' => 'default',
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',
));
/************************/
register_sidebar(array(
	'name' => 'Extra-Sidebar-I',
	'id' => 'Extra-Sidebar-I',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',
));
/************************/
register_sidebar(array('name'=>'Extra-Sidebar-II',
	'id' => 'Extra-Sidebar-II',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',
));
/************************/
register_sidebar(array('name'=>'Extra-Sidebar-III',
	'id' => 'Extra-Sidebar-III',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',

));
/************************/
register_sidebar(array('name'=>'Extra-Sidebar-IV',
	'id' => 'Extra-Sidebar-IV',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',

));
/************************/
register_sidebar(array('name'=>'Extra-Sidebar-V',
	'id' => 'Extra-Sidebar-V',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',

));
/************************/
register_sidebar(array('name'=>'Extra-Sidebar-VI',
	'id' => 'Extra-Sidebar-VI',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',
));
/************************/
register_sidebar(array('name'=>'Extra-Sidebar-VII',
	'id' => 'Extra-Sidebar-VII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',
));
/************************/
register_sidebar(array('name'=>'Extra-Sidebar-VIII',
	'id' => 'Extra-Sidebar-VIII',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h6 class="stronger widget-title">',
	'after_title' => '</h6>',
));
/************************/
register_sidebar(array('name'=>'Footer-Col-I',
	'id' => 'Footer-Col-I',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Footer-Col-II',
	'id' => 'Footer-Col-II',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Footer-Col-III',
	'id' => 'Footer-Col-III',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Footer-Col-IV',
	'id' => 'Footer-Col-IV',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Search-Page-Sidebar',
	'id' => 'Search-Page-Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Archive-Page-Sidebar',
	'id' => 'Archive-Page-Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Blog-Right-Sidebar',
	'id' => 'Blog-Right-Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Blog-Left-Sidebar',
	'id' => 'Blog-Left-Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Blog-Single-Sidebar',
	'id' => 'Blog-Single-Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Page-Left-Sidebar',
	'id' => 'Page-Left-Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
/************************/
register_sidebar(array('name'=>'Page-Right-Sidebar',
	'id' => 'Page-Right-Sidebar',	
	'before_widget' => '<div id="%1$s" class="widget %2$s">' ,
	'after_widget' =>  '</div>',
	'before_title' => '<h4 class="ft-heading">',
	'after_title' => '</h4>',
));
}

/*------------------------------------------------------
Insperia Sidebar Functions - End
-------------------------------------------------------*/





/*------------------------------------------------------
Insperia, Add Portfolio Thumbnail URL option - Started
-------------------------------------------------------*/
function insperia_get_portfolio_thumbnail_url($pid){  
    $image_id = get_post_thumbnail_id($pid);  
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot');  
    return  $image_url[0];  
}
/*------------------------------------------------------
Insperia, Add Portfolio Thumbnail URL option - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia, Adds a box to the side column on the Post and Page edit screens - Started
-------------------------------------------------------*/
function insperia_add_sidebar_metabox()
{  
    add_meta_box(  
        'custom_sidebar',  
        __( 'Custom Sidebar', 'insperia' ),  
        'insperia_custom_sidebar_callback',  
        'post',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        __( 'Custom Sidebar', 'insperia' ),  
        'insperia_custom_sidebar_callback',  
        'page',  
        'side'  
    );  
    add_meta_box(
        'custom_sidebar',  
        __( 'Custom Sidebar', 'insperia' ),  
        'insperia_custom_sidebar_callback',  
        'project',  
        'side'  
    );

} 


function insperia_custom_sidebar_callback( $post )  
{  
    global $wp_registered_sidebars;  
      
    $custom = get_post_custom($post->ID);  
      
    if(isset($custom['custom_sidebar']))  
        $val = $custom['custom_sidebar'][0];  
    else  
        $val = "default";  
  
    /* Use nonce for verification  */
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );  
  
    /* The actual fields for data entry  */
    $output = '<p><label for="myplugin_new_field">'.__("Choose a sidebar to display", 'insperia' ).'</label></p>';  
    $output .= "<select name='custom_sidebar'>";  
	
	/* Add a default option  */
    $output .= "<option";  
    if($val == "default")  
        $output .= " selected='selected'";  
    $output .= " value='default'>".__('default', 'insperia' )."</option>";  
      
    /* Fill the select element with all registered sidebars */  
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)  
    {  
        $output .= "<option";  
        if($sidebar_id == $val)  
            $output .= " selected='selected'";  
        $output .= " value='".$sidebar_id."'>".$sidebar['name']."</option>";  
    }  
    
    $output .= "</select>";  
      
    echo $output;  
}

function insperia_save_sidebar_postdata( $post_id )  
{  
    /* verify if this is an auto save routine.   */
    /* If it is our form has not been submitted, so we dont want to do anything  */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )   
      return;  
  
    /* verify this came from our screen and with proper authorization, */ 
    /* because save_post can be triggered at other times */ 
  
	if(isset ($_POST['custom_sidebar_nonce'])){
		if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )  
		  return; 
	}   
  
    if ( !current_user_can( 'edit_page', $post_id ) )  
        return;  
  
	if(isset ($_POST['custom_sidebar'])){
		$data = $_POST['custom_sidebar'];  
		update_post_meta($post_id, "custom_sidebar", $data);
	}     
}  
/*------------------------------------------------------
Insperia, Adds a box to the side column on the Post and Page edit screens - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia, breadcrumb functions - Started
-------------------------------------------------------*/

function insperia_bread_crumbs() {
	 global $post;
	 global $prof_default;
	 
	 $crumbs = '<a href="'. esc_url(home_url()) .'">Home</a>';

	 
	 /*if the page is 404 */
	 if(is_404()) {
		$crumbs .= ' - ' . of_get_option('blank_page_title',$prof_default);
	 }
	
	
	 /* if the page is search */
	 if(is_search()) {
		$crumbs =  __("Search for : ' " , "insperia") . get_search_query() . " '";
	 }
	 
	 /* if the page has a parent add title and link of parent */
	 if(isset ($post->post_parent)) {

	 }

	 /* if it's not the front page of the site, but isn't the blog either */
	 if((!is_front_page()) && (is_page())) {
		$crumbs .=    ' / ' . get_the_title($post->ID);
	 }

	 /* if it's the news/blog home page or any type of archive */
	 if((is_home() ||(is_archive()))) {
		$crumbs .=     ' / ' . get_the_title($post->ID);		
	 }

	 /* if it's a single news/blog post */
	 if(is_single()) {
		$crumbs .=     ' / ' . get_the_title($post->ID);
	 }
	 
	 /*if it's is_archive()*/
	 if(is_archive()) {
		$crumbs = '<a href="'. esc_url(home_url()) .'">Home</a> / ' . __("Archive" , "insperia");
	 }
	 
	 $crumbs .=    '';
	 echo $crumbs;
}
/*------------------------------------------------------
Insperia, breadcrumb functions - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia Walker_Nav_Menu - Started
-------------------------------------------------------*/
class Insperia_description_walker extends Walker_Nav_Menu
{

	  function start_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	  }
	  function end_lvl(&$output, $depth= 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	  }
  
	  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

			/* Has children */
			$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
			if (empty($children)) {
				$sentientdiv = '';
				$sentientchild = '';
				$toggleClass = '';
			} else {
				$sentientdiv = '<span class="fa fa-angle-down"></span>';
				$sentientchild = 'dropdown';
				$toggleClass = 'class="dropdown-toggle" data-toggle="dropdown"';
			}		   
		   
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names . ' ' . $sentientchild ) .'"';		   
		   
           $output .= $indent . '<li ' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		   
           $prepend = '';
           $append = '';
		   
           $description  = ! empty( $item->description ) ? '<span class="menu-item-description">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }
			
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .' ' . $toggleClass . '>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= $sentientdiv . '</a>';
			$item_output .= $args->after;
			
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }

}
/*------------------------------------------------------
Insperia Walker_Nav_Menu - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia, Add Custom Fields to the Post Formats (add_action) - Started
-------------------------------------------------------*/
add_action( 'admin_menu', 'insperia_team_post_format_member_position' );
add_action( 'save_post', 'insperia_save_team_post_format_member_position', 10, 2 );

add_action( 'admin_menu', 'insperia_quote_post_format_person_field' );
add_action( 'save_post', 'insperia_save_quote_post_format_person_field', 10, 2 );

add_action( 'admin_menu', 'insperia_quotecompany_post_format_person_field' );
add_action( 'save_post', 'insperia_save_quotecompany_post_format_person_field', 10, 2 );

add_action( 'admin_menu', 'insperia_portfolio_post_format_client_link' );
add_action( 'save_post', 'insperia_save_portfolio_post_format_client_link', 10, 2 );

add_action( 'admin_menu', 'insperia_testimonial_post_format_person_position' );
add_action( 'save_post', 'insperia_save_testimonial_post_format_person_position', 10, 2 );

add_action( 'admin_menu', 'insperia_testimonial_post_format_person_company' );
add_action( 'save_post', 'insperia_save_testimonial_post_format_person_company', 10, 2 );

add_action( 'admin_menu', 'insperia_portfolio_post_format_client_name' );
add_action( 'save_post', 'insperia_save_portfolio_post_format_client_name', 10, 2 );

add_action( 'admin_menu', 'insperia_post_format_facebook_field' );
add_action( 'save_post', 'insperia_save_post_format_facebook_field', 10, 2 );

add_action( 'admin_menu', 'insperia_post_format_skype_field' );
add_action( 'save_post', 'insperia_save_post_format_skype_field', 10, 2 );

add_action( 'admin_menu', 'insperia_post_format_twitter_field' );
add_action( 'save_post', 'insperia_save_post_format_twitter_field', 10, 2 );

add_action( 'admin_menu', 'insperia_post_format_dribbble_field' );
add_action( 'save_post', 'insperia_save_post_format_dribbble_field', 10, 2 );

add_action( 'admin_menu', 'insperia_post_format_linkedin_field' );
add_action( 'save_post', 'insperia_save_post_format_linkedin_field', 10, 2 );

add_action( 'admin_menu', 'insperia_post_format_google_field' );
add_action( 'save_post', 'insperia_save_post_format_google_field', 10, 2 );

add_action( 'admin_menu', 'insperia_video_post_format_URL_field' );
add_action( 'save_post', 'insperia_save_video_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'insperia_audio_post_format_URL_field' );
add_action( 'save_post', 'insperia_save_audio_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'insperia_link_post_format_URL_field' );
add_action( 'save_post', 'insperia_save_link_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'insperia_gallery_post_format_URL_field' );
add_action( 'save_post', 'insperia_save_gallery_post_format_URL_field', 10, 2 );

add_action( 'admin_menu', 'post_icons_list' );
add_action( 'save_post', 'post_save_icons_list', 10, 2 );

add_action( 'admin_menu', 'insperia_title_desc_field' );
add_action( 'save_post', 'insperia_save_title_desc_field', 10, 2 );

add_action( 'admin_menu', 'insperia_skill_value_field' );
add_action( 'save_post', 'insperia_save_skill_value_field', 10, 2 );

add_action( 'admin_menu', 'insperia_portfolio_extra_title_field' );
add_action( 'save_post', 'insperia_save_portfolio_extra_title_field', 10, 2 );

add_action( 'admin_menu', 'insperia_portfolio_extra_paragraph_field' );
add_action( 'save_post', 'insperia_save_portfolio_extra_paragraph_field', 10, 2 );
/*------------------------------------------------------
Insperia , Add Custom Fields to the Post Formats (add_action) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia , Add Custom Fields to the Post Formats (Create Fields) - Started
-------------------------------------------------------*/
function insperia_quote_post_format_person_field() {
	add_meta_box( 'insperia-chat_person-box', 'Quote Person Name for post Quote format (only)', 'insperia_create_quote_post_format_person_field', 'post', 'normal', 'high' );
}
function insperia_quotecompany_post_format_person_field() {
	add_meta_box( 'insperia-qoutecompany_person-box', 'Quote Person Company for post Quote format (only)', 'insperia_create_quotecompany_post_format_person_field', 'post', 'normal', 'high' );
}
function insperia_team_post_format_member_position() {
	add_meta_box( 'insperia-team-position-box', 'Team Member Position', 'insperia_create_team_post_format_member_position', 'team', 'normal', 'high' );
}
function insperia_portfolio_post_format_client_link() {
	add_meta_box( 'insperia-projectlink-box', 'Project Client URL', 'insperia_create_portfolio_post_format_client_link', 'portfolio', 'normal', 'high' );
}
function insperia_testimonial_post_format_person_position() {
	add_meta_box( 'insperia-test-position-box', 'Person Position', 'insperia_create_testimonial_post_format_person_position', 'testimonial', 'normal', 'high' );
}
function insperia_testimonial_post_format_person_company() {
	add_meta_box( 'insperia-test-company-box', 'Person Company', 'insperia_create_testimonial_post_format_person_company', 'testimonial', 'normal', 'high' );
}
function insperia_portfolio_post_format_client_name() {
	add_meta_box( 'insperia-projectdescription-box', 'Project Client', 'insperia_create_portfolio_post_format_client_name', 'portfolio', 'normal', 'high' );
}
function insperia_post_format_facebook_field() {
	add_meta_box( 'insperia-facebook-box', 'Facebook URL', 'insperia_create_post_format_facebook_field', 'team', 'normal', 'high' );	
}
function insperia_post_format_skype_field() {
	add_meta_box( 'insperia-skype-box', 'Skype URL', 'insperia_create_post_format_skype_field', 'team', 'normal', 'high' );	
}
function insperia_post_format_twitter_field() {
	add_meta_box( 'insperia-twitter-box', 'Twitter URL', 'insperia_create_post_format_twitter_field', 'team', 'normal', 'high' );	
}
function insperia_post_format_dribbble_field() {
	add_meta_box( 'insperia-dribbble-box', 'Dribbble URL', 'insperia_create_post_format_dribbble_field', 'team', 'normal', 'high' );	
}
function insperia_post_format_linkedin_field() {
	add_meta_box( 'insperia-linkedin-box', 'LinkedIn URL', 'insperia_create_post_format_linkedin_field', 'team', 'normal', 'high' );		
}
function insperia_post_format_google_field() {
	add_meta_box( 'insperia-google-box', 'Google URL', 'insperia_create_post_format_google_field', 'team', 'normal', 'high' );		
}
function insperia_video_post_format_URL_field() {
	add_meta_box( 'insperia-video-box', 'Video URL for post video format (only)', 'insperia_create_video_post_format_URL_field', 'post', 'normal', 'high' );
}
function insperia_audio_post_format_URL_field() {
	add_meta_box( 'insperia-audio-box', 'Audio Shortcode for post Audio format (only)', 'insperia_create_audio_post_format_URL_field', 'post', 'normal', 'high' );
}
function post_icons_list() {
	add_meta_box( 'insperia-icon-box', 'Select Icon', 'create_post_icon_list', 'services', 'normal', 'high' );
	add_meta_box( 'insperia-icon-box', 'Select Icon', 'create_post_icon_list', 'duties', 'normal', 'high' );
}
function insperia_link_post_format_URL_field() {
	add_meta_box( 'insperia-link-box', 'Link URL for post link format (only)', 'insperia_create_link_post_format_URL_field', 'post', 'normal', 'high' );
}
function insperia_gallery_post_format_URL_field() {
	add_meta_box( 'insperia-gallery-box', 'Gallery images ID for post gallery format (only)', 'insperia_create_gallery_post_format_URL_field', 'post', 'normal', 'high' );
}
function insperia_title_desc_field() {
	add_meta_box( 'insperia-title-desc-box', 'Page Title Description', 'insperia_create_title_desc_field', 'page', 'normal', 'high' );
}
function insperia_skill_value_field() {
	add_meta_box( 'insperia-skill-value-box', 'Skill Value', 'insperia_create_skill_value_field', 'skills', 'normal', 'high' );
}
function insperia_portfolio_extra_title_field() {
	add_meta_box( 'insperia-portfolio-extra-value-box', 'Portfolio Extra Title', 'insperia_create_portfolio_extra_title_field', 'portfolio', 'normal', 'high' );
}
function insperia_portfolio_extra_paragraph_field() {
	add_meta_box( 'insperia-portfolio-extra-paragraph-value-box', 'Portfolio Extra Paragraph', 'insperia_create_portfolio_extra_paragraph_field', 'portfolio', 'normal', 'high' );
}

/*------------------------------------------------------
Insperia , Add Custom Fields to the Post Formats (Create Fields) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia , Add Custom Fields to the Post Formats (Create Fields Layout) - Started
-------------------------------------------------------*/
function insperia_create_quote_post_format_person_field( $object, $box ) { ?>
	<p>
		<label for="quoteperson-shortcode">Quote Person Name</label>
		<br />
		<input name="quoteperson-shortcode" id="quoteperson-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Quote Person Name', true )); ?>" />
		<input type="hidden" name="insperia_meta_box_quoteperson" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function insperia_create_quotecompany_post_format_person_field( $object, $box ) { ?>
	<p>
		<label for="quotecompany-shortcode">Quote Person Company</label>
		<br />
		<input name="quotecompany-shortcode" id="quotecompany-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Quote Person Company', true )); ?>" />
		<input type="hidden" name="insperia_meta_box_quotecompany" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_team_post_format_member_position( $object, $box ) { ?>
	<p>
		<label for="teampositionlink-shortcode">Person Position</label>
		<br />
		<input name="teampositionlink-shortcode" id="teampositionlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Team Member Position', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_teamposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_testimonial_post_format_person_position( $object, $box ) { ?>
	<p>
		<label for="testpositionlink-shortcode">Person Position</label>
		<br />
		<input name="testpositionlink-shortcode" id="testpositionlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Person Position', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_testposition" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_testimonial_post_format_person_company( $object, $box ) { ?>
	<p>
		<label for="testcompanylink-shortcode">Person Company</label>
		<br />
		<input name="testcompanylink-shortcode" id="testcompanylink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Person Company', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_testcompany" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_portfolio_post_format_client_link( $object, $box ) { ?>
	<p>
		<label for="projectlink-shortcode">Project Client URL</label>
		<br />
		<input name="projectlink-shortcode" id="projectlink-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Project Client URL', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_projectlink" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_portfolio_post_format_client_name( $object, $box ) { ?>
	<p>
		<label for="projectdescription-shortcode">Project Client</label>
		<br />
		<input name="projectdescription-shortcode" id="projectdescription-shortcode" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Project Client', true )); ?>" />
		<input type="hidden" name="sentient_meta_box_projectdesc" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_post_format_skype_field( $object, $box ) { ?>
	<p>
		<label for="post-skype">Skype URL</label>
		<br />
		<input name="post-skype" id="post-skype" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Skype URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_skype" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

function insperia_create_post_format_facebook_field( $object, $box ) { ?>
	<p>
		<label for="post-facebook">Facebook URL</label>
		<br />
		<input name="post-facebook" id="post-facebook" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Facebook URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_facebook" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_post_format_twitter_field( $object, $box ) { ?>
	<p>
		<label for="post-twitter">Twitter URL</label>
		<br />
		<input name="post-twitter" id="post-twitter" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Twitter URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_twitter" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_post_format_linkedin_field( $object, $box ) { ?>
	<p>
		<label for="post-linkedin">LinkedIn URL</label>
		<br />
		<input name="post-linkedin" id="post-linkedin" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'LinkedIn URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_linkedin" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_post_format_google_field( $object, $box ) { ?>
	<p>
		<label for="post-google">Google URL</label>
		<br />
		<input name="post-google" id="post-google" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Google URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_google" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_post_format_dribbble_field( $object, $box ) { ?>
	<p>
		<label for="post-dribbble">Dribbble URL</label>
		<br />
		<input name="post-dribbble" id="post-dribbble" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Dribbble URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_dribbble" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_video_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-video">Post Video URL</label>
		<br />
		<input name="post-video" id="post-video" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Video URL', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_video" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_audio_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-audio">Post Audio Shortcode</label>
		<br />
		<input name="post-audio" id="post-audio" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Post Audio Shortcode', true ) ); ?>" />
		<input type="hidden" name="sentient_meta_box_audio" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_link_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-link">Link Post URL</label>
		<br />
		<input name="post-link" id="post-link" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Link Post URL', true ) ); ?>" />
		<input type="hidden" name="insperia_meta_box_link" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_gallery_post_format_URL_field( $object, $box ) { ?>
	<p>
		<label for="post-gallery">Gallery images ID</label>
		<br />
		<input name="post-gallery" id="post-gallery" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Gallery images ID', true ) ); ?>" />
		<input type="hidden" name="insperia_meta_box_gallery" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_title_desc_field( $object, $box ) { ?>
	<p>
		<label for="title-desc">Title Description</label>
		<br />
		<input name="title-desc" id="title-desc" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Title Description', true ) ); ?>" />
		<input type="hidden" name="insperia_meta_box_title_desc" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_skill_value_field( $object, $box ) { ?>
	<p>
		<label for="skill-value">Skill Value (Number Only)</label>
		<br />
		<input name="skill-value" id="skill-value" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Skill Value (Number Only)', true ) ); ?>" />
		<input type="hidden" name="insperia_meta_box_skill_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_portfolio_extra_title_field( $object, $box ) { ?>
	<p>
		<label for="port-extra-value">Portfolio Extra Paragraph Title</label>
		<br />
		<input name="port-extra-value" id="port-extra-value" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Portfolio Extra Paragraph Title', true ) ); ?>" />
		<input type="hidden" name="insperia_meta_box_extra_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }


function insperia_create_portfolio_extra_paragraph_field( $object, $box ) { ?>
	<p>
		<label for="port-extra-paragraph-value">Portfolio Extra Paragraph Text</label>
		<br />
		<input name="port-extra-paragraph-value" id="port-extra-paragraph-value" cols="60" rows="4" tabindex="30" style="width: 97%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'Portfolio Extra Paragraph Text', true ) ); ?>" />
		<input type="hidden" name="insperia_meta_box_extra_paragraph_value" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }

/*------------------------------------------------------
Insperia , Add Custom Fields to the Post Formats (Create Fields Layout) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia , Add Custom Fields to the Post Formats (Save Values) - Started
-------------------------------------------------------*/
function insperia_save_quote_post_format_person_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_quoteperson'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_quoteperson'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Quote Person Name', true );
	
	if(isset ($_POST['quoteperson-shortcode'])){
		$new_meta_value = stripslashes( $_POST['quoteperson-shortcode'] );
	} else {
		$new_meta_value = '';
	}		
	
	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Quote Person Name', $new_meta_value );

}


function insperia_save_quotecompany_post_format_person_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_quotecompany'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_quotecompany'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Quote Person Company', true );
	
	if(isset ($_POST['quotecompany-shortcode'])){
		$new_meta_value = stripslashes( $_POST['quotecompany-shortcode'] );
	} else {
		$new_meta_value = '';
	}		

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Quote Person Company', $new_meta_value );

}

function insperia_save_team_post_format_member_position( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_teamposition'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_teamposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;	
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Team Member Position', true );
	
	if(isset ($_POST['teampositionlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['teampositionlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}			

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Team Member Position', $new_meta_value );
	
}

function insperia_save_testimonial_post_format_person_position( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_testposition'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_testposition'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Person Position', true );
	
	if(isset ($_POST['testpositionlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['testpositionlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Person Position', $new_meta_value );	
	
}

function insperia_save_testimonial_post_format_person_company( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_testcompany'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_testcompany'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Person Company', true );
	
	if(isset ($_POST['testcompanylink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['testcompanylink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Person Company', $new_meta_value );
	
}


function insperia_save_portfolio_post_format_client_link( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_projectlink'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_projectlink'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Project Client URL', true );
	
	if(isset ($_POST['projectlink-shortcode'])){
		$new_meta_value = stripslashes( $_POST['projectlink-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Project Client URL', $new_meta_value );	
	
}


function insperia_save_portfolio_post_format_client_name( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_projectdesc'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_projectdesc'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Project Client', true );
	
	if(isset ($_POST['projectdescription-shortcode'])){
		$new_meta_value = stripslashes( $_POST['projectdescription-shortcode'] );
	} else {
		$new_meta_value = '';
	}				

	$new_meta_value = sanitize_text_field($new_meta_value);		
	
	update_post_meta( $post_id, 'Project Client', $new_meta_value );	

}


function insperia_save_post_format_skype_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_skype'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_skype'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Skype URL', true );
	
	if(isset ($_POST['post-skype'])){
		$new_meta_value = stripslashes( $_POST['post-skype'] );
	} else {
		$new_meta_value = '';
	}					

	$new_meta_value = esc_url_raw($new_meta_value);		
	
	update_post_meta( $post_id, 'Skype URL', $new_meta_value );

}

function insperia_save_post_format_facebook_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_facebook'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_facebook'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Facebook URL', true );
	
	if(isset ($_POST['post-facebook'])){
		$new_meta_value = stripslashes( $_POST['post-facebook'] );
	} else {
		$new_meta_value = '';
	}					

	$new_meta_value = esc_url_raw($new_meta_value);		
	
	update_post_meta( $post_id, 'Facebook URL', $new_meta_value );

}

function insperia_save_post_format_twitter_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_twitter'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_twitter'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Twitter URL', true );
	
	if(isset ($_POST['post-twitter'])){
		$new_meta_value = stripslashes( $_POST['post-twitter'] );
	} else {
		$new_meta_value = '';
	}						

	$new_meta_value = esc_url_raw($new_meta_value);		
	
	update_post_meta( $post_id, 'Twitter URL', $new_meta_value );

}

function insperia_save_post_format_linkedin_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_linkedin'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_linkedin'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'LinkedIn URL', true );
	
	if(isset ($_POST['post-linkedin'])){
		$new_meta_value = stripslashes( $_POST['post-linkedin'] );
	} else {
		$new_meta_value = '';
	}							

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'LinkedIn URL', $new_meta_value );
	
}


function insperia_save_post_format_google_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_google'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_google'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Google URL', true );
	
	if(isset ($_POST['post-google'])){
		$new_meta_value = stripslashes( $_POST['post-google'] );
	} else {
		$new_meta_value = '';
	}								

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Google URL', $new_meta_value );
	
}

function insperia_save_post_format_dribbble_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_dribbble'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_dribbble'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Dribbble URL', true );
	
	if(isset ($_POST['post-dribbble'])){
		$new_meta_value = stripslashes( $_POST['post-dribbble'] );
	} else {
		$new_meta_value = '';
	}									

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Dribbble URL', $new_meta_value );
	
}


function insperia_save_video_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_video'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_video'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Video URL', true );
	
	if(isset ($_POST['post-video'])){
		$new_meta_value = stripslashes( $_POST['post-video'] );
	} else {
		$new_meta_value = '';
	}												

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Post Video URL', $new_meta_value );

}

function insperia_save_audio_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['sentient_meta_box_audio'])){
		if ( !wp_verify_nonce( $_POST['sentient_meta_box_audio'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Post Audio Shortcode', true );
	
	if(isset ($_POST['post-audio'])){
		$new_meta_value = stripslashes( $_POST['post-audio'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);		
	
	update_post_meta( $post_id, 'Post Audio Shortcode', $new_meta_value );
	
}


function insperia_save_link_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_link'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_link'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Link Post URL', true );
	
	if(isset ($_POST['post-link'])){
		$new_meta_value = stripslashes( $_POST['post-link'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = esc_url_raw($new_meta_value);	
	
	update_post_meta( $post_id, 'Link Post URL', $new_meta_value );
	
}


function insperia_save_gallery_post_format_URL_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_gallery'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_gallery'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Gallery images ID', true );
	
	if(isset ($_POST['post-gallery'])){
		$new_meta_value = stripslashes( $_POST['post-gallery'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Gallery images ID', $new_meta_value );
	
}

function post_save_icons_list( $post_id, $post ) {

	if(isset ($_POST['meta_box_icon'])){
		if ( !wp_verify_nonce( $_POST['meta_box_icon'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Icon', true );
	
	if(isset ($_POST['post-icon'])){
		$new_meta_value = stripslashes( $_POST['post-icon'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Icon', $new_meta_value );
	
}


function insperia_save_title_desc_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_title_desc'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_title_desc'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Title Description', true );
	
	if(isset ($_POST['title-desc'])){
		$new_meta_value = stripslashes( $_POST['title-desc'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);
	
	update_post_meta( $post_id, 'Title Description', $new_meta_value );
	
}


function insperia_save_skill_value_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_skill_value'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_skill_value'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Title Description', true );
	
	if(isset ($_POST['skill-value'])){
		$new_meta_value = stripslashes( $_POST['skill-value'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Skill Value (Number Only)', $new_meta_value );
	
}


function insperia_save_portfolio_extra_title_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_extra_value'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_extra_value'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Portfolio Extra Paragraph Title', true );
	
	if(isset ($_POST['port-extra-value'])){
		$new_meta_value = stripslashes( $_POST['port-extra-value'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Portfolio Extra Paragraph Title', $new_meta_value );
	
}


function insperia_save_portfolio_extra_paragraph_field( $post_id, $post ) {

	if(isset ($_POST['insperia_meta_box_extra_paragraph_value'])){
		if ( !wp_verify_nonce( $_POST['insperia_meta_box_extra_paragraph_value'], plugin_basename( __FILE__ ) ) )
			return $post_id;
	}	

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'Portfolio Extra Paragraph Text', true );
	
	if(isset ($_POST['port-extra-paragraph-value'])){
		$new_meta_value = stripslashes( $_POST['port-extra-paragraph-value'] );
	} else {
		$new_meta_value = '';
	}														

	$new_meta_value = sanitize_text_field($new_meta_value);	
	
	update_post_meta( $post_id, 'Portfolio Extra Paragraph Text', $new_meta_value );
	
}

/*------------------------------------------------------
Insperia , Add Custom Fields to the Post Formats (Save Values) - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Comments - Started
-------------------------------------------------------*/
function insperia_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
	<?php $tag = 'div'; ?>
	
	<<?php echo $tag ?> <?php comment_class('media' . empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<a href="#" class="pull-left">
			<?php echo get_avatar( $comment, 80 ); ?>
		</a>
		<div class="media-body">
			<?php printf(__('<h6 class="media-heading stronger">%s</h6>'), get_comment_author_link()); ?>
			<?php $at = __(" at " , "insperia")?>
			<?php $getDate = get_comment_date('M' , $comment->comment_ID ) . ' ' . get_comment_date('j' , $comment->comment_ID ) . ', ' . get_comment_date('Y' , $comment->comment_ID ) . $at . get_comment_time('H:i'); ?>
			<div class="comment-meta"><small><?php echo $getDate; ?></small> <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
			<?php comment_text() ?>
		</div>
	</div>	
	
	<?php
}
/*------------------------------------------------------
Insperia Comments - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Search - Started
-------------------------------------------------------*/
function insperia_search_form( $form ) {

    $form = '
	<form role="search" method="get" class="search-form-sidebar" action="' . home_url( '/' ) . '">
		<div class="input-group">
		  <input type="text" class="form-control" name="s" id="s" >
		  <span class="input-group-btn">
			<button name="submit" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
		  </span>
		</div>
	</form>';

    return $form;
}

/*------------------------------------------------------
Insperia Search - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia Category List - Started
-------------------------------------------------------*/
function categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
/*------------------------------------------------------
Insperia Category List - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Importer - Started
-------------------------------------------------------*/
require dirname( __FILE__ ) . '/importer/init.php';
/*------------------------------------------------------
Insperia Importer - Started
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Admin Panel - Started
-------------------------------------------------------*/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri().'/admin/');
	require_once dirname( __FILE__ ) . '/admin/options-framework.php';
}
/*------------------------------------------------------
Insperia Admin Panel - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Number of Views - Begin
-------------------------------------------------------*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count = $count + 1;
        update_post_meta($postID, $count_key, $count);
    }
}

/*------------------------------------------------------
Insperia Number of Views - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Theme Activation - Begin
-------------------------------------------------------*/
if(!function_exists('insperia_backend_theme_activation'))
{
	/**
	 *  This function gets executed if the theme just got activated. It resets the global frontpage setting
	 *  and then redirects the user to the framework main options page
	 */
	function insperia_backend_theme_activation()
	{
		global $pagenow;
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
		{

			/*provide hook so themes can execute theme specific functions on activation*/
			do_action('insperia_backend_theme_activation');

			/*redirect to options page*/
			header( 'Location: '.admin_url().'themes.php?page=options-framework' ) ;
		}
	}

	add_action('admin_init','insperia_backend_theme_activation');
}
/*------------------------------------------------------
Insperia Theme Activation - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Import CSS Styles - Begin
-------------------------------------------------------*/
function Insperia_Import_CSS(){

	$file = get_template_directory() . '/insperia-styles.css';
	
	/* Append a new person to the file */
	$current = Insperia_Generate_CSS();
	
	/* Write the contents back to the file */
	file_put_contents($file, $current);
}
/*------------------------------------------------------
Insperia Import CSS Styles - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia WooCommerce No.# of Related Items - Begin
-------------------------------------------------------*/
if ( class_exists( 'WooCommerce' ) ) {
	function woo_related_products_limit() {
		global $product;
		$args['posts_per_page'] = 6;
		return $args;
	}

	add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );

	function jk_related_products_args( $args ) {
		$args['posts_per_page'] = 4; /* 4 related products */
		$args['columns'] = 4; /* arranged in 2 columns */
		return $args;
	} 
} 
/*------------------------------------------------------
Insperia WooCommerce No.# of Related Items - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia Contact Info Function - Begin
-------------------------------------------------------*/
function insperia_contact_widget_value() {
	global $prof_default;

	if(of_get_option('widget_company',$prof_default) != ''){$company='<span><strong>' . esc_attr(of_get_option('widget_company',$prof_default)) . '</strong></span>';}else{$company='';}
	if(of_get_option('widget_address_one',$prof_default) != ''){$addressOne = '<span>' . esc_attr(of_get_option('widget_address_one',$prof_default)) . '</span>';}else{$addressOne = '';}
	if(of_get_option('widget_address_two',$prof_default) != ''){$addressTwo = '<span>' . esc_attr(of_get_option('widget_address_two',$prof_default)) . '</span>';}else{$addressTwo = '';}
	if(of_get_option('widget_phone',$prof_default) != ''){$phone = '<span><abbr title="Phone"><i class="fa fa-phone"></i>:</abbr> ' . esc_attr(of_get_option('widget_phone',$prof_default)) . '</span>';}else{$phone = '';}
	if(of_get_option('widget_mail',$prof_default) != ''){$mail = '<span><abbr title="Email"><i class="fa fa-envelope-o"></i>:</abbr> <a href="#">' . esc_attr(of_get_option('widget_mail',$prof_default)) . '</a></span>';}else{$mail = '';}
	if(of_get_option('widget_url',$prof_default) != ''){$url = '<span><abbr title="Website"><i class="fa fa-globe"></i>:</abbr> <a href="' . esc_url(of_get_option('widget_url',$prof_default)) . '">' . esc_url(of_get_option('widget_url',$prof_default)) . '</a></span>';}else{$url = '';}

	return '<address class="insperia-address">' . $company . $addressOne . $addressTwo . $phone . $mail . $url . '</address>';
}
/*------------------------------------------------------
Insperia Contact Info Function - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia Add Contact Widget - Begin
-------------------------------------------------------*/
class Insperia_Contact_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Insperia_Contact_Widget',
			__( 'Insperia Contact Widget', 'insperia' ),
			array( 'description' => __( 'Insert a Contact Information', 'insperia' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * 
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo insperia_contact_widget_value();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * 
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'insperia' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , "insperia"); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * 
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}
/*------------------------------------------------------
Insperia Add Contact Widget - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Register Contact Widget - Begin
-------------------------------------------------------*/
function Register_Insperia_Contact_Widget() {
    register_widget( 'Insperia_Contact_Widget' );
}
add_action( 'widgets_init', 'Register_Insperia_Contact_Widget' );
/*------------------------------------------------------
Insperia Register Contact Widget - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia WooCommerce Functions - Started
-------------------------------------------------------*/
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	if (class_exists('Woocommerce')) {
		ob_start();

		?>
			<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="dropdown-toggle insperia-cart-contents" data-toggle="dropdown">
				<i class="fa fa-shopping-cart"></i> <span class="label label-primary"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
			</a>		
		<?php
		
		$fragments['a.insperia-cart-contents'] = ob_get_clean();

		return $fragments;
	}
} 

/*------------------------------------------------------
Insperia WooCommerce Functions - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Add WooCommece Cart to Header - Started
-------------------------------------------------------*/
function insperia_get_header_cart(){
	
	$sentient_cart = '';
	if (class_exists('Woocommerce')) {
		global $woocommerce;
		
		do_action( 'woocommerce_before_mini_cart' );
		
		$sentient_cart .= '<ul class="cart_list product_list_widget ">';

			if ( sizeof( WC()->cart->get_cart() ) > 0 ) {

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );


							$sentient_cart .= '<li>
								<a href="'. esc_url(get_permalink( $product_id )) .'">
									'. $thumbnail . $product_name .'
								</a>

								'. WC()->cart->get_item_data( $cart_item ) .'

								'. apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ) .'
							</li>';

						}
					}


			} else { 
				$sentient_cart_title = __('No products in the cart.', 'insperia' );
				$sentient_cart .= '<li class="empty">'. $sentient_cart_title .'</li>';

			}

		$sentient_cart .= '</ul>';

		if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
			
			$sentient_Subtotal = __( 'Subtotal', 'insperia' );
			$sentient_view = __( 'View Cart', 'insperia' );
			$sentient_checkout = __( 'Checkout', 'insperia' );
			
			$sentient_cart .= '<p class="total"><strong>'. $sentient_Subtotal .':</strong> '. WC()->cart->get_cart_subtotal() .'</p>';

			do_action( 'woocommerce_widget_shopping_cart_before_buttons' );

			$sentient_cart .='<p class="buttons">
				<a href="'. esc_url(WC()->cart->get_cart_url()) .'" class="button wc-forward">'. $sentient_view .'</a>
				<a href="'. esc_url(WC()->cart->get_checkout_url()) .'" class="button checkout wc-forward">' . $sentient_checkout . '</a>
			</p>';
			
		}

		do_action( 'woocommerce_after_mini_cart' ); 

	}
	
	return $sentient_cart;
}
/*------------------------------------------------------
Insperia Add WooCommece Cart to Header - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia Generate CSS Styles - Started
-------------------------------------------------------*/
function Insperia_Generate_CSS(){

	global $prof_default;

	$GetStyle = "";
	
	/* Apply Dynamic CSS */
	$GetStyle .= "";
	$getcorrectbodyfont = str_replace('+', ' ', of_get_option('select_font',$prof_default));
	
	$getcorrectheadingonefont = str_replace('+', ' ', of_get_option('h1_font',$prof_default));
	$getcorrectheadingtwofont = str_replace('+', ' ', of_get_option('h2_font',$prof_default));
	$getcorrectheadingthreefont = str_replace('+', ' ', of_get_option('h3_font',$prof_default));
	$getcorrectheadingfourfont = str_replace('+', ' ', of_get_option('h4_font',$prof_default));
	$getcorrectheadingfivefont = str_replace('+', ' ', of_get_option('h5_font',$prof_default));
	$getcorrectheadingSixfont = str_replace('+', ' ', of_get_option('h6_font',$prof_default));
	
	/* HTML styles	*/
	$GetStyle .= "
		
		@font-face{font-family: entypo; src: url(" . get_template_directory_uri(). "/fonts/entypo.woff);}		
		@font-face{font-family: entyposocial; src: url(" . get_template_directory_uri(). "/fonts/entypo-social.woff);}
		@font-face{font-family: fontello; src: url(" . get_template_directory_uri(). "/fonts/fontello.woff);}
		@font-face{font-family: fontawesome; src: url(" . get_template_directory_uri(). "/fonts/fontawesome-webfont.woff);}				
		
		.header .heading,
		input, textarea,
		.wpb_wrapper, .wpb_wrapper p,
		.wpb_wrapper p span:not(.fa), .wpb_wrapper span:not(.fa),
		.wpb_wrapper span p, .ui-widget, body{
			font-family: " . $getcorrectbodyfont . " !important;
		}
		
		footer {background:" . of_get_option('foo_color',$prof_default) . ";}
		
		.header .box-heading, .number-counters strong {
			font-family: " . $getcorrectheadingtwofont . ";
		}
		
		.section-title h1:not(.layerslider-heading) span{
			font-family: " . $getcorrectheadingonefont . " !important;
		}
		
		h1{color:" . of_get_option('h1_color',$prof_default) . "; font-family: " . $getcorrectheadingonefont . " !important; font-size: " . of_get_option('h1_font_size',$prof_default) . " !important; line-height: " . of_get_option('h1_line_height',$prof_default) . " !important;}
		h2{color:" . of_get_option('h2_color',$prof_default) . "; font-family: " . $getcorrectheadingtwofont . " !important; font-size: " . of_get_option('h2_font_size',$prof_default) . " !important; line-height: " . of_get_option('h2_line_height',$prof_default) . " !important;}
		h3{color:" . of_get_option('h3_color',$prof_default) . "; font-family: " . $getcorrectheadingthreefont . " !important; font-size: " . of_get_option('h3_font_size',$prof_default) . " !important; line-height: " . of_get_option('h3_line_height',$prof_default) . " !important;}
		h4{color:" . of_get_option('h4_color',$prof_default) . "; font-family: " . $getcorrectheadingfourfont . " !important; font-size: " . of_get_option('h4_font_size',$prof_default) . " !important; line-height: " . of_get_option('h4_line_height',$prof_default) . " !important;}			
		h5{color:" . of_get_option('h5_color',$prof_default) . ";font-family: " . $getcorrectheadingfivefont . " !important;font-size: " . of_get_option('h5_font_size',$prof_default) . " !important;line-height: " . of_get_option('h5_line_height',$prof_default) . " !important;}
		h6{color:" . of_get_option('h6_color',$prof_default) . "; font-family: " . $getcorrectheadingSixfont . " !important; font-size: " . of_get_option('h6_font_size',$prof_default) . " !important; line-height: " . of_get_option('h6_line_height',$prof_default) . " !important;}			
		
		.wpb_toggle:not(.layerslider-heading), #content h4.wpb_toggle:not(.layerslider-heading) {
		  border: 1px solid #e6e6e6;
		  color: #242526 !important;
		  font-size: 16px !important;
		  margin: 0 0 5px;
		  padding: 10px 15px;
		}
		
		.wpb_toggle_content {
		  background: none repeat scroll 0 0 #fff;
		  border: 1px solid #e6e6e6;
		  margin: -6px 0 6px !important;
		  padding: 15px !important;
		}
		
		.navbar-header a{margin-top:" . of_get_option('theme_site_logo_padding_top',$prof_default) . "; margin-bottom:" . of_get_option('theme_site_logo_padding_bottom',$prof_default) . "; margin-left:" . of_get_option('theme_site_logo_padding_left',$prof_default) . ";margin-right:" . of_get_option('theme_site_logo_padding_right',$prof_default) . ";}		

		a.insperia-onepage-active:hover, a.insperia-onepage-active{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.flickr_badge_image:hover{border-color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.proftheme-widget ul li a.sentient-widget-recent-post-title:hover,{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_toggle:hover, #content h4.wpb_toggle:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.wpb_toggle_title_active:hover, #content h4.wpb_toggle_title_active:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.wpb_toggle, #content h4.wpb_toggle{background-color:#f5f5f5 !important; background-image:none !important; color:#333 !important;}
		.wpb_toggle_title_active, #content h4.wpb_toggle_title_active{background-color:#f5f5f5 !important; color:#333 !important; background-image:none !important;}
				
		.wpb_tabs_nav.ui-tabs-nav.clearfix.ui-helper-reset.ui-helper-clearfix.ui-widget-header.ui-corner-all li.ui-state-default.ui-corner-top.ui-tabs-active.ui-state-active,
		.portfolio-pagination span:hover, .portfolio-pagination a.page-numbers:hover ,
		.portfolio-pagination .page-numbers:hover, #wp-calendar #today,
		.contactform .contact-form-send-btn{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
		}

		#recentcomments .sentient-comments-author a:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		
		.comment-edit-link,
		a:hover:not(.sentient-button),
		.Recent-post-list li:hover,
		Recent-post-list li a:hover,
		.comment-post-title,
		#recentcomments .recentcomments a,
		#comments #respond h3,
		.reply a.comment-reply-link:hover ,
		.reply:hover{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.div-top:hover{border:2px solid " . of_get_option('theme_color',$prof_default) . ";}
		.div-top:hover i{color:" . of_get_option('theme_color',$prof_default) . ";}
				
		
		ul.wpb_tabs_nav.ui-tabs-nav li.ui-state-default.ui-state-active a{
			color: #ffffff !important;		
		}
		
		
		ul.wpb_tabs_nav.ui-tabs-nav li.ui-state-default.ui-state-active a:hover{
			background:" .  of_get_option('theme_color',$prof_default) . " !important;
			color:#fff !important;
		}

		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active.ui-state-active a:hover,		
		.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover{
			color: " . of_get_option('theme_color',$prof_default) . " !important;
			background:transparent !important;		
		}
		
		ul.wpb_tabs_nav.ui-tabs-nav li.ui-state-default a:hover{
			color: " . of_get_option('theme_color',$prof_default) . " !important;
			background:#ffffff !important;
		}		
		
		.wpb_content_element .wpb_tabs_nav li a{color:#242526 !important;}
		
		a:hover, a
		{
			color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		input:focus, textarea:focus {
			border: 1px solid " . of_get_option('theme_color',$prof_default) . ";
		}
		
		footer p a{color:" . of_get_option('theme_color',$prof_default) . " !important;}/

		.slider-section .ls-bottom-nav-wrapper  .ls-bottom-slidebuttons a:hover,
		.slider-section .ls-bottom-nav-wrapper  .ls-bottom-slidebuttons a.ls-nav-active{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
			border:2px solid " . of_get_option('theme_color',$prof_default) . " !important;
		}		
		
		.footer-social-links{
			background:url('" . of_get_option('social_back',$prof_default) . "') repeat scroll 0 0 transparent;
		}
		
		.splash-banner.page-header-wrap {background-image:url('" . of_get_option('page_title_image',$prof_default) . "'); }
		
		
		.wpb_content_element .wpb_tabs_nav li.ui-tabs-active{
		  background:" .  of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.wpb_tour .wpb_tour_tabs_wrapper .wpb_tab,	
		.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab {
		  background-color: transparent !important;
		  border: 1px solid #e6e6e6 !important;
		  padding: 20px !important;
		}
		
		.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header{
		  background-color: transparent !important;
		  border: 1px solid #e6e6e6 !important;
		  padding: 10px 15px  !important;		
		}
		
		.woocommerce nav.woocommerce-pagination ul li a:hover,
		.woocommerce #content nav.woocommerce-pagination ul li a:hover,
		.woocommerce-page nav.woocommerce-pagination ul li a:hover,
		.woocommerce-page #content nav.woocommerce-pagination ul li a:hover{
			background:" . of_get_option('theme_color',$prof_default) . ";
			color:#fff !important;
		}
				
		.dropdown-menu > .current-menu-item > a, .dropdown-menu > .current-menu-item > a:hover, .dropdown-menu > .current-menu-item > a:focus{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.service.style4:hover { background:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		.woocommerce-pagination .page-numbers li a:hover,
		.shop .products li .add-to-cart-btn:hover,
		.pro .column-header,
		.status-well,
		.social-links a:hover, .social-links a:focus,
		.post-quote, .post-link,
		.fun-facts .fact:hover .fa,
		.service.style4:hover > .fa,
		.service.style3:hover > .fa,
		.portfolio-item .zoom:hover, .portfolio-item .zoom:focus, .portfolio-item .link:hover, .portfolio-item .link:focus,
		.tags-cloud a:hover, .tags-cloud a:focus,
		.woocommerce #respond input#submit:hover,
		.woocommerce #content input.button:hover,
		.woocommerce-page #respond input#submit:hover,
		.woocommerce-page #content input.button:hover,
		.woocommerce #respond input#submit,
		.woocommerce #content input.button,
		.woocommerce-page #respond input#submit,
		.woocommerce-page #content input.button,		
		.shop .product-summary .cart .single_add_to_cart_button:hover,
		.shop .product-summary .cart .single_add_to_cart_button{
			background:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.fun-facts .fact:hover .fa {color:#fff !important; box-shadow:0 0 0 6px #fff !important; }
		
		.woocommerce ul.products li.product a.button.added:hover{background:" . of_get_option('theme_color',$prof_default) . "; color:#fff !important;}
		
		.woocommerce .products li .price ins,
		.shop .products li .price ins,
		.shop .product-summary .price ins,
		.support-header .fa.fa-support,
		.page-header-wrap .breadcrumb li a i,
		.post-audio .post-type,
		.post-footer .like:focus .fa,
		.masonry-blog .post-img .post-type, .masonry-blog .post-quote .post-type, .masonry-blog .post-video .post-type, .masonry-blog .no-media .post-type, .masonry-blog .post-link .post-type,
		.service p > a:hover, .service p > a:focus,
		.shop .product-summary .product_meta a:hover{
			color:" . of_get_option('theme_color',$prof_default) . " !important;
		}
		
		.label-primary[href]:hover, .label-primary[href]:focus,
		.label-primary,
		.progress-bar,
		.plans .header,
		.service.style1:hover > .fa { background-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		.pagination > li.active > a,
		.pagination > li.active > span,
		.pagination > .active > a,
		.pagination > .active > span,
		.pagination > .active > a:hover,
		.pagination > .active > span:hover,
		.pagination > .active > a:focus,
		.pagination > .active > span:focus,
		.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus,
		.insperia-submit input{
			background-color: " . of_get_option('theme_color',$prof_default) . ";
			border-color: " . of_get_option('theme_color',$prof_default) . ";
		}
		
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active:hover,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active:hover,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active:hover,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active:hover,		
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active {
		  background:" . of_get_option('theme_color',$prof_default) . ";
		  color:#fff;
		}
		
		.like:hover .fa { text-shadow:0 0 5px " . of_get_option('theme_color',$prof_default) . "; }
		
		
		.service.style2:hover > .fa,
		.tweet-time .fa,.form-signin:hover .fa,
		.like:hover .fa, .portfolio-item .like:focus .fa,
		.options-list li.active a, .options-list li.active a:hover, .options-list li.active a:focus,
		.grid-btn:hover, .grid-btn:focus,
		.navbar .navbar-brand span, .logo span,
		.tweet-details .fa{
			color:" . of_get_option('theme_color',$prof_default) . ";
		}		
		
		.fa-angle-left:hover, .fa-angle-right:hover, .carousel-indicators .active, .carousel-indicators .active:hover { background:" . of_get_option('theme_color',$prof_default) . "; color:#fff; }
		.custom-tabs .nav-tabs > li.active > a:after { border-color: " . of_get_option('theme_color',$prof_default) . " rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);}
		
		.custom-tabs .nav-tabs > li.active > a,
		.custom-tabs .nav-tabs > li.active > a:hover,
		.custom-tabs .nav-tabs > li.active > a:focus { background:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . "; color:#fff; }
		
		.nav-tabs > li.active > a,
		.nav-tabs > li.active > a:hover,
		.nav-tabs > li.active.open > a:hover,
		.nav-tabs > li.active > a:focus{border-radius:0; background:" . of_get_option('theme_color',$prof_default) . "; color:#fff; border-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		.portfolio-item a.like:hover i{ color:" . of_get_option('theme_color',$prof_default) . " !important; }
		
		.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus,
		.color-primary,.colored,.styled-header .fa,
		a:hover, a:focus, .colored, blockquote footer a:hover, blockquote footer a:focus,
		.error-404 h1 .fa { color:" . of_get_option('theme_color',$prof_default) . "; }		
		
		a.btn:hover{color:#fff !important;}
		
		.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus,
		.bg-primary { background-color:" . of_get_option('theme_color',$prof_default) . "; }
		
		.btn-primary.btn-line { background-color:transparent; color:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . "; box-shadow:0 0 0 1px " . of_get_option('theme_color',$prof_default) . " inset; }
		
		.btn-dark.btn-line:hover, .btn-dark.btn-line:focus,
		.btn-primary.btn-line:hover, .btn-primary.btn-line:focus { background-color:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . "; color:#fff; box-shadow:0 0 0 1px " . of_get_option('theme_color',$prof_default) . " inset; }
		
		header .splash-banner{background:url('" . of_get_option('slider_background_image',$prof_default) . "') repeat scroll center top rgba(0, 0, 0, 0);}
		
		header .splash-banner.insperia-hide-image{background-image:none;}
		
		.pagination .pages a.page-numbers {
		  background: " . of_get_option('theme_color',$prof_default) . ";  
		}
		
		.btn-primary,
		.btn-primary.btn-line,
		.btn-primary.disabled,
		.btn-primary[disabled],
		fieldset[disabled] .btn-primary,
		.btn-primary.disabled:hover,
		.btn-primary[disabled]:hover,
		fieldset[disabled] .btn-primary:hover,
		.btn-primary.disabled:focus,
		.btn-primary[disabled]:focus,
		fieldset[disabled] .btn-primary:focus,
		.btn-primary.disabled:active,
		.btn-primary[disabled]:active,
		fieldset[disabled] .btn-primary:active,
		.btn-primary.disabled.active,
		.btn-primary.active[disabled],
		fieldset[disabled] .btn-primary.active{border-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		.btn-primary, .btn-primary.btn-line, .btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary.active[disabled], fieldset[disabled] .btn-primary.active,
		.btn-primary:hover,
		.btn-primary:focus,
		.btn-primary:active,
		.btn-primary.active{background-color:" . of_get_option('theme_color',$prof_default) . "; border-color:" . of_get_option('theme_color',$prof_default) . ";}
		
		
		.short-line:after,
		.woocommerce-account input.button:hover,
		.woocommerce-account input.button,
		.woocommerce input#place_order,
		.woocommerce-page input#place_order,
		.woocommerce .checkout_coupon input.button,
		.woocommerce-page .checkout_coupon input.button,
		.woocommerce .cart-collaterals .shipping_calculator .button:hover,
		.woocommerce-page .cart-collaterals .shipping_calculator .button:hover,		
		.woocommerce .cart-collaterals .shipping_calculator .button,
		.woocommerce-page .cart-collaterals .shipping_calculator .button{
			background:" . of_get_option('theme_color',$prof_default) . ";
		}
		
		.newsletter.newsletter-widget .newsletter-submit,
		.newsletter.newsletter-widget .newsletter-submit:hover,
		.woocommerce .cart input.button.checkout-button,
		.woocommerce-page .cart input.button.checkout-button,
		.woocommerce .cart input.button[name=update_cart],
		.woocommerce-page .cart input.button[name=update_cart],
		.woocommerce .cart input.button.checkout-button:hover,
		.woocommerce-page .cart input.button.checkout-button:hover,
		.woocommerce .cart input.button[name=update_cart]:hover,
		.woocommerce-page .cart input.button[name=update_cart]:hover,		
		.woocommerce table.cart td.actions .coupon input.button:hover,
		.woocommerce #content table.cart td.actions .coupon input.button:hover,
		.woocommerce-page table.cart td.actions .coupon input.button:hover,
		.woocommerce-page #content table.cart td.actions .coupon input.button:hover,		
		.woocommerce table.cart td.actions .coupon input.button,
		.woocommerce #content table.cart td.actions .coupon input.button,
		.woocommerce-page table.cart td.actions .coupon input.button,
		.woocommerce-page #content table.cart td.actions .coupon input.button{
			background:" . of_get_option('theme_color',$prof_default) . ";
		}
		
		.slider-button {background:" . of_get_option('theme_color',$prof_default) . ";}
		
		.insperia-comingsoon-button .wpcf7-submit{background:" . of_get_option('theme_color',$prof_default) . ";}
		
		.tp-caption a:hover , .tp-caption a {
		  color: #fff !important;
		}
		
		.blog-audio-container{background:" . of_get_option('theme_color',$prof_default) . ";}
		.proftheme-widget #searchform i.icon-search:hover{color:" . of_get_option('theme_color',$prof_default) . " !important;}
		.tagcloud a:hover{background:" . of_get_option('theme_color',$prof_default) . " !important; color:#fff !important;}
		
		";			
		
		
	$GetStyle .= of_get_option('css_text',$prof_default);
	$GetStyle .= " 
	
	";
	$GetStyle .= "
	
	";
	
	return $GetStyle;	
}

/***************************************************/
/*Insperia Import CSS Styles - End*/
/***************************************************/





/***************************************************/
/*Insperia Custom Field Icon List - End*/
/***************************************************/
function create_post_icon_list( $object, $box ) { ?>
	<p>
		<label for="post-icon">Icon</label>
		<br />
		<select name="post-icon" id="post-icon" cols="60" rows="4" tabindex="30" style="width: 97%;">
			<option value="align-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-left'){ ?> selected="selected" <?php } ?>>Align Left</option>
			<option value="align-center" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-center'){ ?> selected="selected" <?php } ?>>Align Center</option>
			<option value="align-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-right'){ ?> selected="selected" <?php } ?>>Align Right</option>
			<option value="align-justify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'align-justify'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows'){ ?> selected="selected" <?php } ?>>Arrows</option>
			<option value="arrow-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-left'){ ?> selected="selected" <?php } ?>>Align Justify</option>
			<option value="arrow-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-right'){ ?> selected="selected" <?php } ?>>Arrow Left</option>
			<option value="arrow-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-up'){ ?> selected="selected" <?php } ?>>Arrow Up</option>
			<option value="arrow-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-down'){ ?> selected="selected" <?php } ?>>Arrow Down</option>
			<option value="asterisk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'asterisk'){ ?> selected="selected" <?php } ?>>Asterisk</option>
			<option value="arrows-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-v'){ ?> selected="selected" <?php } ?>>Arrows V</option>
			<option value="arrows-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-h'){ ?> selected="selected" <?php } ?>>Arrows H</option>
			<option value="arrow-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-left'){ ?> selected="selected" <?php } ?>>Arrow Circle Left</option>
			<option value="arrow-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-right'){ ?> selected="selected" <?php } ?>>Arrow Circle Right</option>
			<option value="arrow-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-up'){ ?> selected="selected" <?php } ?>>Arrow Circle Up</option>
			<option value="arrow-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrow-circle-down'){ ?> selected="selected" <?php } ?>>Arrow Circle Down</option>
			<option value="arrows-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'arrows-alt'){ ?> selected="selected" <?php } ?>>Arrows Alt</option>
			<option value="ambulance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ambulance'){ ?> selected="selected" <?php } ?>>Ambulance</option>
			<option value="adn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'adn'){ ?> selected="selected" <?php } ?>>Adn</option>
			<option value="angle-double-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-left'){ ?> selected="selected" <?php } ?>>Angle Double Left</option>
			<option value="angle-double-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-right'){ ?> selected="selected" <?php } ?>>Angle Double Right</option>
			<option value="angle-double-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-up'){ ?> selected="selected" <?php } ?>>Angle Double Up</option>
			<option value="angle-double-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-double-down'){ ?> selected="selected" <?php } ?>>Angle Double Down</option>
			<option value="angle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-left'){ ?> selected="selected" <?php } ?>>Angle Left</option>
			<option value="angle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-right'){ ?> selected="selected" <?php } ?>>Angle Right</option>
			<option value="angle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-up'){ ?> selected="selected" <?php } ?>>Angle Up</option>
			<option value="angle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'angle-down'){ ?> selected="selected" <?php } ?>>Angle Down</option>
			<option value="anchor" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'anchor'){ ?> selected="selected" <?php } ?>>Anchor</option>
			<option value="android" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'android'){ ?> selected="selected" <?php } ?>>Android</option>
			<option value="apple" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'apple'){ ?> selected="selected" <?php } ?>>Apple</option>
			<option value="archive" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'archive'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="automobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'automobile'){ ?> selected="selected" <?php } ?>>Archive</option>
			<option value="bars" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bars'){ ?> selected="selected" <?php } ?>>Bars</option>
			<option value="backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'backward'){ ?> selected="selected" <?php } ?>>Backward</option>
			<option value="ban" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ban'){ ?> selected="selected" <?php } ?>>Ban</option>
			<option value="barcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'barcode'){ ?> selected="selected" <?php } ?>>Barcode</option>
			<option value="bank" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bank'){ ?> selected="selected" <?php } ?>>Bank</option>
			<option value="bell" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell'){ ?> selected="selected" <?php } ?>>Bell</option>
			<option value="book" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'book'){ ?> selected="selected" <?php } ?>>Book</option>
			<option value="bookmark" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark'){ ?> selected="selected" <?php } ?>>Bookmark</option>
			<option value="bold" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bold'){ ?> selected="selected" <?php } ?>>Bold</option>
			<option value="bullhorn" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullhorn'){ ?> selected="selected" <?php } ?>>Bullhorn</option>
			<option value="briefcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'briefcase'){ ?> selected="selected" <?php } ?>>Briefcase</option>
			<option value="bolt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bolt'){ ?> selected="selected" <?php } ?>>Bolt</option>
			<option value="beer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'beer'){ ?> selected="selected" <?php } ?>>Beer</option>
			<option value="behance" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'behance'){ ?> selected="selected" <?php } ?>>Behance</option>
			<option value="bitcoin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitcoin'){ ?> selected="selected" <?php } ?>>Bitcoin</option>
			<option value="bitbucket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bitbucket'){ ?> selected="selected" <?php } ?>>Bitbucket</option>
			<option value="bomb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bomb'){ ?> selected="selected" <?php } ?>>Bomb</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="bullseye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bullseye'){ ?> selected="selected" <?php } ?>>Bullseye</option>
			<option value="bug" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bug'){ ?> selected="selected" <?php } ?>>Bug</option>
			<option value="building" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building'){ ?> selected="selected" <?php } ?>>Building</option>
			<option value="check" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check'){ ?> selected="selected" <?php } ?>>Check</option>
			<option value="cog" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cog'){ ?> selected="selected" <?php } ?>>Cog</option>
			<option value="camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'camera'){ ?> selected="selected" <?php } ?>>Camera</option>
			<option value="crosshairs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'crosshairs'){ ?> selected="selected" <?php } ?>>Cross Hairs</option>
			<option value="compress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compress'){ ?> selected="selected" <?php } ?>>Compress</option>
			<option value="calendar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'calendar'){ ?> selected="selected" <?php } ?>>Calendar</option>
			<option value="comment" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comment'){ ?> selected="selected" <?php } ?>>Comment</option>
			<option value="cogs" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cogs'){ ?> selected="selected" <?php } ?>>Cogs</option>
			<option value="comments" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'comments'){ ?> selected="selected" <?php } ?>>Comments</option>
			<option value="credit-card" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'credit-card'){ ?> selected="selected" <?php } ?>>Credit Card</option>
			<option value="certificate" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'certificate'){ ?> selected="selected" <?php } ?>>Certificate</option>
			<option value="chain" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain'){ ?> selected="selected" <?php } ?>>Chain</option>
			<option value="cloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud'){ ?> selected="selected" <?php } ?>>Cloud</option>
			<option value="cut" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cut'){ ?> selected="selected" <?php } ?>>Cut</option>
			<option value="copy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'copy'){ ?> selected="selected" <?php } ?>>Copy</option>
			<option value="caret-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-down'){ ?> selected="selected" <?php } ?>>Caret Down</option>
			<option value="caret-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-up'){ ?> selected="selected" <?php } ?>>Caret Up</option>
			<option value="caret-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-left'){ ?> selected="selected" <?php } ?>>Caret Left</option>
			<option value="caret-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'caret-right'){ ?> selected="selected" <?php } ?>>Caret Right</option>
			<option value="columns" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'columns'){ ?> selected="selected" <?php } ?>>Columns</option>
			<option value="clipboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clipboard'){ ?> selected="selected" <?php } ?>>Clipboard</option>
			<option value="cloud-download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-download'){ ?> selected="selected" <?php } ?>>Cloud Download</option>
			<option value="cloud-upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cloud-upload'){ ?> selected="selected" <?php } ?>>Cloud Upload</option>
			<option value="coffee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'coffee'){ ?> selected="selected" <?php } ?>>Coffee</option>
			<option value="cutlery" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cutlery'){ ?> selected="selected" <?php } ?>>Cutlery</option>
			<option value="car" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'car'){ ?> selected="selected" <?php } ?>>Car</option>
			<option value="cab" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cab'){ ?> selected="selected" <?php } ?>>Cab</option>
			<option value="chevron-circle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-left'){ ?> selected="selected" <?php } ?>>Chevron Circle Left</option>
			<option value="chevron-circle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-right'){ ?> selected="selected" <?php } ?>>Chevron Circle Right</option>
			<option value="chevron-circle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-up'){ ?> selected="selected" <?php } ?>>Chevron Circle Up</option>
			<option value="chevron-circle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chevron-circle-down'){ ?> selected="selected" <?php } ?>>Chevron Circle Down</option>
			<option value="check-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'check-square'){ ?> selected="selected" <?php } ?>>Check Square</option>
			<option value="child" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'child'){ ?> selected="selected" <?php } ?>>Child</option>
			<option value="chain-broken" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'chain-broken'){ ?> selected="selected" <?php } ?>>Chain Broken</option>
			<option value="circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle'){ ?> selected="selected" <?php } ?>>Circle</option>
			<option value="circle-thin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-thin'){ ?> selected="selected" <?php } ?>>Circle Thin</option>
			<option value="cny" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cny'){ ?> selected="selected" <?php } ?>>CNY</option>
			<option value="code" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'code'){ ?> selected="selected" <?php } ?>>Code</option>
			<option value="compass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'compass'){ ?> selected="selected" <?php } ?>>Compass</option>
			<option value="codepen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'codepen'){ ?> selected="selected" <?php } ?>>Code Pen</option>
			<option value="css3" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'css3'){ ?> selected="selected" <?php } ?>>CSS3</option>
			<option value="cube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cube'){ ?> selected="selected" <?php } ?>>Cube</option>
			<option value="cubes" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cubes'){ ?> selected="selected" <?php } ?>>Cubes</option>
			<option value="download" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'download'){ ?> selected="selected" <?php } ?>>Download</option>
			<option value="dedent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dedent'){ ?> selected="selected" <?php } ?>>Dedent</option>
			<option value="dashboard" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dashboard'){ ?> selected="selected" <?php } ?>>Dashboard</option>
			<option value="database" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'database'){ ?> selected="selected" <?php } ?>>Database</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="desktop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'desktop'){ ?> selected="selected" <?php } ?>>Desktop</option>
			<option value="delicious" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'delicious'){ ?> selected="selected" <?php } ?>>Delicious</option>
			<option value="drupal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'drupal'){ ?> selected="selected" <?php } ?>>Drupal</option>
			<option value="dribbble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dribbble'){ ?> selected="selected" <?php } ?>>Dribbble</option>
			<option value="dropbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dropbox'){ ?> selected="selected" <?php } ?>>Dropbox</option>
			<option value="dollar" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dollar'){ ?> selected="selected" <?php } ?>>Dollar</option>
			<option value="digg" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'digg'){ ?> selected="selected" <?php } ?>>Digg</option>
			<option value="exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exchange'){ ?> selected="selected" <?php } ?>>Exchange</option>
			<option value="eyedropper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eyedropper'){ ?> selected="selected" <?php } ?>>Eye Dropper</option>
			<option value="eject" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eject'){ ?> selected="selected" <?php } ?>>Eject</option>
			<option value="expand" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'expand'){ ?> selected="selected" <?php } ?>>Expand</option>
			<option value="exclamation-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-circle'){ ?> selected="selected" <?php } ?>>Exclamation Circle</option>
			<option value="eye" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye'){ ?> selected="selected" <?php } ?>>Eye</option>
			<option value="eye-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eye-slash'){ ?> selected="selected" <?php } ?>>Eye Slash</option>
			<option value="exclamation-triangle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation-triangle'){ ?> selected="selected" <?php } ?>>Exclamation Triangle</option>
			<option value="external-link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'external-link'){ ?> selected="selected" <?php } ?>>External Link</option>
			<option value="envelope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope'){ ?> selected="selected" <?php } ?>>Envelope</option>
			<option value="empire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'empire'){ ?> selected="selected" <?php } ?>>Empire</option>
			<option value="eraser" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eraser'){ ?> selected="selected" <?php } ?>>Eraser</option>
			<option value="exclamation" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'exclamation'){ ?> selected="selected" <?php } ?>>Exclamation</option>
			<option value="ellipsis-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-h'){ ?> selected="selected" <?php } ?>>Ellipsis H</option>
			<option value="ellipsis-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ellipsis-v'){ ?> selected="selected" <?php } ?>>Ellipsis V</option>
			<option value="euro" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'euro'){ ?> selected="selected" <?php } ?>>Euro</option>
			<option value="eur" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'eur'){ ?> selected="selected" <?php } ?>>Eur</option>
			<option value="flash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flash'){ ?> selected="selected" <?php } ?>>Flash</option>
			<option value="fighter-jet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fighter-jet'){ ?> selected="selected" <?php } ?>>Fighter Jet</option>
			<option value="film" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'film'){ ?> selected="selected" <?php } ?>>Film</option>
			<option value="flag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag'){ ?> selected="selected" <?php } ?>>Flag</option>
			<option value="font" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'font'){ ?> selected="selected" <?php } ?>>Font</option>
			<option value="fast-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-backward'){ ?> selected="selected" <?php } ?>>Fast Backward</option>
			<option value="forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'forward'){ ?> selected="selected" <?php } ?>>Forward</option>
			<option value="fast-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fast-forward'){ ?> selected="selected" <?php } ?>>Fast Forward</option>
			<option value="fire" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire'){ ?> selected="selected" <?php } ?>>Fire</option>
			<option value="folder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder'){ ?> selected="selected" <?php } ?>>Folder</option>
			<option value="folder-open" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-open'){ ?> selected="selected" <?php } ?>>Folder Open</option>
			<option value="facebook" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'facebook'){ ?> selected="selected" <?php } ?>>Facebook</option>
			<option value="filter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'filter'){ ?> selected="selected" <?php } ?>>Filter</option>
			<option value="fax" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fax'){ ?> selected="selected" <?php } ?>>Fax</option>
			<option value="female" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'female'){ ?> selected="selected" <?php } ?>>Female</option>
			<option value="foursquare" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'foursquare'){ ?> selected="selected" <?php } ?>>foursquare</option>
			<option value="fire-extinguisher" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'fire-extinguisher'){ ?> selected="selected" <?php } ?>>Fire Extinguisher</option>
			<option value="flag-checkered" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flag-checkered'){ ?> selected="selected" <?php } ?>>Flag Checkered</option>
			<option value="file" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file'){ ?> selected="selected" <?php } ?>>File</option>
			<option value="file-text" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-text'){ ?> selected="selected" <?php } ?>>File Text</option>
			<option value="flickr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'flickr'){ ?> selected="selected" <?php } ?>>flickr</option>
			<option value="google-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google-plus'){ ?> selected="selected" <?php } ?>>Google Plus</option>
			<option value="gavel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gavel'){ ?> selected="selected" <?php } ?>>Gavel</option>
			<option value="glass" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'glass'){ ?> selected="selected" <?php } ?>>Glass</option>
			<option value="gear" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gear'){ ?> selected="selected" <?php } ?>>Gear</option>
			<option value="gift" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gift'){ ?> selected="selected" <?php } ?>>Gift</option>
			<option value="gears" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gears'){ ?> selected="selected" <?php } ?>>Gears</option>
			<option value="github" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'github'){ ?> selected="selected" <?php } ?>>Github</option>
			<option value="globe" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'globe'){ ?> selected="selected" <?php } ?>>Globe</option>
			<option value="group" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'group'){ ?> selected="selected" <?php } ?>>Group</option>
			<option value="google" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'google'){ ?> selected="selected" <?php } ?>>Google</option>
			<option value="graduation-cap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'graduation-cap'){ ?> selected="selected" <?php } ?>>Graduation Cap</option>
			<option value="gittip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gittip'){ ?> selected="selected" <?php } ?>>Gittip</option>
			<option value="gbp" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gbp'){ ?> selected="selected" <?php } ?>>GBP</option>
			<option value="gamepad" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'gamepad'){ ?> selected="selected" <?php } ?>>Game Pad</option>
			<option value="git" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'git'){ ?> selected="selected" <?php } ?>>GIT</option>
			<option value="heart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart'){ ?> selected="selected" <?php } ?>>Heart</option>
			<option value="home" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'home'){ ?> selected="selected" <?php } ?>>Home</option>
			<option value="headphones" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'headphones'){ ?> selected="selected" <?php } ?>>Headphones</option>
			<option value="header" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'header'){ ?> selected="selected" <?php } ?>>Header</option>
			<option value="history" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'history'){ ?> selected="selected" <?php } ?>>History</option>
			<option value="hacker-news" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hacker-news'){ ?> selected="selected" <?php } ?>>Hacker News</option>
			<option value="html5" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'html5'){ ?> selected="selected" <?php } ?>>HTML5</option>
			<option value="h-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'h-square'){ ?> selected="selected" <?php } ?>>H Square</option>
			<option value="italic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'italic'){ ?> selected="selected" <?php } ?>>Italic</option>
			<option value="indent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'indent'){ ?> selected="selected" <?php } ?>>Indent</option>
			<option value="image" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'image'){ ?> selected="selected" <?php } ?>>Image</option>
			<option value="inverse" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inverse'){ ?> selected="selected" <?php } ?>>Inverse</option>
			<option value="inbox" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inbox'){ ?> selected="selected" <?php } ?>>Inbox</option>
			<option value="institution" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'institution'){ ?> selected="selected" <?php } ?>>Institution</option>
			<option value="instagram" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'instagram'){ ?> selected="selected" <?php } ?>>Instagram</option>
			<option value="inr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'inr'){ ?> selected="selected" <?php } ?>>INR</option>
			<option value="info" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'info'){ ?> selected="selected" <?php } ?>>Info</option>
			<option value="jsfiddle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jsfiddle'){ ?> selected="selected" <?php } ?>>JS Fiddle</option>
			<option value="joomla" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'joomla'){ ?> selected="selected" <?php } ?>>Joomla</option>
			<option value="jpy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'jpy'){ ?> selected="selected" <?php } ?>>JPY</option>
			<option value="key" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'key'){ ?> selected="selected" <?php } ?>>Key</option>
			<option value="krw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'krw'){ ?> selected="selected" <?php } ?>>KRW</option>
			<option value="link" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'link'){ ?> selected="selected" <?php } ?>>Link</option>
			<option value="list-ul" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ul'){ ?> selected="selected" <?php } ?>>List Ul</option>
			<option value="list-ol" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-ol'){ ?> selected="selected" <?php } ?>>List OL</option>
			<option value="linkedin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linkedin'){ ?> selected="selected" <?php } ?>>LinkedIn</option>
			<option value="legal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'legal'){ ?> selected="selected" <?php } ?>>Legal</option>
			<option value="list-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list-alt'){ ?> selected="selected" <?php } ?>>List Alt</option>
			<option value="lock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lock'){ ?> selected="selected" <?php } ?>>Lock</option>
			<option value="list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'list'){ ?> selected="selected" <?php } ?>>List</option>
			<option value="leaf" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'leaf'){ ?> selected="selected" <?php } ?>>Leaf</option>
			<option value="life-bouy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-bouy'){ ?> selected="selected" <?php } ?>>Lifebouy</option>
			<option value="life-saver" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-saver'){ ?> selected="selected" <?php } ?>>Life Saver</option>
			<option value="language" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'language'){ ?> selected="selected" <?php } ?>>Language</option>
			<option value="laptop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'laptop'){ ?> selected="selected" <?php } ?>>Laptop</option>
			<option value="level-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-up'){ ?> selected="selected" <?php } ?>>Level up</option>
			<option value="level-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'level-down'){ ?> selected="selected" <?php } ?>>Level Down</option>
			<option value="linux" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'linux'){ ?> selected="selected" <?php } ?>>Linux</option>
			<option value="life-ring" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'life-ring'){ ?> selected="selected" <?php } ?>>Life Ring</option>
			<option value="magnet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magnet'){ ?> selected="selected" <?php } ?>>Magnet</option>
			<option value="map-marker" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'map-marker'){ ?> selected="selected" <?php } ?>>Map Marker</option>
			<option value="magic" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'magic'){ ?> selected="selected" <?php } ?>>Magic</option>
			<option value="money" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'money'){ ?> selected="selected" <?php } ?>>Money</option>
			<option value="medkit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'medkit'){ ?> selected="selected" <?php } ?>>Med kit</option>
			<option value="music" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'music'){ ?> selected="selected" <?php } ?>>Music</option>
			<option value="mail-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-forward'){ ?> selected="selected" <?php } ?>>Mail Forward</option>
			<option value="minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'minus'){ ?> selected="selected" <?php } ?>>Minus</option>
			<option value="mortar-board" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mortar-board'){ ?> selected="selected" <?php } ?>>Mortar Board</option>
			<option value="male" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'male'){ ?> selected="selected" <?php } ?>>Male</option>
			<option value="mobile-phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile-phone'){ ?> selected="selected" <?php } ?>>Mobile Phone</option>
			<option value="mobile" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mobile'){ ?> selected="selected" <?php } ?>>Mobile</option>
			<option value="mail-reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mail-reply'){ ?> selected="selected" <?php } ?>>Mail Reply</option>
			<option value="microphone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone'){ ?> selected="selected" <?php } ?>>Microphone</option>
			<option value="microphone-slash" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'microphone-slash'){ ?> selected="selected" <?php } ?>>Microphone Slash</option>
			<option value="navicon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'navicon'){ ?> selected="selected" <?php } ?>>Nav icon</option>
			<option value="lightbulb-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lightbulb-o'){ ?> selected="selected" <?php } ?>>Open Lightbulb</option>
			<option value="bell-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bell-o'){ ?> selected="selected" <?php } ?>>Open Bell</option>
			<option value="building-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'building-o'){ ?> selected="selected" <?php } ?>>Open Building</option>
			<option value="hospital-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hospital-o'){ ?> selected="selected" <?php } ?>>Open Hospital</option>
			<option value="envelope-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'envelope-o'){ ?> selected="selected" <?php } ?>>Open Envelope</option>
			<option value="star-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-o'){ ?> selected="selected" <?php } ?>>Open Star</option>
			<option value="trash-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trash-o'){ ?> selected="selected" <?php } ?>>Open Trash</option>
			<option value="file-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'file-o'){ ?> selected="selected" <?php } ?>>Open File</option>
			<option value="clock-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'clock-o'){ ?> selected="selected" <?php } ?>>Open Clock</option>
			<option value="outdent" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'outdent'){ ?> selected="selected" <?php } ?>>Outdent</option>
			<option value="picture-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'picture-o'){ ?> selected="selected" <?php } ?>>Open Picture</option>
			<option value="pencil-square-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square-o'){ ?> selected="selected" <?php } ?>>Open Pencil Square</option>
			<option value="bar-chart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bar-chart-o'){ ?> selected="selected" <?php } ?>>Open Bar Chart</option>
			<option value="thumbs-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-up'){ ?> selected="selected" <?php } ?>>Open Thumbs Up</option>
			<option value="thumbs-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumbs-o-down'){ ?> selected="selected" <?php } ?>>Open Thumbs Down</option>
			<option value="heart-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heart-o'){ ?> selected="selected" <?php } ?>>Open Heart</option>
			<option value="lemon-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'lemon-o'){ ?> selected="selected" <?php } ?>>Open Lemon</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Open Square</option>
			<option value="bookmark-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bookmark-o'){ ?> selected="selected" <?php } ?>>Open Bookmark</option>
			<option value="hdd-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hdd-o'){ ?> selected="selected" <?php } ?>>Open hdd</option>
			<option value="hand-o-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-right'){ ?> selected="selected" <?php } ?>>Open Hand Right</option>
			<option value="hand-o-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-left'){ ?> selected="selected" <?php } ?>>Open Hand Left</option>
			<option value="hand-o-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-up'){ ?> selected="selected" <?php } ?>>Open Hand Up</option>
			<option value="hand-o-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hand-o-down'){ ?> selected="selected" <?php } ?>>Open Hand Down</option>
			<option value="files-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'files-o'){ ?> selected="selected" <?php } ?>>Open Files</option>
			<option value="floppy-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'floppy-o'){ ?> selected="selected" <?php } ?>>Open Floppy</option>
			<option value="circle-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'circle-o'){ ?> selected="selected" <?php } ?>>Open Circle</option>
			<option value="folder-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'folder-o'){ ?> selected="selected" <?php } ?>>Open Folder</option>
			<option value="smile-o" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'smile-o'){ ?> selected="selected" <?php } ?>>Open Smile</option>
			<option value="pinterest" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pinterest'){ ?> selected="selected" <?php } ?>>Pinterest</option>
			<option value="paste" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paste'){ ?> selected="selected" <?php } ?>>Paste</option>
			<option value="power-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'power-off'){ ?> selected="selected" <?php } ?>>Power Off</option>
			<option value="print" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'print'){ ?> selected="selected" <?php } ?>>Print</option>
			<option value="photo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'photo'){ ?> selected="selected" <?php } ?>>Photo</option>
			<option value="play" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play'){ ?> selected="selected" <?php } ?>>Play</option>
			<option value="pause" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pause'){ ?> selected="selected" <?php } ?>>Pause</option>
			<option value="plus-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-circle'){ ?> selected="selected" <?php } ?>>Plus Circle</option>
			<option value="plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus'){ ?> selected="selected" <?php } ?>>Plus</option>
			<option value="plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plane'){ ?> selected="selected" <?php } ?>>Plane</option>
			<option value="phone" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone'){ ?> selected="selected" <?php } ?>>Phone</option>
			<option value="phone-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'phone-square'){ ?> selected="selected" <?php } ?>>Phone Square</option>
			<option value="paperclip" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paperclip'){ ?> selected="selected" <?php } ?>>Paper Clip</option>
			<option value="puzzle-piece" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'puzzle-piece'){ ?> selected="selected" <?php } ?>>Puzzle Piece</option>
			<option value="play-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'play-circle'){ ?> selected="selected" <?php } ?>>Play Circle</option>
			<option value="pencil-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pencil-square'){ ?> selected="selected" <?php } ?>>Pencil Square</option>
			<option value="pagelines" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pagelines'){ ?> selected="selected" <?php } ?>>Page Lines</option>
			<option value="pied-piper-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-square'){ ?> selected="selected" <?php } ?>>Pied Piper Square</option>
			<option value="pied-piper" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper'){ ?> selected="selected" <?php } ?>>Pied Piper</option>
			<option value="pied-piper-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pied-piper-alt'){ ?> selected="selected" <?php } ?>>Pied Piper Alt</option>
			<option value="paw" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paw'){ ?> selected="selected" <?php } ?>>Paw</option>
			<option value="paper-plane" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paper-plane'){ ?> selected="selected" <?php } ?>>Paper Plane</option>
			<option value="paragraph" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'paragraph'){ ?> selected="selected" <?php } ?>>Paragraph</option>
			<option value="plus-square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'plus-square'){ ?> selected="selected" <?php } ?>>Plus Square</option>
			<option value="qrcode" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qrcode'){ ?> selected="selected" <?php } ?>>QR Code</option>
			<option value="question-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question-circle'){ ?> selected="selected" <?php } ?>>Question Circle</option>
			<option value="question" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'question'){ ?> selected="selected" <?php } ?>>Question</option>
			<option value="qq" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'qq'){ ?> selected="selected" <?php } ?>>QQ</option>
			<option value="quote-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-left'){ ?> selected="selected" <?php } ?>>Quote Left</option>
			<option value="quote-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'quote-right'){ ?> selected="selected" <?php } ?>>Quote Right</option>
			<option value="random" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'random'){ ?> selected="selected" <?php } ?>>Random</option>
			<option value="retweet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'retweet'){ ?> selected="selected" <?php } ?>>Retweet</option>
			<option value="rss" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rss'){ ?> selected="selected" <?php } ?>>RSS</option>
			<option value="reorder" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reorder'){ ?> selected="selected" <?php } ?>>Reorder</option>
			<option value="rotate-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-left'){ ?> selected="selected" <?php } ?>>Rotate Left</option>
			<option value="rotate-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rotate-right'){ ?> selected="selected" <?php } ?>>Rotate Right</option>
			<option value="road" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'road'){ ?> selected="selected" <?php } ?>>Road</option>
			<option value="repeat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'repeat'){ ?> selected="selected" <?php } ?>>Repeat</option>
			<option value="refresh" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'refresh'){ ?> selected="selected" <?php } ?>>Refresh</option>
			<option value="reply" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reply'){ ?> selected="selected" <?php } ?>>Reply</option>
			<option value="rocket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rocket'){ ?> selected="selected" <?php } ?>>Rocket</option>
			<option value="rupee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rupee'){ ?> selected="selected" <?php } ?>>Rupee</option>
			<option value="rmb" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rmb'){ ?> selected="selected" <?php } ?>>RMB</option>
			<option value="ruble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ruble'){ ?> selected="selected" <?php } ?>>Ruble</option>
			<option value="rouble" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rouble'){ ?> selected="selected" <?php } ?>>Rouble</option>
			<option value="rub" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rub'){ ?> selected="selected" <?php } ?>>Rub</option>
			<option value="renren" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'renren'){ ?> selected="selected" <?php } ?>>Renren</option>
			<option value="reddit" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'reddit'){ ?> selected="selected" <?php } ?>>Reddit</option>
			<option value="recycle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'recycle'){ ?> selected="selected" <?php } ?>>Recycle</option>
			<option value="rebel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'rebel'){ ?> selected="selected" <?php } ?>>Rebel</option>
			<option value="step-backward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-backward'){ ?> selected="selected" <?php } ?>>Step Backward</option>
			<option value="stop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stop'){ ?> selected="selected" <?php } ?>>Stop</option>
			<option value="step-forward" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'step-forward'){ ?> selected="selected" <?php } ?>>Step Forward</option>
			<option value="shopping-cart" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shopping-cart'){ ?> selected="selected" <?php } ?>>Shopping Cart</option>
			<option value="star-half" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star-half'){ ?> selected="selected" <?php } ?>>Star Half</option>
			<option value="sign-out" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-out'){ ?> selected="selected" <?php } ?>>Sign Out</option>
			<option value="sign-in" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sign-in'){ ?> selected="selected" <?php } ?>>Sign In</option>
			<option value="scissors" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'scissors'){ ?> selected="selected" <?php } ?>>Scissors</option>
			<option value="save" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'save'){ ?> selected="selected" <?php } ?>>Save</option>
			<option value="square" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'square'){ ?> selected="selected" <?php } ?>>Square</option>
			<option value="strikethrough" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'strikethrough'){ ?> selected="selected" <?php } ?>>Strike Through</option>
			<option value="sort" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort'){ ?> selected="selected" <?php } ?>>Sort</option>
			<option value="sort-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sort-down'){ ?> selected="selected" <?php } ?>>Sort Down</option>
			<option value="sitemap" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sitemap'){ ?> selected="selected" <?php } ?>>Site map</option>
			<option value="search" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search'){ ?> selected="selected" <?php } ?>>Search</option>
			<option value="star" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'star'){ ?> selected="selected" <?php } ?>>Star</option>
			<option value="stethoscope" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stethoscope'){ ?> selected="selected" <?php } ?>>Stethoscope</option>
			<option value="suitcase" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'suitcase'){ ?> selected="selected" <?php } ?>>Suitcase</option>
			<option value="search-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-plus'){ ?> selected="selected" <?php } ?>>Search Plus</option>
			<option value="search-minus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'search-minus'){ ?> selected="selected" <?php } ?>>Search Minus</option>
			<option value="signal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'signal'){ ?> selected="selected" <?php } ?>>Signal</option>
			<option value="spinner" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spinner'){ ?> selected="selected" <?php } ?>>Spinner</option>
			<option value="superscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'superscript'){ ?> selected="selected" <?php } ?>>Superscript</option>
			<option value="subscript" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'subscript'){ ?> selected="selected" <?php } ?>>Subscript</option>
			<option value="shield" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shield'){ ?> selected="selected" <?php } ?>>Shield</option>
			<option value="stack-overflow" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-overflow'){ ?> selected="selected" <?php } ?>>Stack Overflow</option>
			<option value="skype" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'skype'){ ?> selected="selected" <?php } ?>>Skype</option>
			<option value="stack-exchange" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stack-exchange'){ ?> selected="selected" <?php } ?>>Stack Exchange</option>
			<option value="space-shuttle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'space-shuttle'){ ?> selected="selected" <?php } ?>>Space Shuttle</option>
			<option value="slack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'slack'){ ?> selected="selected" <?php } ?>>Slack</option>
			<option value="stumbleupon-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon-circle'){ ?> selected="selected" <?php } ?>>Stumbleupon Circle</option>
			<option value="stumbleupon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'stumbleupon'){ ?> selected="selected" <?php } ?>>Stumbleupon</option>
			<option value="spoon" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spoon'){ ?> selected="selected" <?php } ?>>Spoon</option>
			<option value="steam" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'steam'){ ?> selected="selected" <?php } ?>>Steam</option>
			<option value="spotify" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'spotify'){ ?> selected="selected" <?php } ?>>Spotify</option>
			<option value="soundcloud" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'soundcloud'){ ?> selected="selected" <?php } ?>>Soundcloud</option>
			<option value="support" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'support'){ ?> selected="selected" <?php } ?>>Support</option>
			<option value="send" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'send'){ ?> selected="selected" <?php } ?>>Send</option>
			<option value="sliders" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sliders'){ ?> selected="selected" <?php } ?>>Sliders</option>
			<option value="share-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'share-alt'){ ?> selected="selected" <?php } ?>>Share Alt</option>
			<option value="tag" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tag'){ ?> selected="selected" <?php } ?>>Tag</option>
			<option value="tags" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tags'){ ?> selected="selected" <?php } ?>>Tags</option>
			<option value="text-height" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-height'){ ?> selected="selected" <?php } ?>>Text Height</option>
			<option value="text-width" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'text-width'){ ?> selected="selected" <?php } ?>>Text Width</option>
			<option value="times-circle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times-circle'){ ?> selected="selected" <?php } ?>>Times Circle</option>
			<option value="thumb-tack" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'thumb-tack'){ ?> selected="selected" <?php } ?>>Thumb Tack</option>
			<option value="trophy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trophy'){ ?> selected="selected" <?php } ?>>Trophy</option>
			<option value="twitter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'twitter'){ ?> selected="selected" <?php } ?>>Twitter</option>
			<option value="tasks" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tasks'){ ?> selected="selected" <?php } ?>>Tasks</option>
			<option value="truck" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'truck'){ ?> selected="selected" <?php } ?>>Truck</option>
			<option value="tachometer" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tachometer'){ ?> selected="selected" <?php } ?>>Tachometer</option>
			<option value="th-large" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-large'){ ?> selected="selected" <?php } ?>>Thumbnail Large</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th-list" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th-list'){ ?> selected="selected" <?php } ?>>Thumbnail</option>
			<option value="th" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'th'){ ?> selected="selected" <?php } ?>>Thumbnail List</option>
			<option value="times" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'times'){ ?> selected="selected" <?php } ?>>Times</option>
			<option value="ticket" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ticket'){ ?> selected="selected" <?php } ?>>Ticket</option>
			<option value="toggle-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-down'){ ?> selected="selected" <?php } ?>>Toggle Down</option>
			<option value="toggle-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-up'){ ?> selected="selected" <?php } ?>>Toggle Up</option>
			<option value="toggle-right" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-right'){ ?> selected="selected" <?php } ?>>Toggle Right</option>
			<option value="tumblr" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tumblr'){ ?> selected="selected" <?php } ?>>Tumblr</option>
			<option value="trello" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'trello'){ ?> selected="selected" <?php } ?>>Trello</option>
			<option value="toggle-left" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'toggle-left'){ ?> selected="selected" <?php } ?>>Toggle Left</option>
			<option value="turkish-lira" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'turkish-lira'){ ?> selected="selected" <?php } ?>>Turkish Lira</option>
			<option value="try" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'try'){ ?> selected="selected" <?php } ?>>Try</option>
			<option value="taxi" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'taxi'){ ?> selected="selected" <?php } ?>>Taxi</option>
			<option value="tree" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tree'){ ?> selected="selected" <?php } ?>>Tree</option>
			<option value="tencent-weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tencent-weibo'){ ?> selected="selected" <?php } ?>>Tencent Weibo</option>
			<option value="tablet" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'tablet'){ ?> selected="selected" <?php } ?>>Tablet</option>
			<option value="terminal" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'terminal'){ ?> selected="selected" <?php } ?>>Terminal</option>
			<option value="upload" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'upload'){ ?> selected="selected" <?php } ?>>Upload</option>
			<option value="unlock" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock'){ ?> selected="selected" <?php } ?>>Unlock</option>
			<option value="users" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'users'){ ?> selected="selected" <?php } ?>>Users</option>
			<option value="underline" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'underline'){ ?> selected="selected" <?php } ?>>Underline</option>
			<option value="unsorted" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unsorted'){ ?> selected="selected" <?php } ?>>Unsorted</option>
			<option value="undo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'undo'){ ?> selected="selected" <?php } ?>>Undo</option>
			<option value="user-md" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user-md'){ ?> selected="selected" <?php } ?>>User MD</option>
			<option value="umbrella" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'umbrella'){ ?> selected="selected" <?php } ?>>Umbrella</option>
			<option value="user" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user'){ ?> selected="selected" <?php } ?>>User</option>
			<option value="unlock-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlock-alt'){ ?> selected="selected" <?php } ?>>Unlock Alt</option>
			<option value="usd" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'usd'){ ?> selected="selected" <?php } ?>>USD</option>
			<option value="university" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'university'){ ?> selected="selected" <?php } ?>>University</option>
			<option value="unlink" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'unlink'){ ?> selected="selected" <?php } ?>>Unlink</option>
			<option value="volume-off" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-off'){ ?> selected="selected" <?php } ?>>Volume Off</option>
			<option value="volume-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-down'){ ?> selected="selected" <?php } ?>>Volume Down</option>
			<option value="volume-up" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'volume-up'){ ?> selected="selected" <?php } ?>>Volume Up</option>
			<option value="video-camera" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'video-camera'){ ?> selected="selected" <?php } ?>>Video Camera</option>
			<option value="vk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vk'){ ?> selected="selected" <?php } ?>>VK</option>
			<option value="vine" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'vine'){ ?> selected="selected" <?php } ?>>Vine</option>
			<option value="warning" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'warning'){ ?> selected="selected" <?php } ?>>Warning</option>
			<option value="wrench" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wrench'){ ?> selected="selected" <?php } ?>>Wrench</option>
			<option value="won" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'won'){ ?> selected="selected" <?php } ?>>Won</option>
			<option value="windows" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'windows'){ ?> selected="selected" <?php } ?>>Windows</option>
			<option value="weibo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weibo'){ ?> selected="selected" <?php } ?>>Weibo</option>
			<option value="wheelchair" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wheelchair'){ ?> selected="selected" <?php } ?>>Wheel Chair</option>
			<option value="wordpress" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wordpress'){ ?> selected="selected" <?php } ?>>WordPress</option>
			<option value="wechat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'wechat'){ ?> selected="selected" <?php } ?>>We Chat</option>
			<option value="weixin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'weixin'){ ?> selected="selected" <?php } ?>>Weixin</option>
			<option value="xing" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'xing'){ ?> selected="selected" <?php } ?>>Xing</option>
			<option value="yen" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yen'){ ?> selected="selected" <?php } ?>>Yen</option>
			<option value="youtube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'youtube'){ ?> selected="selected" <?php } ?>>YouTube</option>
			<option value="yahoo" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'yahoo'){ ?> selected="selected" <?php } ?>>Yahoo</option>
			<option value="bed" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'bed'){ ?> selected="selected" <?php } ?>>Bed</option>
			<option value="buysellads" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'buysellads'){ ?> selected="selected" <?php } ?>>Buy Sell Ads</option>
			<option value="whatsapp" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'whatsapp'){ ?> selected="selected" <?php } ?>>Whatsapp</option>
			<option value="viacoin" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'viacoin'){ ?> selected="selected" <?php } ?>>Via Coin</option>
			<option value="venus-mars" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'venus-mars'){ ?> selected="selected" <?php } ?>>Venus Mars</option>
			<option value="venus-double" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'venus-double'){ ?> selected="selected" <?php } ?>>Venus Double</option>
			<option value="venus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'venus'){ ?> selected="selected" <?php } ?>>Venus</option>
			<option value="user-times" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user-times'){ ?> selected="selected" <?php } ?>>User Times</option>
			<option value="user-secret" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user-secret'){ ?> selected="selected" <?php } ?>>User Secret</option>
			<option value="user-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'user-plus'){ ?> selected="selected" <?php } ?>>User Plus</option>
			<option value="transgender-alt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'transgender-alt'){ ?> selected="selected" <?php } ?>>Trans Gender Alt</option>
			<option value="transgender" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'transgender'){ ?> selected="selected" <?php } ?>>Trans Gender</option>
			<option value="train" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'train'){ ?> selected="selected" <?php } ?>>Train</option>
			<option value="subway" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'subway'){ ?> selected="selected" <?php } ?>>Subway</option>
			<option value="street-view" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'street-view'){ ?> selected="selected" <?php } ?>>Street View</option>
			<option value="skyatlas" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'skyatlas'){ ?> selected="selected" <?php } ?>>Sky Atlas</option>
			<option value="simplybuilt" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'simplybuilt'){ ?> selected="selected" <?php } ?>>Simply Built</option>
			<option value="shirtsinbulk" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'shirtsinbulk'){ ?> selected="selected" <?php } ?>>Shirt Sin Bulk</option>
			<option value="ship" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'ship'){ ?> selected="selected" <?php } ?>>Ship</option>
			<option value="server" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'server'){ ?> selected="selected" <?php } ?>>Server</option>
			<option value="sellsy" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'sellsy'){ ?> selected="selected" <?php } ?>>Sellsy</option>
			<option value="pinterest-p" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'pinterest-p'){ ?> selected="selected" <?php } ?>>Pinterest Character</option>
			<option value="neuter" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'neuter'){ ?> selected="selected" <?php } ?>>Neuter</option>
			<option value="motorcycle" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'motorcycle'){ ?> selected="selected" <?php } ?>>Motorcycle</option>
			<option value="mercury" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mercury'){ ?> selected="selected" <?php } ?>>Mercury</option>
			<option value="medium" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'medium'){ ?> selected="selected" <?php } ?>>Medium</option>
			<option value="mars-stroke-v" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mars-stroke-v'){ ?> selected="selected" <?php } ?>>Mars Stroke Vertical</option>
			<option value="mars-stroke-h" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mars-stroke-h'){ ?> selected="selected" <?php } ?>>Mars Stroke Horizontal</option>
			<option value="mars-stroke" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mars-stroke'){ ?> selected="selected" <?php } ?>>Mars Stroke</option>
			<option value="mars-double" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mars-double'){ ?> selected="selected" <?php } ?>>Mars Double</option>
			<option value="mars" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'mars'){ ?> selected="selected" <?php } ?>>Mars</option>
			<option value="leanpub" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'leanpub'){ ?> selected="selected" <?php } ?>>Lean Pub</option>
			<option value="hotel" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'hotel'){ ?> selected="selected" <?php } ?>>Hotel</option>
			<option value="heartbeat" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'heartbeat'){ ?> selected="selected" <?php } ?>>Heartbeat</option>
			<option value="forumbee" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'forumbee'){ ?> selected="selected" <?php } ?>>Forum bee</option>
			<option value="facebook-official" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'facebook-official'){ ?> selected="selected" <?php } ?>>Facebook Official</option>
			<option value="diamond" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'diamond'){ ?> selected="selected" <?php } ?>>Diamond</option>
			<option value="dashcube" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'dashcube'){ ?> selected="selected" <?php } ?>>Dash Cube</option>
			<option value="connectdevelop" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'connectdevelop'){ ?> selected="selected" <?php } ?>>Connect Develop</option>
			<option value="cart-plus" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cart-plus'){ ?> selected="selected" <?php } ?>>Cart Plus</option>
			<option value="cart-arrow-down" <?php if(get_post_meta( $object->ID, 'Icon', true ) == 'cart-arrow-down'){ ?> selected="selected" <?php } ?>>Cart Arrow Down</option>									
		</select> 
		<input type="hidden" name="meta_box_icon" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</p>
<?php }
/***************************************************/
/*Insperia Custom Field Icon List - End*/
/***************************************************/



?>