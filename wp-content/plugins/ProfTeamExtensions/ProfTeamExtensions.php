<?php  
	/* 
	Plugin Name: ProfTeamExtensions
	Plugin URI: http://www.profteamsolutions.com
	Version: 3.3
	Author: ProfTeam
	Description: A plugin that Provide Post Types.
	*/  


/*------------------------------------------------------
Insperia, Add Actions - Started
-------------------------------------------------------*/
add_action( 'plugins_loaded', 'insperia_ext_setup' );


function insperia_ext_setup(){
	add_action('init', 'insperia_register_cpt_services' );
	add_action('init', 'insperia_register_cpt_duties' );
	add_action('init', 'insperia_register_cpt_skills' );
	add_action('init', 'insperia_register_menus' );
	add_action('init', 'insperia_register_cpt_team' );
	add_action( 'init', 'insperia_register_cpt_portfolio' );
	add_action( 'init', 'insperia_register_cpt_testimonial' );	
	add_action( 'init', 'insperia_register_cpt_gallery' );	


	add_action( 'init', 'create_portfolio_taxonomies');	
	add_action( 'init', 'create_gallery_taxonomies');
}
/*------------------------------------------------------
Insperia, Add Actions - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia, Gallery Categories - Started
-------------------------------------------------------*/
function create_gallery_taxonomies() {
	
	$labels = array(
		'name'              => _x( 'Gallery Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Gallery Categories', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Gallery Categories' ),
		'all_items'         => __( 'All Gallery Categories' ),
		'parent_item'       => __( 'Parent Gallery Categories' ),
		'parent_item_colon' => __( 'Parent Gallery Categories:' ),
		'edit_item'         => __( 'Edit Gallery Category' ),
		'update_item'       => __( 'Update Gallery Category' ),
		'add_new_item'      => __( 'Add New Gallery Category' ),
		'new_item_name'     => __( 'New Gallery Category Name' ),
		'menu_name'         => __( 'Gallery Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'gallerycategories' ),
	);

	register_taxonomy( 'gallerycategories', array( 'gallery' ), $args );

}
/*------------------------------------------------------
Insperia, Gallery Categories - End
-------------------------------------------------------*/





/*------------------------------------------------------
Insperia, Portfolio Categories - Started
-------------------------------------------------------*/
function create_portfolio_taxonomies() {
	
	$labels = array(
		'name'              => _x( 'Portfolio Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Portfolio Categories', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Portfolio Categories' ),
		'all_items'         => __( 'All Portfolio Categories' ),
		'parent_item'       => __( 'Parent Portfolio Categories' ),
		'parent_item_colon' => __( 'Parent Portfolio Categories:' ),
		'edit_item'         => __( 'Edit Portfolio Category' ),
		'update_item'       => __( 'Update Portfolio Category' ),
		'add_new_item'      => __( 'Add New Portfolio Category' ),
		'new_item_name'     => __( 'New Portfolio Category Name' ),
		'menu_name'         => __( 'Portfolio Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfoliocategories' ),
	);

	register_taxonomy( 'portfoliocategories', array( 'portfolio' ), $args );

}
/*------------------------------------------------------
Insperia, Portfolio Categories - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia Menu Options - Started
-------------------------------------------------------*/

function insperia_register_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' , 'sentient'),
      'extra-menu' => __( 'Extra Menu' , 'sentient')
    )
  );
}

/*------------------------------------------------------
Insperia Menu Options - End
-------------------------------------------------------*/





/*------------------------------------------------------
Insperia, Add Gallery Option to the Theme - Started
-------------------------------------------------------*/
function insperia_register_cpt_gallery() {

$labels = array(
	'name' => __( 'Galleries', 'sentient' ),
	'singular_name' => __( 'gallery', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New gallery', 'sentient' ),
	'edit_item' => __( 'Edit gallery', 'sentient' ),
	'new_item' => __( 'New gallery', 'sentient' ),
	'view_item' => __( 'View gallery', 'sentient' ),
	'search_items' => __( 'Search Gallery', 'sentient' ),
	'not_found' => __( 'No gallery found', 'sentient' ),
	'not_found_in_trash' => __( 'No gallery found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent gallery:', 'sentient' ),
	'menu_name' => __( 'Galleries', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title' , 'author', 'thumbnail', 'revisions' ),	
	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'gallery', $args );
}

/*------------------------------------------------------
Insperia, Add Gallery Option to the Theme - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia, Add Testimonial Option to the Theme - Started
-------------------------------------------------------*/
function insperia_register_cpt_testimonial() {

$labels = array(
	'name' => __( 'Testimonials', 'sentient' ),
	'singular_name' => __( 'testimonial', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New testimonial', 'sentient' ),
	'edit_item' => __( 'Edit testimonial', 'sentient' ),
	'new_item' => __( 'New testimonial', 'sentient' ),
	'view_item' => __( 'View testimonial', 'sentient' ),
	'search_items' => __( 'Search Testimonials', 'sentient' ),
	'not_found' => __( 'No testimonials found', 'sentient' ),
	'not_found_in_trash' => __( 'No testimonials found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent testimonial:', 'sentient' ),
	'menu_name' => __( 'Testimonials', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'testimonial', $args );
}

/*------------------------------------------------------
Insperia, Add Testimonial Option to the Theme - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia, Add Portfolio Option to the Theme - Started
-------------------------------------------------------*/
function insperia_register_cpt_portfolio() {

$labels = array(
	'name' => __( 'Portfolio', 'sentient' ),
	'singular_name' => __( 'portfolio', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New portfolio', 'sentient' ),
	'edit_item' => __( 'Edit portfolio', 'sentient' ),
	'new_item' => __( 'New portfolio', 'sentient' ),
	'view_item' => __( 'View portfolio', 'sentient' ),
	'search_items' => __( 'Search portfolios', 'sentient' ),
	'not_found' => __( 'No portfolios found', 'sentient' ),
	'not_found_in_trash' => __( 'No portfolios found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent portfolio:', 'sentient' ),
	'menu_name' => __( 'Portfolio', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ,'comments', 'excerpt'),

	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'portfolio', $args );
}

/*------------------------------------------------------
Insperia, Add Portfolio Option to the Theme - End
-------------------------------------------------------*/




/*------------------------------------------------------
Insperia, Add Team Members Option to the Theme - Started
-------------------------------------------------------*/

function insperia_register_cpt_team() {

$labels = array(
	'name' => __( 'Team', 'sentient' ),
	'singular_name' => __( 'Team', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New Team Member', 'sentient' ),
	'edit_item' => __( 'Edit Team Member', 'sentient' ),
	'new_item' => __( 'New Team Member', 'sentient' ),
	'view_item' => __( 'View Team Member', 'sentient' ),
	'search_items' => __( 'Search Team Member', 'sentient' ),
	'not_found' => __( 'No Team Member found', 'sentient' ),
	'not_found_in_trash' => __( 'No Team Member found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent Team Member:', 'sentient' ),
	'menu_name' => __( 'Team', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),

	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'team', $args );
}

/*------------------------------------------------------
Insperia, Add Team Members Option to the Theme - End
-------------------------------------------------------*/





/*------------------------------------------------------
Insperia, Services Post - Started
-------------------------------------------------------*/

function insperia_register_cpt_services() {

$labels = array(
	'name' => __( 'Services', 'sentient' ),
	'singular_name' => __( 'Services', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New Service', 'sentient' ),
	'edit_item' => __( 'Edit Service', 'sentient' ),
	'new_item' => __( 'New Service', 'sentient' ),
	'view_item' => __( 'View Service', 'sentient' ),
	'search_items' => __( 'Search Services', 'sentient' ),
	'not_found' => __( 'No Services found', 'sentient' ),
	'not_found_in_trash' => __( 'No Services found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent Services:', 'sentient' ),
	'menu_name' => __( 'Services', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author', 'revisions' ),

	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'services', $args );
}

/*------------------------------------------------------
Insperia, Services Post - End
-------------------------------------------------------*/





/*------------------------------------------------------
Insperia, Add Duties Option to the Theme - Started
-------------------------------------------------------*/
function insperia_register_cpt_duties() {

$labels = array(
	'name' => __( 'Duties', 'sentient' ),
	'singular_name' => __( 'duties', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New Duty', 'sentient' ),
	'edit_item' => __( 'Edit Duty', 'sentient' ),
	'new_item' => __( 'New Duty', 'sentient' ),
	'view_item' => __( 'View Duties', 'sentient' ),
	'search_items' => __( 'Search Duties', 'sentient' ),
	'not_found' => __( 'No Duties found', 'sentient' ),
	'not_found_in_trash' => __( 'No Duties found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent Duty:', 'sentient' ),
	'menu_name' => __( 'Duties', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'editor', 'author' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'duties', $args );
}

/*------------------------------------------------------
Insperia, Add Duties Option to the Theme - End
-------------------------------------------------------*/



/*------------------------------------------------------
Insperia, Add Skills Option to the Theme - Started
-------------------------------------------------------*/
function insperia_register_cpt_skills() {

$labels = array(
	'name' => __( 'Skills', 'sentient' ),
	'singular_name' => __( 'skills', 'sentient' ),
	'add_new' => __( 'Add New', 'sentient' ),
	'add_new_item' => __( 'Add New Skill', 'sentient' ),
	'edit_item' => __( 'Edit Skill', 'sentient' ),
	'new_item' => __( 'New Skill', 'sentient' ),
	'view_item' => __( 'View Skills', 'sentient' ),
	'search_items' => __( 'Search Skills', 'sentient' ),
	'not_found' => __( 'No Skills found', 'sentient' ),
	'not_found_in_trash' => __( 'No Skills found in Trash', 'sentient' ),
	'parent_item_colon' => __( 'Parent Skill:', 'sentient' ),
	'menu_name' => __( 'Skills', 'sentient' ),
);

$args = array(
	'labels' => $labels,
	'hierarchical' => false,

	'supports' => array( 'title', 'author' ),

	
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	  
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);

register_post_type( 'skills', $args );
}

/*------------------------------------------------------
Insperia, Add Skills Option to the Theme - End
-------------------------------------------------------*/


if ( ! function_exists( 'optionsframework_mlu_init' ) ) :

function optionsframework_mlu_init () {
	register_post_type( 'optionsframework', array(
		'labels' => array(
			'name' => __( 'Theme Options Media', 'optionsframework' ),
		),
		'public' => true,
		'show_ui' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => false,
		'supports' => array( 'title', 'editor' ), 
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => false,
		'public' => false
	) );
}

endif;



add_action( 'init', 'insperia_add_page_cats' );	
function insperia_add_page_cats()
{
    register_taxonomy_for_object_type( 'category', 'post' );
}



/*------------------------------------------------------
Insperia Shortcode - Started
-------------------------------------------------------*/

if(function_exists('insperia_homepage_container')){
	add_shortcode('homepage_container', 'insperia_homepage_container');
}

if(function_exists('insperia_homepage_container_wide')){
	add_shortcode('homepage_container_wide', 'insperia_homepage_container_wide');
}

if(function_exists('insperia_homepage_container_end')){
	add_shortcode('homepage_container_end', 'insperia_homepage_container_end');
}

if(function_exists('insperia_text')){
	add_shortcode('insperia_text', 'insperia_text');
}

if(function_exists('insperia_heading_icon')){
	add_shortcode('insperia_heading_icon', 'insperia_heading_icon');
}

if(function_exists('insperia_clients')){
	add_shortcode('insperia_clients', 'insperia_clients');
}

if(function_exists('insperia_heading_one')){
	add_shortcode('insperia_heading_one', 'insperia_heading_one');
}

if(function_exists('insperia_heading_two')){
	add_shortcode('insperia_heading_two', 'insperia_heading_two');
}

if(function_exists('insperia_heading_three')){
	add_shortcode('insperia_heading_three', 'insperia_heading_three');
}

if(function_exists('insperia_heading_four')){
	add_shortcode('insperia_heading_four', 'insperia_heading_four');
}

if(function_exists('insperia_heading_five')){
	add_shortcode('insperia_heading_five', 'insperia_heading_five');
}

if(function_exists('insperia_heading_six')){
	add_shortcode('insperia_heading_six', 'insperia_heading_six');
}

if(function_exists('insperia_list_item')){
	add_shortcode('insperia_list_item', 'insperia_list_item');
}

if(function_exists('insperia_pricing_table')){
	add_shortcode('insperia_pricing_table', 'insperia_pricing_table');
}


if(function_exists('insperia_heading_underlined')){
	add_shortcode('insperia_heading_underlined', 'insperia_heading_underlined');
}

if(function_exists('insperia_icons')){
	add_shortcode('insperia_icons', 'insperia_icons');
}

if(function_exists('insperia_contact_details')){
	add_shortcode('insperia_contact_details', 'insperia_contact_details');
}

if(function_exists('insperia_animated_numbers')){
	add_shortcode('insperia_animated_numbers', 'insperia_animated_numbers');
}

if(function_exists('insperia_testimonial')){
	add_shortcode('insperia_testimonial', 'insperia_testimonial');
}

if(function_exists('insperia_portfolio')){
	add_shortcode('insperia_portfolio', 'insperia_portfolio');
}

if(function_exists('insperia_portfolio_styletwo')){
	add_shortcode('insperia_portfolio_styletwo', 'insperia_portfolio_styletwo');
}


if(function_exists('insperia_portfolio_slider')){
	add_shortcode('insperia_portfolio_slider', 'insperia_portfolio_slider');
}

if(function_exists('insperia_portfolio_full_slider')){
	add_shortcode('insperia_portfolio_full_slider', 'insperia_portfolio_full_slider');
}

if(function_exists('insperia_products_four_col')){
	add_shortcode('insperia_products_four_col', 'insperia_products_four_col');
}

if(function_exists('insperia_button')){
	add_shortcode('insperia_button', 'insperia_button');
}

if(function_exists('insperia_services_with_image')){
	add_shortcode('insperia_services_with_image', 'insperia_services_with_image');	
}

if(function_exists('insperia_blog')){
	add_shortcode('insperia_blog', 'insperia_blog');	
}

if(function_exists('insperia_blog_timeline')){
	add_shortcode('insperia_blog_timeline', 'insperia_blog_timeline');
}

if(function_exists('insperia_services')){
	add_shortcode('insperia_services', 'insperia_services');
}

if(function_exists('insperia_duties')){
	add_shortcode('insperia_duties', 'insperia_duties');
}

if(function_exists('insperia_popover')){
	add_shortcode('insperia_popover', 'insperia_popover');
}

if(function_exists('insperia_tooltip')){
	add_shortcode('insperia_tooltip', 'insperia_tooltip');
}

if(function_exists('insperia_skills')){
	add_shortcode('insperia_skills', 'insperia_skills');
}

if(function_exists('insperia_team_members')){
	add_shortcode('insperia_team_members', 'insperia_team_members');
}

if(function_exists('insperia_team_members_details')){
	add_shortcode('insperia_team_members_details', 'insperia_team_members_details');
}

if(function_exists('insperia_team_members_style_two')){
	add_shortcode('insperia_team_members_style_two', 'insperia_team_members_style_two');
}

if(function_exists('insperia_alert_box')){
	add_shortcode('insperia_alert_box', 'insperia_alert_box');
}

if(function_exists('insperia_skill_bar')){
	add_shortcode('insperia_skill_bar', 'insperia_skill_bar');
}

if(function_exists('insperia_wells')){
	add_shortcode('insperia_wells', 'insperia_wells');
}

if(function_exists('insperia_laptop_slider')){
	add_shortcode('insperia_laptop_slider', 'insperia_laptop_slider');
}

if(function_exists('insperia_map')){
	add_shortcode('insperia_map', 'insperia_map');
}

if(function_exists('insperia_page_section')){
	add_shortcode('insperia_page_section', 'insperia_page_section');
}
/*------------------------------------------------------
Insperia Shortcode - End
-------------------------------------------------------*/





/*------------------------------------------------------
Insperia Map - Shortcode
-------------------------------------------------------*/
function insperia_map( $atts, $content = null ) {
	extract(shortcode_atts(array('latitude' => '-37.809674' , 'longitude' => '144.954718' , 'mapheight' => '470px'), $atts));
	
	global $prof_default;
			
	$return_string = '<div class="sentient-map">
		<div class="sentient-map-container">
			<!DOCTYPE html>
			<html>
			  <head>
				<style>
				  #map_canvas {
					width: 100%;
					height: ' . $mapheight . ';
				  }
				</style>
				<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
				<script>
				  function initialize() {
					var map_canvas = document.getElementById("map_canvas");
					var map_options = {
						panControl: true,
						zoomControl: true,
						scaleControl: true,
						scrollwheel: false,
						center: new google.maps.LatLng(' . $latitude . ', ' . $longitude . '),
						zoom: 15,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					
					var myLatlng = new google.maps.LatLng(' . $latitude . ', ' . $longitude . ');
					
					var map = new google.maps.Map(map_canvas, map_options);
					
					  var marker = new google.maps.Marker({
						  position: myLatlng,
						  map: map
					  });
				  }
				  google.maps.event.addDomListener(window, "load", initialize);
				</script>
			  </head>
			  <body>
				<div id="map_canvas"></div>
			  </body>
			</html>
		</div>';
		
	$return_string .= '</div>';
	
   return $return_string;	


}





/*------------------------------------------------------
Insperia Laptop Slider Images
-------------------------------------------------------*/
function insperia_laptop_slider($atts, $content = null) {
	extract(shortcode_atts(array('images' => ''), $atts));

	$returnedvalue = '';
	$splitImagesArray = explode(",", $images);
	$splitImagesArraySize = count($splitImagesArray);
	$randomNumber = rand(1, 9999);
	
	
	$returnedvalue .= '<div id="carouselOne-'. $randomNumber .'" class="carousel slide carousel-fade mackbook" data-ride="carousel">
						<ol class="carousel-indicators visible-lg">';
	
	
	$count = 0;
	for ($x=0; $x < $splitImagesArraySize; $x++)
	{
		$getimageurlarray = wp_get_attachment_image_src( $splitImagesArray[$x] , 'full');
		
		$alt = get_post_meta($splitImagesArray[$x], '_wp_attachment_image_alt', true);
		if($count < 1) {$active = 'active';} else {$active = '';}
		$returnedvalue .= '<li data-target="#carouselOne-'. $randomNumber .'" data-slide-to="' . $count . '" class="' . $active. '"></li>';
		$count = $count + 1;
	} 							

	$returnedvalue .= '</ol>
		<div class="carousel-inner">';

	$count = 1;
	for ($x=0; $x < $splitImagesArraySize; $x++)
	{
		$getimageurlarray = wp_get_attachment_image_src( $splitImagesArray[$x] , 'full');
		
		$alt = get_post_meta($splitImagesArray[$x], '_wp_attachment_image_alt', true);
		if($count < 2) {$active = 'active';} else {$active = '';}
		$returnedvalue .= '<div class="item ' . $active . '"> <img src="' . $getimageurlarray[0] . '" alt="Image"> </div>';
		$count = $count + 1;
	} 

	
	$returnedvalue .='</div>
		<a class="left carousel-control" href="#carouselOne-'. $randomNumber .'" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="right carousel-control" href="#carouselOne-'. $randomNumber .'" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>
	</div>';
	
	return $returnedvalue;		
			
}




/*------------------------------------------------------
Insperia Wells
-------------------------------------------------------*/
function insperia_wells($atts, $content = null) {
	extract(shortcode_atts(array('text' => ''), $atts));

	return '<div class="well">'. $text .'</div>';
}




/*------------------------------------------------------
Insperia Skill Bar
-------------------------------------------------------*/
function insperia_skill_bar($atts, $content = null) {
	extract(shortcode_atts(array('text' => '' , 'percentage' => '', 'color' => '' , 'iconoption' => ''), $atts));
	
	if($iconoption == 'yes') {$iconhtml = 'progress-striped';} else {$iconhtml = '';}		

	return '<div class="progress ' . $iconhtml . '">
				<div style="width: ' . $percentage . '; background:' . $color . ';" class="progress-bar"><span>' . esc_attr($text) . '</span></div>
			</div>';
}



/*------------------------------------------------------
Insperia Alert Box
-------------------------------------------------------*/
function insperia_alert_box($atts, $content = null) {
	extract(shortcode_atts(array('type' => '' , 'text' => ''), $atts));

	return '<div class="alert alert-' . $type . '">
				<button data-dismiss="alert" class="close" type="button">×</button>
				' . $text . '
			</div>';
}



/*------------------------------------------------------
Insperia Team Members Style 2
-------------------------------------------------------*/
function insperia_team_members_style_two($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' , 'animation' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	$return_string = '<div id="team-showcase-two" class="util-carousel team-showcase ' . $animation . '">';
	
	$loop = new WP_Query(array('post_type' => 'team', 'posts_per_page' => $number));

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
			
		if(get_post_meta(get_the_ID(), 'Dribbble URL', true) != ''){
			$dribbble_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Dribbble URL', true)) . '" title="'. __("Dribbble" , "sentient") .'">
									<i class="fa fa-dribbble"></i>
								</a>';
		} else {$dribbble_string ='';}
		
		if(get_post_meta(get_the_ID(), 'Facebook URL', true) != ''){
			$facebook_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Facebook URL', true)) . '" title="'. __("Facebook" , "sentient") .'">
									<i class="fa fa-facebook"></i>
								</a>';
		} else {$facebook_string ='';}
		
		if(get_post_meta(get_the_ID(), 'Twitter URL', true) != ''){
			$twitter_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Twitter URL', true)) . '" title="'. __("Twitter" , "sentient") .'">
									<i class="fa fa-twitter"></i>
								</a>';
		} else {$twitter_string ='';}
		
		if(get_post_meta(get_the_ID(), 'LinkedIn URL', true) != ''){
			$linkedin_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'LinkedIn URL', true)) . '" title="'. __("LinkedIn" , "sentient") .'">
									<i class="fa fa-linkedin"></i>
								</a>';
		} else {$linkedin_string ='';}	
		
		if(get_post_meta(get_the_ID(), 'Google URL', true) != ''){
			$google_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Google URL', true)) . '" title="'. __("Google" , "sentient") .'">
									<i class="fa fa-google-plus"></i>
								</a>';
		} else {$google_string ='';}

		if(get_post_meta(get_the_ID(), 'Pinterest URL', true) != ''){
			$flickr_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Flickr URL', true)) . '" title="'. __("Flickr" , "sentient") .'">
									<i class="fa fa-flickr"></i>
								</a>';
		} else {$flickr_string ='';}		
		
		if(get_post_meta(get_the_ID(), 'Skype URL', true) != ''){
			$skype_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Skype URL', true)) . '" title="'. __("Skype" , "sentient") .'">
									<i class="fa fa-skype"></i>
								</a>';
		} else {$skype_string ='';}			
		
		
		$get_team_position =  get_post_meta(get_the_ID(), 'Team Member Position', true);
		
		$return_string .= '
						<div class="item">
							<div class="media-holder">
								<a class="team-not-active" href="'. esc_url(get_permalink()) .'">'  . get_the_post_thumbnail( get_the_ID() , 'full' ) .  '</a>
							</div>
							<div class="social-links">
								'. $facebook_string . $linkedin_string . $twitter_string . $dribbble_string . $google_string . $flickr_string . $skype_string . '								
							</div>
							<div class="detail-container">
								<div class="detail-title"> ' . get_the_title() . ' </div>
								<div class="detail-subtitle"> ' . $get_team_position . ' </div>
							</div>
						</div>';

	endwhile;
	endif;		
	
	$return_string .='</div>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}



	

/*------------------------------------------------------
Insperia Team Members
-------------------------------------------------------*/

function insperia_team_members($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' , 'animation' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	$return_string = '<div id="team-showcase" class="util-carousel team-showcase ' . $animation . '">';

	
	$loop = new WP_Query(array('post_type' => 'team', 'posts_per_page' => $number));

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
			
		if(get_post_meta(get_the_ID(), 'Dribbble URL', true) != ''){
			$dribbble_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Dribbble URL', true)) . '" title="'. __("Dribbble" , "sentient") .'">
									<i class="fa fa-dribbble"></i>
								</a>';
		} else {$dribbble_string ='';}
		
		if(get_post_meta(get_the_ID(), 'Facebook URL', true) != ''){
			$facebook_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Facebook URL', true)) . '" title="'. __("Facebook" , "sentient") .'">
									<i class="fa fa-facebook"></i>
								</a>';
		} else {$facebook_string ='';}
		
		if(get_post_meta(get_the_ID(), 'Twitter URL', true) != ''){
			$twitter_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Twitter URL', true)) . '" title="'. __("Twitter" , "sentient") .'">
									<i class="fa fa-twitter"></i>
								</a>';
		} else {$twitter_string ='';}
		
		if(get_post_meta(get_the_ID(), 'LinkedIn URL', true) != ''){
			$linkedin_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'LinkedIn URL', true)) . '" title="'. __("LinkedIn" , "sentient") .'">
									<i class="fa fa-linkedin"></i>
								</a>';
		} else {$linkedin_string ='';}	
		
		if(get_post_meta(get_the_ID(), 'Google URL', true) != ''){
			$google_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Google URL', true)) . '" title="'. __("Google" , "sentient") .'">
									<i class="fa fa-google-plus"></i>
								</a>';
		} else {$google_string ='';}

		if(get_post_meta(get_the_ID(), 'Pinterest URL', true) != ''){
			$flickr_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Flickr URL', true)) . '" title="'. __("Flickr" , "sentient") .'">
									<i class="fa fa-flickr"></i>
								</a>';
		} else {$flickr_string ='';}		
		
		if(get_post_meta(get_the_ID(), 'Skype URL', true) != ''){
			$skype_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Skype URL', true)) . '" title="'. __("Skype" , "sentient") .'">
									<i class="fa fa-skype"></i>
								</a>';
		} else {$skype_string ='';}				
		
		$get_team_position =  get_post_meta(get_the_ID(), 'Team Member Position', true);
		
		$return_string .= '
						<div class="item">
							<div class="media-holder">
								<a class="team-not-active" href="'. esc_url(get_permalink()) .'">'  . get_the_post_thumbnail( get_the_ID() , 'full' ) .  '</a>
							</div>
							<div class="social-links">
								'. $facebook_string . $linkedin_string . $twitter_string . $dribbble_string . $google_string . $flickr_string . $skype_string .'
							</div>
							<div class="detail-container">
								<div class="detail-title"> ' . get_the_title() . ' </div>
								<div class="detail-subtitle"> ' . $get_team_position . ' </div>
								<p>' . get_the_content() . '</p>
							</div>
						</div>';

	endwhile;
	endif;		
	
	$return_string .='</div>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}





/*------------------------------------------------------
Insperia Skills
-------------------------------------------------------*/
function insperia_skills($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' , 'animation' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	$return_string = '<div id="carouselSecond" class="chart-wrap ' . $animation . ' util-carousel features-carousel">';

	
	$loop = new WP_Query(array('post_type' => 'skills', 'posts_per_page' => $number));

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
		
		$return_string .= '
				<div class="chart">
					<div class="percentage-light" data-percent="' . get_post_meta(get_the_ID(), 'Skill Value (Number Only)', true) . '"><span></span>%</div>
					<div class="chart-label">' . get_the_title() . '</div>
				</div>';

	endwhile;
	endif;		
	
	$return_string .='</div>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}






/*------------------------------------------------------
Insperia Tooltip
-------------------------------------------------------*/
function insperia_tooltip($atts, $content = null) {
	extract(shortcode_atts(array('text' => '' , 'position' => '' , 'link' => ''), $atts));		
	
	return '<ul class="list-inline insperia-tooltip"><li><a title="" data-placement="' . $position . '" data-toggle="tooltip" class="tip" href="' . esc_url($link) . '" data-original-title="' . esc_attr($text) . '">' . esc_attr($text) . '</a></li></ul>';
}




/*------------------------------------------------------
Insperia Popover
-------------------------------------------------------*/
function insperia_popover($atts, $content = null) {
	extract(shortcode_atts(array('title' => '' ,'text' => '' , 'position' => '' , 'link' => ''), $atts));		
	
	return '<ul class="list-inline insperia-tooltip">
				<li>
					<button data-content="' . esc_attr($text) . '" data-placement="' . $position . '" data-toggle="popover" data-container="body" class="btn btn-default pop-over" type="button" data-original-title="" title="">' . esc_attr($title) . '</button>
				</li>
			</ul>';
}
add_shortcode('insperia_popover', 'insperia_popover');




/*------------------------------------------------------
Insperia Duties
-------------------------------------------------------*/
function insperia_duties($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' , 'animation' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	$count=1;
	$return_string = '<section>				
			<div id="carouselFirst" class="row ' . $animation . ' util-carousel features-carousel">';
	
	$loop = new WP_Query(array('post_type' => 'duties', 'posts_per_page' => $number));

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
		
		$return_string .= '
						<div class="service style1">
							<i class="fa fa-' . get_post_meta(get_the_ID(), 'Icon', true) . ' icon"></i>
							<h5>' . get_the_title() . '</h5>
							<p>' . get_the_content() . '</p>
						</div>';

	endwhile;
	endif;		
	
	$return_string .='</div>
			</section>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}



/*------------------------------------------------------
Insperia Services
-------------------------------------------------------*/
function insperia_services($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' , 'animation' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	$count=1;
	$return_string = '<section class="custom-tabs">
							<div class="container">
								<ul id="myTab" class="nav nav-tabs ' . $animation . '">';
	
	$loop = new WP_Query(array('post_type' => 'services', 'posts_per_page' => $number));

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
		if($count < 2){$active = 'active';} else {$active = '';}
		$return_string .= '<li class="' . $active . '"> <a href="#a' . get_the_ID() . '" data-toggle="tab"> <i class="fa fa-' . get_post_meta(get_the_ID(), 'Icon', true) . '"></i>' . get_the_title() . ' </a> </li>';
		$count = $count + 1;
	endwhile;
	endif;		
	
	$return_string .='</ul><div id="myTabContent" class="tab-content">';
	$count = 1;

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
		if($count < 2){$active = 'in active';} else {$active = '';}
		$return_string .= '<div class="tab-pane fade ' . $active . '" id="a' . get_the_ID() . '">';
		$return_string .= do_shortcode(get_the_content());
		$return_string .= '</div>';
		$count = $count + 1;
	endwhile;
	endif;			
	
	$return_string .= '</div></div></section>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}



/*------------------------------------------------------
Insperia Blog Timeline - Shortcode
-------------------------------------------------------*/
function insperia_blog_timeline( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => '' , 'animation' => ''), $atts));
	
	global $prof_default;

	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	
	
	$return_string = '<div class="timeline animated">';
	
	$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $noofposts));
	
	
	$counter = 1;
	$galleryids = '';
	$getText = '';		
	$count = 0;
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
	if(has_post_format('link')){
		$postclass = 'link';
	}elseif(has_post_format('quote')){
		$postclass = 'quote';
	}elseif(has_post_format('video')){
		$postclass = 'video';
	}elseif(has_post_format('audio')){
		$postclass = 'audio';
	}else{
		$postclass = '';		
	}		
	
	if($counter % 2 == 0){
		$positionClass = 'wow fadeInRight';
	} else {
		$positionClass = 'wow fadeInLeft';
	}
		
	
	$return_string .='<div class="timeline-row ' . $animation . '">
						<div class="timeline-time"> <small>' . get_the_date('M') . ' ' . get_the_date('d') . '</small>'. get_the_time( 'H:i' ) .'</div>';
						
						if ( get_post_format() == false && has_post_thumbnail()) {
							$return_string .='<div class="timeline-icon">
												<div class="bg-info"> <i class="fa fa-image"></i> </div>
											</div>
											<div class="panel timeline-content ' . $positionClass . '">
												<div class="panel-body">
													<h4 class="strong"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></h4>
													' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
													<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
												</div>
											</div>';
									
						} elseif ( has_post_format('gallery') && get_post_meta(get_the_ID(), 'Gallery images ID', true) != ''){
							$return_string .='<div class="timeline-icon">
												<div class="bg-danger"> <i class="fa fa-camera-retro"></i> </div>
											</div>';
											
							$galleryids = explode(",", get_post_meta(get_the_ID(), 'Gallery images ID', true));
							$idscount = count($galleryids);
							$getText .= '<div class="panel timeline-content ' . $positionClass . '">
												<div class="panel-body">
													<h4 class="strong"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></h4>
													<div id="postCarousel" class="carousel slide" data-ride="carousel">
													<ol class="carousel-indicators visible-lg">';
							
							for ($x=0; $x < $idscount; $x++)
							{	
								if($count < 2) {$active = 'active';} else {$active = '';}
								$getText .= '<li data-target="#postCarousel" data-slide-to="' . $x . '" class="' . $active . '"></li>';
								$count = $count + 1;
							}
							$count = 1;
							$getText .= '</ol><div class="carousel-inner">';
							for ($x=0; $x < $idscount; $x++)
							{	
								if($count < 2) {$active = 'active';} else {$active = '';}
								$getimageurlarray = wp_get_attachment_image_src( $galleryids[$x] , 'full');
								
								$alt = get_post_meta($galleryids[$x], '_wp_attachment_image_alt', true);
								
								$getText .= '<div class="item ' . $active . '"> <img src="' . $getimageurlarray[0] . '" alt="' . $alt . '"> </div>';
								$count = $count + 1;
							} 

							$getText .='		</div>
											</div>
											<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>												
										</div></div>';
				
							$return_string .= $getText;												
																		  
						} elseif ( has_post_format( 'video' ) && get_post_meta(get_the_ID(), 'Post Video URL', true) != ''){
							$return_string .='<div class="timeline-icon">
													<div class="bg-success"> <i class="fa fa-video-camera"></i> </div>
												</div>
												<div class="panel timeline-content  ' . $positionClass . '">
													<div class="panel-body">
														<h4 class="strong"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></h4>
														<div class="video-container">
															<iframe src="'. esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)) .'"></iframe>
														</div>
														<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
													</div>
												</div>';
												 
						} elseif (has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true) != '') {
							$return_string .='<div class="timeline-icon">
													<div class="bg-info"> <i class="fa fa-music"></i> </div>
												</div>
												<div class="panel timeline-content  ' . $positionClass . '">
													<div class="panel-body">
														<h4 class="strong"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></h4>
														<div class="audio-container">
															' . do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)) .'
														</div>
														<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
													</div>
												</div>													
												';						
						} elseif (has_post_format( 'quote' )) {
							 $return_string .='<div class="timeline-icon">
													<div class="bg-warning"> <i class="fa fa-quote-right"></i> </div>
												</div>
												<div class="panel timeline-content  ' . $positionClass . '">
													<div class="panel-body">
														<blockquote>
															<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
															<small>' . get_post_meta(get_the_ID(), 'Quote Person Name', true) . '</small></blockquote>
													</div>
												</div>';
												
						} elseif (has_post_format( 'chat' )) {
							 $return_string .='<div class="timeline-icon">
													<div class="bg-warning"> <i class="fa fa-quote-right"></i> </div>
												</div>
												<div class="panel timeline-content  ' . $positionClass . '">
													<div class="panel-body">
														<blockquote>
															<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>																
													</div>
												</div>';
												 
						} elseif (has_post_format( 'link' ) && get_post_meta(get_the_ID(), 'Link Post URL', true) != '') {
							 $return_string .='<div class="timeline-icon">
													<div class="bg-warning"> <i class="fa fa-link"></i> </div>
												</div>
												<div class="panel timeline-content  ' . $positionClass . '">
													<div class="panel-body">
														<blockquote>
															<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
															<small>' . get_post_meta(get_the_ID(), 'Link Post URL', true) . '</small></blockquote>
													</div>
												</div>';
												
						}  elseif(has_post_thumbnail())  {
							$return_string .='<div class="timeline-icon">
												<div class="bg-info"> <i class="fa fa-camera"></i> </div>
											</div>
											<div class="panel timeline-content ' . $positionClass . '">
												<div class="panel-body">
													<h4 class="strong"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></h4>
													' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
													<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
												</div>
											</div>';    
						}  elseif(!has_post_thumbnail())  {
							$return_string .='<div class="timeline-icon">
												<div class="bg-primary"> <i class="fa fa-pencil"></i> </div>
											</div>
											<div class="panel timeline-content ' . $positionClass . '">
												<div class="panel-body">
													<h4 class="strong"><a href="'. esc_url(get_permalink()) .'">'. get_the_title() .'</a></h4>
													<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
												</div>
											</div>';    
						}			

		$return_string .= '</div>';

		$counter = $counter + 1;	
	
	endwhile;
	endif;
	
	$return_string .= '</div>';
	
	wp_reset_postdata();

	
	return $return_string;	

}


function insperia_team_members_details($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' , 'animation' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	$return_string = '<div id="team-showcase" class="util-carousel team-showcase ' . $animation . '">';

	
	$loop = new WP_Query(array('post_type' => 'team', 'posts_per_page' => $number));

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
			
		if(get_post_meta(get_the_ID(), 'Dribbble URL', true) != ''){
			$dribbble_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Dribbble URL', true)) . '" title="'. __("Dribbble" , "sentient") .'">
									<i class="fa fa-dribbble"></i>
								</a>';
		} else {$dribbble_string ='';}
		
		if(get_post_meta(get_the_ID(), 'Facebook URL', true) != ''){
			$facebook_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Facebook URL', true)) . '" title="'. __("Facebook" , "sentient") .'">
									<i class="fa fa-facebook"></i>
								</a>';
		} else {$facebook_string ='';}
		
		if(get_post_meta(get_the_ID(), 'Twitter URL', true) != ''){
			$twitter_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Twitter URL', true)) . '" title="'. __("Twitter" , "sentient") .'">
									<i class="fa fa-twitter"></i>
								</a>';
		} else {$twitter_string ='';}
		
		if(get_post_meta(get_the_ID(), 'LinkedIn URL', true) != ''){
			$linkedin_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'LinkedIn URL', true)) . '" title="'. __("LinkedIn" , "sentient") .'">
									<i class="fa fa-linkedin"></i>
								</a>';
		} else {$linkedin_string ='';}	
		
		if(get_post_meta(get_the_ID(), 'Google URL', true) != ''){
			$google_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Google URL', true)) . '" title="'. __("Google" , "sentient") .'">
									<i class="fa fa-google-plus"></i>
								</a>';
		} else {$google_string ='';}

		if(get_post_meta(get_the_ID(), 'Pinterest URL', true) != ''){
			$flickr_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Flickr URL', true)) . '" title="'. __("Flickr" , "sentient") .'">
									<i class="fa fa-flickr"></i>
								</a>';
		} else {$flickr_string ='';}		
		
		if(get_post_meta(get_the_ID(), 'Skype URL', true) != ''){
			$skype_string = '<a target="_blank" href="' . esc_url(get_post_meta(get_the_ID(), 'Skype URL', true)) . '" title="'. __("Skype" , "sentient") .'">
									<i class="fa fa-skype"></i>
								</a>';
		} else {$skype_string ='';}				
		
		$get_team_position =  get_post_meta(get_the_ID(), 'Team Member Position', true);
		
		$return_string .= '
						<div class="item">
							<div class="media-holder">
								<a href="'. esc_url(get_permalink()) .'">'  . get_the_post_thumbnail( get_the_ID() , 'full' ) .  '</a>
							</div>
							<div class="social-links">
								'. $facebook_string . $linkedin_string . $twitter_string . $dribbble_string . $google_string . $flickr_string . $skype_string .'
							</div>
							<div class="detail-container">
								<div class="detail-title"> ' . get_the_title() . ' </div>
								<div class="detail-subtitle"> ' . $get_team_position . ' </div>
								<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 35 )) . '</p>
							</div>
						</div>';

	endwhile;
	endif;		
	
	$return_string .='</div>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}

/*------------------------------------------------------
Insperia Blog - Shortcode
-------------------------------------------------------*/
function insperia_blog( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => '' , 'animation' => '' , 'blogbutton' => '' , 'link' => ''), $atts));
	
	global $prof_default;

	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	
	
	$return_string = '<section class="masonry-blog">
						<div class="container">
							<div class="row" id="masonryBlog">';
	
	$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $noofposts));
	
	$readmoretxt = __('Read more' , 'sentient');
	$counter = 1;
	$galleryids = '';
	$getText = '';
	$views = __('Number of Views','sentient');
	$postcomments = __('Post Comments','sentient');
	$postdate = __('Post Date','sentient');
	$insting = __('in' , 'sentient');
	

	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
	if(has_post_format('link')){
		$postclass = 'link';
	}elseif(has_post_format('quote')){
		$postclass = 'quote';
	}elseif(has_post_format('video')){
		$postclass = 'video';
	}elseif(has_post_format('audio')){
		$postclass = 'audio';
	}else{
		$postclass = '';		
	}		
	
	$count = 1;
	$return_string .='<div class="col-md-4 col-sm-6 col-xs-12 masonry-item ' . $animation  . '">
						<article class="post ' . $postclass . '">';
						
			if ( get_post_format() == false && has_post_thumbnail()) {
				$return_string .='<header class="post-header">
							<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-img">
								' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
								<i class="fa fa-image post-type"></i>
							</a>
						</header>';
						
			} elseif ( has_post_format('gallery') && get_post_meta(get_the_ID(), 'Gallery images ID', true) != ''){
				$galleryids = explode(",", get_post_meta(get_the_ID(), 'Gallery images ID', true));
				$idscount = count($galleryids);
				$getText .= '<header class="post-header"> <a href="post.html" title="'. get_the_title() .'" class="post-img">
								<div id="postCarousel-' . get_the_ID() . '" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators visible-lg">';
				
				for ($x=0; $x < $idscount; $x++)
				{	
					if($count < 2) {$active = 'active';} else {$active = '';}
					$getText .= '<li data-target="#postCarousel-' . get_the_ID() . '" data-slide-to="' . $x . '" class="' . $active . '"></li>';
					$count = $count + 1;
				}
				$count = 1;
				$getText .= '</ol><div class="carousel-inner">';
				for ($x=0; $x < $idscount; $x++)
				{	
					if($count < 2) {$active = 'active';} else {$active = '';}
					$getimageurlarray = wp_get_attachment_image_src( $galleryids[$x] , 'full');
					
					$alt = get_post_meta($galleryids[$x], '_wp_attachment_image_alt', true);
					
					$getText .= '<div class="item ' . $active . '"> <img src="' . $getimageurlarray[0] . '" alt="' . $alt . '"> </div>';
					$count = $count + 1;
				} 

				$getText .='</div>
								</div>
								<i class="fa fa-camera-retro post-type"></i> </a>
							</header>';
	
				$return_string .= $getText;
			  
			} elseif ( has_post_format( 'video' ) && get_post_meta(get_the_ID(), 'Post Video URL', true) != ''){
				 $return_string .='<header class="post-header">
									<div class="post-video">
										<iframe src="'. esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)) .'" style="border:0px;" width="100%" height="260px">
										</iframe>
										<i class="fa fa-film post-type"></i>
									</div>
									</header>';
			} elseif (has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true) != '') {
				 $return_string .='<header class="post-header">
									<div class="post-audio">
										' . do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)) .'
										<i class="fa fa-music post-type"></i>
									</div>
									</header>';								
			} elseif (has_post_format( 'quote' )) {
				 $return_string .='<header class="post-header">
									<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-quote">
									<blockquote>
									<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
									<small>' . get_post_meta(get_the_ID(), 'Quote Person Name', true) . ' ' . $insting . ' <cite title="' . get_post_meta(get_the_ID(), 'Quote Person Company', true) . '">' . get_post_meta(get_the_ID(), 'Quote Person Company', true) . '</cite></small> </blockquote>
									<i class="fa fa-quote-left post-type"></i> </a>
									</header>';
			} elseif (has_post_format( 'chat' )) {
				 $return_string .='<header class="post-header">
										<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="no-media">
										<i class="fa fa-comment post-type"></i>
										</a>
									</header>';	
			} elseif (has_post_format( 'link' ) && get_post_meta(get_the_ID(), 'Link Post URL', true) != '') {
				 $return_string .='<header class="post-header">
									<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-link">
										<blockquote>
											<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
											<small>' . get_post_meta(get_the_ID(), 'Link Post URL', true) . '</small>
										</blockquote>
										<i class="fa fa-link post-type"></i>
									</a>
									</header>';											
			}  elseif(has_post_thumbnail())  {
				$return_string .='<header class="post-header">
							<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-img">
								' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
								<i class="fa fa-glass post-type"></i>
							</a>
						</header>';    
			}							

			if(has_post_format( 'quote' ) || has_post_format( 'link' )){
				$return_string .= '<footer class="post-footer">
										<span class="post-date">
											<i class="fa fa-calendar"></i>
											<a href="'. esc_url(get_permalink()) .'" title="' . $postdate . '"> ' . get_the_date() . ' </a>
										</span>
										<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . $postcomments . '" class="comments">
											<i class="fa fa-comments"></i>
											<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
										</a>
										<a href="javascript:void(0);" class="like" title="' . $views . '">
											<i class="fa fa-heart"></i>
											<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
										</a>
									</footer>';			
			} else {				
				$return_string .= '<section class="post-content">
										<h2 class="post-heading">'. get_the_title() .'</h2>
										<div class="post-meta">
											<span class="author">
												<i class="fa fa-user"></i>
												<a href="#" title="' . get_the_author() . '"> ' . get_the_author() . ' </a>
											</span>
											<span class="post-date">
												<i class="fa fa-calendar"></i>
												<a href="'. esc_url(get_permalink()) .'" title="' . $postdate . '"> ' . get_the_date() . ' </a>
											</span>
										</div>
										<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 25 )) . ' <span class="text-muted"></span></p>
									</section>
									<footer class="post-footer">
										<a href="'. esc_url(get_permalink()) .'" title="' . $readmoretxt . '" class="btn btn-default btn-sm"> ' . $readmoretxt . ' </a>
										<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . $postcomments . '" class="comments">
											<i class="fa fa-comments"></i>
											<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
										</a>
										<a href="javascript:void(0);" class="like" title="' . $views . '">
											<i class="fa fa-heart"></i>
											<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
										</a>
									</footer>';
			}
			
			$return_string .= '</article>
								</div>';
		$counter = $counter + 1;	
	
	endwhile;
	endif;
	
	$return_string .= '</div>';
	
	wp_reset_postdata();
	
	if($link != ''){
		$return_string .= '<div class="view-more ' . $animation . '">
								<a class="btn btn-primary btn-xl with-icon" title="' . $blogbutton . '" href="' . $link . '"> ' . $blogbutton . '
								<i class="fa fa-comments"></i>
							</a>
							</div>';
	}
	
	$return_string .= '</div></section>';
	
	return $return_string;	

}



/*------------------------------------------------------
Insperia Services With Image
-------------------------------------------------------*/
function insperia_services_with_image($atts, $content = null) {
	extract(shortcode_atts(array('image' => '' , 'title' => '' , 'description' => ''), $atts));

	$getimageurlarray = wp_get_attachment_image_src( $image , 'full');
	
	if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
	
	return '<div class="thumbnail">
				<img alt="image" src="' . esc_url($getimageurl) . '">
				<div class="caption">
					<h4 class="strong">' . esc_attr($title) . '</h4>
					<p>' . esc_attr($description) . '</p>
				</div>
			</div>';		
}





/*------------------------------------------------------
Insperia Button
-------------------------------------------------------*/
function insperia_button($atts, $content = null) {
	extract(shortcode_atts(array('background' => '' , 'color' => '' , 'border' => '' , 'link' => '' , 'title' => '' , 'icon' => '' , 'size' => '' , 'iconoption' => ''), $atts));
	
	if($iconoption == 'yes') {$iconhtml = '<i class="fa fa-' . $icon . '"></i>';} else {$iconhtml = '';}
	
	return '<a style="background:' . $background . '; color:' . $color . '; border:1px solid ' . $border . ';" class="btn btn-primary btn-' . $size . ' with-icon" title="' . $title . '" href="' . $link . '"> ' . $title . ' ' . $iconhtml . ' </a>';
	
}





/*------------------------------------------------------
Insperia Products - Shortcode
-------------------------------------------------------*/
function insperia_products_four_col( $atts, $content = null ) {
	extract(shortcode_atts(array('noofposts' => '8'), $atts));
	if (class_exists('Woocommerce')) {	
	
	global $prof_default;
	global $woocommerce;
	global $woocommerce_loop;

	$return_string = '';

	$cat_count = 1;	
	$loop = new WP_Query(array('post_type' => 'product', 'order' => 'DESC' , 'posts_per_page' => $noofposts));
	$return_string .= '<div class="woocommerce"><div class="shop insperia-shop-home"><div class="col-lg-12"><ul class="products">';

	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();

			$sale_text = __("Sale!","sentient");
			
			if((get_post_meta( get_the_ID(), '_sale_price', true) != get_post_meta( get_the_ID(), '_regular_price', true) && get_post_meta( get_the_ID(), '_sale_price', true) == get_post_meta( get_the_ID(), '_price', true))){
				$sale = '<span class="onsale">' . $sale_text . '</span>';
			} else {
				$sale = '';
			}							
			
			$product_content = '<a class="add-to-cart-btn button add_to_cart_button product_type_simple added" data-product_sku="" data-product_id="' . get_the_ID() . '" rel="nofollow" href="' . do_shortcode('[add_to_cart_url id="' . get_the_ID() . '"]') . '">Add to cart</a>';
			
			$insperia_currency_sale = get_woocommerce_currency_symbol();
			$insperia_get_variation_id = get_post_meta( get_the_ID(), '_min_price_variation_id', true );
			$insperia_currency_sale = get_woocommerce_currency_symbol();
			$fromText = __("From: " , "sentient");
			
			$return_string .= '
			<li class="product">
				<a href="' . get_permalink() . '">
					' . $sale . '
				</a>
				<div class="product-wrap">
					<a href="' . get_permalink() . '">
						' . get_the_post_thumbnail(get_the_ID() , array(292,9999)) . '
					</a>
					' . $product_content . '
				</div>
				<a href="' . get_permalink() . '">
					<h3>' . get_the_title() . '</h3>
					<span class="price">';
					
					if( $insperia_get_variation_id != '' ) {
						$return_string .= '<ins><span class="amount">' . $fromText . $insperia_currency_sale . get_post_meta( $insperia_get_variation_id, '_price', true ) . '</span></ins>';
					} else {
						$insperia_sale = get_post_meta( get_the_ID(), '_sale_price', true);
					
						if($insperia_sale == ''){
							$insperia_price = '<ins><span class="amount">' . $insperia_currency_sale . get_post_meta( get_the_ID(), '_regular_price', true) . '</span></ins>';
							$return_string .= $insperia_price;
						} else {
							$insperia_price = '<del><span class="amount">' . $insperia_currency_sale . get_post_meta( get_the_ID(), '_regular_price', true) . '</span></del>';
							$return_string .= $insperia_price . '<ins><span class="amount">' . $insperia_currency_sale . get_post_meta( get_the_ID(), '_sale_price', true) . '</span></ins>';
						}
					}
					
					$return_string .= '</span>
				</a>			
			</li>';
	endwhile;
	endif;
	wp_reset_postdata();	
	
	$return_string .= '</ul></div></div></div>';
	} else {$return_string = '';}
	
   return $return_string;	


}



/*------------------------------------------------------
Insperia Portfolio Full Slider
-------------------------------------------------------*/
function insperia_portfolio_full_slider($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6'), $atts));
	
	$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $number));

	$return_string = '<div id="fullwidth" class="util-carousel fullwidth">';

	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();


	$return_string .= '<div class="item">
							<div class="meida-holder">
								' . get_the_post_thumbnail( get_the_ID() ,  'insperia-blog-small' ) . '
							</div>
							<div class="hover-content">
								<div class="overlay"></div>
								<div class="link-contianer">
									<a href="'. esc_url(get_permalink()) .'" >
										<i class="fa fa-link"></i>
									</a>
									<a href="' . wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ) . '" class="img-link zoom">
										<i class="fa fa-search"></i>
									</a>
								</div>
								<div class="detail-container">
									<h4>' . get_the_title() . '</h4>
									<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
								</div>
							</div>
						</div>';
	endwhile;
	endif;		
	
	$return_string .= '</div>';

	wp_reset_postdata();	
	
   return $return_string;	
}



/*------------------------------------------------------
Insperia Portfolio
-------------------------------------------------------*/
function insperia_portfolio_slider($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' ,'title' => '' , 'link' => '' , 'animation' => '' , 'portbutton' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $number));

	$return_string = '<div class="container">';
	
	if($link != ''){
		$return_string .= '<a href="' . esc_url($link) . '" class="btn btn-default btn-line pull-right" title="' . esc_attr($portbutton) . '">' . esc_attr($portbutton) . '</a>';
	}
	
	if($title != ''){
		$return_string .= '<h4 class="strong short-line">' . esc_attr($title) . '</h4>';
	}
						
	$return_string .= '<div class="row">
						<div class="col-lg-12">
						<div id="util-carousel-portfolio" class="util-carousel portfolio-list">';
	$portID = 0;
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();

	$count=1;		
	$imageURL = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
	$portID = $portID + 1;
	$return_string .= '
				<div class="item">
					<div class="meida-holder">
						' . get_the_post_thumbnail( get_the_ID() ,  'insperia-portfolio-thumb' ) . '
						<div class="hover-content">
							<div class="link-contianer">
							
								<a href="' . $imageURL .'" class="img-link zoom"><i class="fa fa-search"></i></a>
							</div>
						</div>
					</div>
					<div class="detail-container">
						<h4><a href="'. esc_url(get_permalink()) .'">' . get_the_title() . '</a></h4>
						<p>
							' . strip_shortcodes(wp_trim_words( get_the_excerpt(), 5 )) . '
						</p>
					</div>
				</div>';
	endwhile;
	endif;		
	
	$return_string .= '</div></div></div></div>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}




/*------------------------------------------------------
Insperia Portfolio Style 2
-------------------------------------------------------*/
function insperia_portfolio_styletwo($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6'), $atts));
	
	$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $number));
	
	
	$return_string = '<div>';

	$portID = 0;
	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();

	$return_string .= '
				<div class="col-lg-6 col-sm-6">
					<div class="portfolio-item zoom thumbnail">
						' . get_the_post_thumbnail( get_the_ID() ,  'insperia-portfolio-thumb' ) . '
						<a title="' . get_the_title() . '" data-lightbox-gallery="gallery1" class="zoom" href="' . wp_get_attachment_url( get_the_post_thumbnail(get_the_ID()) ) .'">
							<i class="fa fa-plus"></i>
						</a>
						<a title="' . get_the_title() . '" class="link" href="'. esc_url(get_permalink()) .'">
							<i class="fa fa-link"></i>
						</a>
						<a title="Like this project" href="javascript:void(0);" class="like">
							<i class="fa fa-heart"></i>
							<span>' . getPostViews(get_the_ID()) . '</span>
						</a>
						<h3>' . get_the_title() . '<small>' . strip_shortcodes(wp_trim_words( get_the_excerpt(), 5 )) . '</small></h3>
					</div>
				</div>';
	endwhile;
	endif;		
	
	$return_string .= '</div>';

	wp_reset_postdata();	
	
   return $return_string;	
}



/*------------------------------------------------------
Insperia Portfolio
-------------------------------------------------------*/
function insperia_portfolio($atts, $content = null) {
	extract(shortcode_atts(array('number' => '6' , 'link' => '' , 'animation' => '' , 'portbutton' => ''), $atts));
	
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $number));
			
	$terms = get_terms("portfoliocategories");
	$count = count($terms); 
	$AllString = __("All" , "sentient");
	$cat_string = '<li class="active"> <a href="" class="all" title="' . $AllString . '"> ' . $AllString . ' </a> </li>';
	if ( $count > 0 ){  
	  
		foreach ( $terms as $term ) {  
			if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
				$termname = strtolower($term->name);  
				$termname = str_replace(' ', '-', $termname);  
				$cat_string .= '<li> <a href="" class="'.$termname.'" title="'.$term->name.'"> '.$term->name.' </a> </li>';  
			}
		}  
	}  		
	
	
	$return_string = '<section class="home-folio">
		<div class="filter-options">
			<div class="container">
				<ul class="options-list wow fadeInUp">
					' . $cat_string . '
				</ul>
			</div>
		</div>
		<div class="container">
			<ul class="portfolio">';


	$portID = 0;

	
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
	$terms = get_the_terms( get_the_ID() , 'portfoliocategories' );  
	$separator = ' ';
	$output = '';
	$count=1;
	if ( $terms && ! is_wp_error( $terms ) ) {   
		foreach ( $terms as $term )   
		{  
			if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
				$termname = strtolower($term->name);  
				$termname = str_replace(' ', '-', $termname); 			
				$output .= $termname . ' ';
			}
			
			$count = $count + 1;
		} 
		
	} else {   
	   $output = '';
	}			
	
	$portID = $portID + 1;
	$return_string .= '
				<li class="portfolio-item" data-id="id-' . $portID . '" data-type="' . $output . '">
					' . get_the_post_thumbnail( get_the_ID() ,  'insperia-portfolio-thumb' ) . '
					<a href="' . wp_get_attachment_url( get_the_post_thumbnail(get_the_ID()) ) .'" class="zoom"  data-lightbox-gallery="gallery1" title="' . get_the_title() . '">
						<i class="fa fa-plus"></i>
					</a>
					<a href="'. esc_url(get_permalink()) .'" class="link" title="' . get_the_title() . '">
						<i class="fa fa-link"></i>
					</a>
					<a class="like" href="" title="Like this project">
						<i class="fa fa-heart"></i>
						<span>' . getPostViews(get_the_ID()) . '</span>
					</a>
					<h3>' . get_the_title() . '<small>' . strip_shortcodes(wp_trim_words( get_the_excerpt(), 15 )) . '</small></h3>
				</li>';
	endwhile;
	endif;		
	
	$return_string .= '</ul>';

	if($link != ''){
		$return_string .= '<div class="view-more ' . $animation . '"> <a class="btn btn-primary btn-xl with-icon" title="' . $portbutton . '" href="' . $link . '"> ' . $portbutton . ' <i class="fa fa-briefcase"></i> </a> </div>';
	}

	$return_string .= '</div></section>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}



	

/*------------------------------------------------------
Insperia Testimonial
-------------------------------------------------------*/
function insperia_testimonial($atts, $content = null) {
	extract(shortcode_atts(array('number' => '3' , 'animation' => ''), $atts));

	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}		
	
	$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => $number));
	
	$return_string = '
	<div class="testimonials ' . $animation . '">
		<div class="flexslider">
			<ul class="slides">';
			
	if ( $loop ) :   
	while ( $loop->have_posts() ) : $loop->the_post();
	
	if(get_post_meta(get_the_ID(), 'Person Company', true) == ''){
		$atString = __("" , "sentient");
	} else {
		$atString = __("at" , "sentient");
	}		
	
	$return_string .= '<li>
					<div class="insperia-single-testimonial">
					<span class="doner">
						<a target="_blank" href="'. esc_url(get_permalink()) .'" class="thumb">
							' . get_the_post_thumbnail( get_the_ID() ,  'insperia-testimonial-thumb' ) . '
						</a>
						<span class="name">
							<strong>' . get_the_title() . '</strong> <br>
							<cite title="' . esc_attr(get_post_meta(get_the_ID(), 'Person Position', true)) . '">' . esc_attr(get_post_meta(get_the_ID(), 'Person Position', true)) . ' <br> ' . $atString . ' ' . esc_attr(get_post_meta(get_the_ID(), 'Person Company', true)) . '</cite>
						</span>
					</span>
					<blockquote>
						<p>' . get_the_content() . '</p>
					</blockquote>
					</div>
				</li>';
	endwhile;
	endif;		
	
	$return_string .= '</ul>
		</div>
	</div>';
			
	wp_reset_postdata();	
	
   return $return_string;	
}


	

/*------------------------------------------------------
Insperia Animated Numbers
-------------------------------------------------------*/
function insperia_animated_numbers($atts, $content = null) {
	extract(shortcode_atts(array('number' => '5000' , 'title' => 'Title Goes Here' , 'icon' => '', 'animation' => '', 'circlebg' => '', 'iconcolor' => '', 'titlecolor' => '', 'numbercolor' => ''), $atts));

	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
			
	return '<div class="fun-facts">
				<div class="fact ' . $animation . '">
					<i style="background:' . $circlebg . '; color:' . $iconcolor . ';" class="fa fa-' . $icon . '"></i>
					<p class="lead" style="color:' . $titlecolor . ';">' . esc_attr($title) . '</p>
					<h2 class="stronger fact" data-perc="' . esc_attr($number) . '"><span style="color:' . $numbercolor . ';" class="factor">0</span></h2>
				</div>
			</div>';
}




	
/*------------------------------------------------------
Insperia Contact Details
-------------------------------------------------------*/
function insperia_contact_details($atts, $content = null) {
	extract(shortcode_atts(array('addressphone' => '' ,'detailstitle' => '' ,'companyname' => '' , 'addressone' => '' , 'addresstwo' => '' , 'phone' => '' , 'email' => '' , 'website' => '', 'phonetwo' => ''), $atts));
	$char = __("P:" , "sentient");
	$chartwo = __("Contact Details" , "sentient");
	
	
	if($addressphone == ''){
		$upperphone = '';
	}else{
		$upperphone = '<abbr title="Phone">' . $char . '</abbr> ' . esc_attr($phone);
	}
	
	if($phone == ''){
		$phonetext = '';
	}else{
		$phonetext = '<abbr title="Phone"><i class="fa fa-phone"></i>:</abbr> ' . esc_attr($phone) . '<br>';
	}
	
	
	if($phonetwo == ''){
		$phonetwotext = '';
	}else{
		$phonetwotext = '<abbr title="Phone"><i class="fa fa-phone"></i>:</abbr> ' . esc_attr($phonetwo) . '<br>';
	}	
	
	if($email == ''){
		$emailtext = '';
	}else{
		$emailtext = '<abbr title="Email"><i class="fa fa-envelope-o"></i>:</abbr> <a href="mailto:' . esc_attr($email) . '">' . esc_attr($email) . '</a><br>';
	}	
	
	if($website == ''){
		$websitetext = '';
	}else{
		$websitetext = '<abbr title="Website"><i class="fa fa-globe"></i>:</abbr> <a href="' . esc_url($website) . '">' . esc_url($website) . '</a>';
	}		
	
	if($detailstitle == ''){
		$detailstitletext = '';
	}else{
		$detailstitletext = '<strong>' . $detailstitle .'</strong><br>';
	}		
	
	if($companyname == ''){
		$companynametext = '';
	}else{
		$companynametext = '<strong>' . esc_attr($companyname) . '</strong><br>';
	}		
	
	if($addressone == ''){
		$addressonetext = '';
	}else{
		$addressonetext = esc_attr($addressone) . '<br>';
	}			
	
	if($addresstwo == ''){
		$addresstwotext = '';
	}else{
		$addresstwotext = esc_attr($addresstwo) . '<br>';
	}		
	
	if($addresstwo == ''){
		$addresstwotext = '';
	}else{
		$addresstwotext = esc_attr($addresstwo) . '<br>';
	}			
	
	$return_string = '
	<aside class="contact-details">
				<address>
				  ' . $companynametext . '
				  ' . $addressonetext . '
				  ' . $addresstwotext . '
				  ' . $upperphone . '
				</address>
				
				<address>
				  ' . $detailstitletext . '
				  ' . $phonetext . '
				  ' . $phonetwotext . '
				  ' . $emailtext . '
				  ' . $websitetext . '
				</address>
	</aside>';
		
		return $return_string;
}



/*------------------------------------------------------
Insperia Icons
-------------------------------------------------------*/
function insperia_icons($atts, $content = null) {
	extract(shortcode_atts(array('iconstyle' => '' , 'text' => 'Content Goes Here' , 'title' => 'Title Goes Here' , 'link' => '#' , 'linktext' => 'Read More' , 'icon' => ''), $atts));
	$return_string = '<div class="service ' . $iconstyle . '">
		<i class="fa fa-' . $icon . ' icon"></i>
		<h5 class="service-header">' . esc_attr($title) . '</h5>
		<p>' . esc_attr($text);
		
		if($iconstyle == 'style4' || $iconstyle == 'style3'){
			$return_string .= '<br><a href="' . esc_url($link) . '" title="' . esc_attr($title) . '">' . esc_attr($linktext) . ' <i class="fa fa-chevron-right"></i></a></p>';
		}
		
		$return_string .= '</div>';
		
		return $return_string;
}




/*------------------------------------------------------
Insperia Underlined
-------------------------------------------------------*/
function insperia_heading_underlined($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'stronger' => '' , 'color' => '' , 'animation' => '', 'size' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = '';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<h4 style="color:' . $color . '; font-size:' . $size . ' !important;" class="' . $stronger . ' wow ' . $animation . ' short-line">' . esc_attr($text) . '</h4>';
}
	

/*------------------------------------------------------
Insperia  Pricing Table
-------------------------------------------------------*/
function insperia_pricing_table($atts, $content = null) {
	extract(shortcode_atts(array('planname' => '' , 'ribbon' => '' , 'color' => '' , 'currency' => '' , 'amount' => '' , 'period' => '' , 'desc' => '' , 'tablecontent' => base64_encode( '' ) , 'link' => '' , 'buttonname' => ''), $atts));

	if($ribbon != '') {$ribbon = '<p class="ribbon">' . $ribbon . '</p>';} else {$ribbon = '';}
	$getContent = htmlentities( rawurldecode( base64_decode(  $tablecontent  ) ), ENT_COMPAT, 'UTF-8' );

	return '
		<div class="plans">
			<div class="header" style="background:' . $color . ';">
				<div class="title"> ' . $planname . ' '. $ribbon . '</div>
				<div class="price">
					<h3>' . $currency . '<span>' . $amount . '</span>/' . $period . '</h3>
					<small>' . $desc . '</small>
				</div>
			</div>
			<div class="features-list">
			  <ul class="features">
				' . html_entity_decode($getContent) . '
			  </ul>
			</div>
			<div class="footer">
				<a class="btn btn-primary" href="' . $link . '">' . $buttonname . '</a>
			</div>
		</div>';
}




/*------------------------------------------------------
Insperia List Items
-------------------------------------------------------*/
function insperia_list_item($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'icon' => '', 'color' => '', 'iconcolor' => '' , 'rotate' => ''), $atts));

	if($rotate == 'yes') {$rotate = 'fa-spin';} else {$rotate = '';}

	return '
			<ul class="list insperia-list">
				<li style="color:' . $color . ';"><i style="color:' . $iconcolor . ';" class="fa fa-' . $icon . ' ' . $rotate . '"></i> ' . esc_attr($text) . '</li>
			</ul>';
}



/*------------------------------------------------------
Insperia H6
-------------------------------------------------------*/
function insperia_heading_six($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'stronger' => '' , 'color' => '' , 'align' => '' , 'animation' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = '';}
	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<h6 style="color:' . $color . '" class="' . $stronger . ' ' . $align . ' ' . $animation . '">' . esc_attr($text) . '</h6>';
}





/*------------------------------------------------------
Insperia H5
-------------------------------------------------------*/
function insperia_heading_five($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'stronger' => '' , 'align' => '' , 'animation' => '' , 'color' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = '';}
	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<h5 style="color:' . $color . '" class="' . $stronger . ' ' . $align . ' ' . $animation . '">' . esc_attr($text) . '</h5>';
}



/*------------------------------------------------------
Insperia H4
-------------------------------------------------------*/
function insperia_heading_four($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'stronger' => '' , 'align' => '' , 'animation' => '' , 'color' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = '';}
	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<h4 style="color:' . $color . '" class="' . $stronger . ' ' . $align . ' ' . $animation . '">' . esc_attr($text) . '</h4>';
}




/*------------------------------------------------------
Insperia H3
-------------------------------------------------------*/
function insperia_heading_three($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'stronger' => '' , 'align' => '' , 'animation' => '' , 'color' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = '';}
	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<h3 style="color:' . $color . '" class="' . $stronger . ' ' . $align . ' ' . $animation . '">' . esc_attr($text) . '</h3>';
}




/*------------------------------------------------------
Insperia H2
-------------------------------------------------------*/
function insperia_heading_two($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'stronger' => '' , 'align' => '' , 'animation' => '' , 'color' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = '';}
	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<h2 style="color:' . $color . '" class="' . $stronger . ' ' . $align . ' ' . $animation . '">' . esc_attr($text) . '</h2>';
}




/*------------------------------------------------------
Insperia H1
-------------------------------------------------------*/
function insperia_heading_one($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'stronger' => '' , 'align' => '' , 'animation' => '' , 'color' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = 'strong';}
	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<h1 style="color:' . $color . '" class="' . $stronger . ' ' . $align . ' ' . $animation . '">' . esc_attr($text) . '</h1>';
}



/*------------------------------------------------------
Insperia Clients - Shortcode
-------------------------------------------------------*/
function insperia_clients($atts, $content = null) {
	
	extract(shortcode_atts(array('images' => ''), $atts));

	$returnedvalue = '';
	$splitImagesArray = explode(",", $images);
	$splitImagesArraySize = count($splitImagesArray);
	$getimageurlarray = '';
	$returnedvalue .= '<div id="logo-showcase-gray" class="util-carousel logo-showcase-gray">';		
	
	for ($x=0; $x < $splitImagesArraySize; $x++)
	{
		$getimageurlarray = wp_get_attachment_image_src( $splitImagesArray[$x] , 'full');

		$returnedvalue .= '
		<div class="item">
			<a href="' . $getimageurlarray[0] . '"><img src="' . $getimageurlarray[0] . '" alt="Image" /></a>
		</div>';

	} 

	
	$returnedvalue .='</div>';
	
	return $returnedvalue;	

}




/*------------------------------------------------------
Insperia Heading with Icon
-------------------------------------------------------*/
function insperia_heading_icon($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'H1 Heading' , 'icon' => '' , 'stronger' => '' , 'align' => '' , 'animation' => '' , 'color' => '', 'size' => '', 'iconcolor' => ''), $atts));

	if($stronger == 'yes') {$stronger = 'stronger';} else {$stronger = 'strong';}
	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
		
	return '<h3 style="color:' . $color . '; font-size:' . $size . ' !important;" class="' . $stronger . ' ' . $align . ' styled-header ' . $animation . '">
				' . esc_attr($text) . '
				<span class="header-style">
					<i style="color:' . $iconcolor . ';" class="fa fa-' . $icon . '"></i>
				</span>
			</h3>';
}

	

	
/*------------------------------------------------------
Insperia Text
-------------------------------------------------------*/
function insperia_text($atts, $content = null) {
	extract(shortcode_atts(array('text' => 'Text Goes Here' , 'color' => '', 'align' => '' , 'animation' => ''), $atts));

	if($align == 'left') {$align = 'text-left';} elseif($align == 'right') {$align = 'text-right';} else {$align = 'text-center';}
	if($animation == 'up') {$animation = 'wow fadeInUp';} elseif($animation == 'down') {$animation = 'wow fadeInDown';} elseif($animation == 'left') {$animation = 'wow fadeInLeft';} elseif($animation == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	
	return '<p style="color:' . $color . ';" class="' . $align . ' ' . $animation . '">' . $text . '</p>';
}





/*------------------------------------------------------
Insperia Homepage Row End - ShortCode
-------------------------------------------------------*/
function insperia_homepage_container_end($atts, $content = null) {
	extract(shortcode_atts(array('borderbottom' => ''), $atts));
	if($borderbottom == 'yes'){$bottom = '<hr class="xsmall">';}else{$bottom = '';}
   return '</div></div>' . $bottom;
}


/*------------------------------------------------------
Insperia Homepage Row Wide Start - Shortcode
-------------------------------------------------------*/
function insperia_homepage_container_wide($atts, $content = null) {
	
	extract(shortcode_atts(array('type' => '','repeat' => 'yes', 'background' => '', 'color' => '#ffffff' , 'bordertop' => 'no' , 'font' => '#666666' , 'paddingtop' => '40px' , 'paddingbottom' => '40px'), $atts));
	
	if($bordertop == 'yes'){$top = '<hr class="xsmall">';}else{$top = '';}
	
	if($repeat == 'yes'){$getrepeat = 'repeat'; $backcover = 'auto';}else{$getrepeat = 'no-repeat'; $backcover = 'cover';}

	if($type == 'yes'){
		return $top . '<div class="homepage-container-design homepage-container-design-wide" style="background:'. $color .'; color:'. $font .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .';">
			<div class="homepage-container-design-inner">';
	}
	else
	{
		$getimageurlarray = wp_get_attachment_image_src( $background , 'full');
		if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
		return $top . '<div class="homepage-container-design homepage-container-design-wide" style="background-image:url('. $getimageurl .');color:'. $font .';background-repeat:'. $getrepeat .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .'; background-size:'. $backcover .';">
			<div class="homepage-container-design-inner">';
	}

}


/*------------------------------------------------------
Insperia Page Section - Shortcode
-------------------------------------------------------*/
function insperia_page_section( $atts, $content = null ) {
	extract(shortcode_atts(array('id' => ''), $atts));

	return '<div id="' . $id . '"></div>';		

}

/*------------------------------------------------------
Insperia Homepage Row Start - Shortcode
-------------------------------------------------------*/

function insperia_homepage_container($atts, $content = null) {
	
	extract(shortcode_atts(array('type' => '','repeat' => 'yes', 'backgroundsize' => '' , 'backgroundposition' => '' , 'background' => '', 'color' => '#ffffff' , 'bordertop' => 'no' , 'font' => '#666666' , 'paddingtop' => '40px' , 'paddingbottom' => '40px' , 'parallax' => ''), $atts));
	
	if($bordertop == 'yes'){$top = '<hr class="xsmall">';}else{$top = '';}
	
	if($repeat == 'yes'){$getrepeat = 'repeat';}else{$getrepeat = 'no-repeat';}
	
	if($parallax == 'yes'){$makeItParallax = 'make-it-parallax';} else {$makeItParallax = '';}
	
	$returnedvalue = '';
	
	if($type == 'yes'){
		$returnedvalue = $top . '<div class="homepage-container-design" style="background:'. $color .'; color:'. $font .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .';">
			<div class="homepage-container-design-inner">';
	}
	else
	{
		$getimageurlarray = wp_get_attachment_image_src( $background , 'full');
		if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
		$returnedvalue = $top . '<div class="homepage-container-design ' . $makeItParallax . '" style="background-image:url('. $getimageurl .');color:'. $font .';background-repeat:'. $getrepeat .'; padding-top:'. $paddingtop .'; padding-bottom:'. $paddingbottom .'; background-size:' . $backgroundsize . '; background-position:' . $backgroundposition . ';">
			<div class="homepage-container-design-inner">';
	}

		return $returnedvalue;

}
	

?>