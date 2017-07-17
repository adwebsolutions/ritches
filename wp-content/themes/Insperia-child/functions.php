<?php
/**
 * Insperia Functions Library
 * Here we will define all functions that will be used on Insperia Child Theme.
 */


/******************************************/ 
/* Add your functions after this */
/******************************************/ 
function post_types_unregister (){
    $result = true;
    $result = unregister_post_type('services');
    if($result) $result = unregister_post_type('duties');
    if($result) $result = unregister_post_type('skills');
    if($result) $result = unregister_post_type('team');
    if($result) $result = unregister_post_type('portfolio');
    if($result) $result = unregister_post_type('testimonial');
    return $result;
 }
function testimonial_register () {
    $labels = array(
        'name'                  => __( 'Testimonial', 'Insperia-child' ),
        'singular_name'         => __( 'Testimonial', 'Insperia-child' ),
        'menu_name'             => __( 'Testimonials', 'admin menu', 'Insperia-child' ),
        'add_new'               => __( 'Add New', 'testimonial','Insperia-child' ),
        'add_new_item'          => __( 'Add New Testimonial', 'Insperia-child' ),
        'edit_item'             => __( 'Edit Testimonials', 'Insperia-child' ),
        'new_item'              => __( 'New Testimonials', 'Insperia-child' ),
        'view_item'             => __( 'View Testimonials', 'Insperia-child' ),
        'all_items'             => __( 'All Testimonials', 'Insperia-child' ),
        'search_items'          => __( 'Search Testimonials', 'Insperia-child' ),
        'not_found'             => __( 'No Testimonials Found', 'Insperia-child' ),
        'not_found_in_trash'    => __( 'No Testimonials Found In Trash', 'Insperia-child' ),
        'parent_item_colon'     => '',
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'testimonial'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array( 'title','editor')
    );
    register_post_type('testimonial', $args);
}
function testimonial_filter()
{
    register_taxonomy(
        __( "testimonial-cat" ),
        array(__( "testimonial")),
        array(
            "hierarchical" => true,
            "label" => __( "Categories",'Insperia-child' ),
            "singular_label" => __( "Category",'Insperia-child' ),
            "query_var" => true,
            "rewrite" => array(
                'slug' => 'testimonial-cat',
                'hierarchical' => true
            )
        )
    );
} // function: products_filter END
function testimonial_meta_box (){

    require_once ( dirname( __FILE__ )."/meta-box-class/my-meta-box-class.php");
    if (is_admin()) {
        $prefix = 'ba_';
        /*
         * configure your meta box
         */
        $config = array(
            'id'             => 'custom_meta_box_before',          // meta box id, unique per meta box
            'title'          => 'Box Before Information',          // meta box title
            'pages'          => array('testimonial'),      // post types, accept custom post types as well, default is array('post'); optional
            'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
            'priority'       => 'high',            // order of meta box: high (default), low; optional
            'fields'         => array(),            // list of meta fields (can be added by field arrays)
            'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
            'use_with_theme' => get_stylesheet_directory_uri() . '/meta-box-class'          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
        );
        /*
         * Initiate your meta box
         */
        $custom_meta1 =  new AT_Meta_Box($config);
        //$custom_meta1->addTextarea($prefix.'text_before_id',array('name'=> __('Text Before','Insperia-child'),'desc' =>__('Text before treatment','Insperia-child')));
        $custom_meta1->addImage($prefix.'image_before_id',array('name'=> __('Upload Image','Insperia-child'),'desc' =>__('Image before treatment','Insperia-child')));
        $custom_meta1->Finish();

        $config = array(
            'id'             => 'custom_meta_box_after',          // meta box id, unique per meta box
            'title'          => 'Box After Information',          // meta box title
            'pages'          => array('testimonial'),      // post types, accept custom post types as well, default is array('post'); optional
            'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
            'priority'       => 'high',            // order of meta box: high (default), low; optional
            'fields'         => array(),            // list of meta fields (can be added by field arrays)
            'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
            'use_with_theme' => get_stylesheet_directory_uri() . '/meta-box-class'          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
        );
        /*
         * Initiate your meta box
         */
        $custom_meta2 =  new AT_Meta_Box($config);
       // $custom_meta2->addTextarea($prefix.'text_after_id',array('name'=> __('Text After','Insperia-child'),'desc' =>__('Text after treatment','Insperia-child')));
        $custom_meta2->addImage($prefix.'image_after_id',array('name'=> __('Upload Image','Insperia-child'),'desc' =>__('Image after treatment','Insperia-child')));
        $custom_meta2->Finish();
    }
}
function ic_format_color( $color ='' ) {
    if(strstr($color,'rgba')){
        return $color;
    }

    $hex = trim( str_replace( '#', '', $color ) );
    if(empty($hex))
        return '';

    if ( strlen( $hex ) == 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }

    if ( $hex ){
        if ( ! preg_match( '/^#[a-f0-9]{6}$/i', $hex ) ) {
            return '#' . $hex;
        }
    }
    return '';
}
function theme_enqueue_styles() {
    wp_dequeue_script('insperia-custom');
    wp_enqueue_style('insperia-custom', get_template_directory_uri().'/insperia-styles.css');
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'insperia-custom' ) );
}
function theme_enqueue_script() {
    wp_enqueue_script( 'custom-nav', get_stylesheet_directory_uri() . '/assets/custom_nav.js', array( 'jquery' ),'1.0',true);
    wp_enqueue_script( 'custom-ajax', get_stylesheet_directory_uri() . '/assets/custom_ajax.js', array( 'jquery' ),'1.0',true);
}
function place_ajax() {
    wp_localize_script( 'custom-ajax', 'ic_theme_ajax', array(
        'ajax' => admin_url( 'admin-ajax.php' ),
        'ismobile' => wp_is_mobile(),
        'home' => home_url(),
        'nonce' => wp_create_nonce( 'ajax-nonce' ),
    ));
}
function __call_filter_testimonial_terms () {
    $term_id = $_POST[ 'term' ];
    $columns = (isset($_POST[ 'columns' ]))? $_POST[ 'columns' ] : '2';
    $args = array (
        'posts_per_page' => -1,
        'post_type'      => 'testimonial',
        'post_status'    => 'publish',
        'meta_query'     => array()
    );
    if(isset($term_id)&&($term_id !== '-1'))
        $args['tax_query']= array(
            array(
                'taxonomy' => 'testimonial-cat',
                'field' => 'term_id',
                'terms'    => $term_id,
                'operator' => 'IN'
            )
        );

    $query = new WP_Query( $args );

    if( $query->have_posts() ) :
        $c = 0;
        $class = 'testimonial-item col-'.$columns;
        while( $query->have_posts() ): $query->the_post();
            $c++;
            $cat = wp_get_post_terms($query->post->ID,'testimonial-cat',array('fields'=>'slugs'))[0];
            $class .= ' '.$cat;
            if ($c == $columns ):
                $class .= ' last';
                $c = 0;
            endif;
            $img_before = get_post_meta($query->post->ID,'ba_image_before_id')[0];
            $img_after = get_post_meta($query->post->ID,'ba_image_after_id')[0];
            ?>
            <div class="<?php echo $class?>">
                <div class="testimonial-box">
                    <?php echo get_image_tag($img_before['id'],'Before','Before','center','full');?>
                    <h2><?php echo $query->post->post_title; ?></h2>
                    <span>ANTES</span>
                    <p><?php echo $query->post->post_content;?></p>
                </div>
                <div class="testimonial-box">
                    <?php echo get_image_tag($img_after['id'],'After','After','center','full');?>
                    <h2><?php echo $query->post->post_title; ?></h2>
                    <span>DESPUÉS</span>
                    <p><?php echo $query->post->post_content;?></p>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;

    die();
}
function vc_before_init_actions() {
    require( dirname(__FILE__).'/vc-elements/wc_testimonial_box.php' );
}
function hide_stock () {
    return '';
}
function product_widgets_init() {
    register_sidebar( array(
        'name' => 'Product Detail Sidebar',
        'id' => 'product_detail_sidebar',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );

}
/******************************************/ 
/* Add your functions before this */
/******************************************/ 


add_action('after_setup_theme', 'insperia_child_setup' , 99);

function insperia_child_setup()
{
    add_action('wp_enqueue_scripts', 'theme_enqueue_styles', PHP_INT_MAX);
    add_action('wp_enqueue_scripts', 'theme_enqueue_script');

    add_action('init', 'post_types_unregister');
    add_action('init', 'testimonial_register');
    add_action('init', 'testimonial_filter');

    remove_action('save_post', 'insperia_save_testimonial_post_format_person_position', 10);
    remove_action('admin_menu', 'insperia_testimonial_post_format_person_position', 10);

    remove_action('save_post', 'insperia_save_testimonial_post_format_person_company', 10);
    remove_action('admin_menu', 'insperia_testimonial_post_format_person_company', 10);
    /*remove_meta_box('insperia-test-position-box','testimonial','normal');
    remove_meta_box('insperia-test-company-box','testimonial','normal');*/
    add_action('admin_menu', 'testimonial_meta_box');
    add_action('save_post', 'testimonial_meta_box', 10, 2);

    if (defined('WOOCOMMERCE_VERSION')) {
        include_once(dirname(__FILE__) . '/wc-brand/wc-brand.php');
    }

    add_action('vc_before_init', 'vc_before_init_actions');

    add_action('wp_footer', 'place_ajax');
    add_action('wp_ajax_nopriv___call_filter_testimonial_terms', '__call_filter_testimonial_terms');
    add_action('wp_ajax_filter___call_filter_testimonial_terms', '__call_filter_testimonial_terms');

    add_filter('woocommerce_get_stock_html', 'hide_stock');

    //remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    add_action( 'widgets_init', 'product_widgets_init' );
}

?>