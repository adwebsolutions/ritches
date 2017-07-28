<?php
/*
Element Description: WP Testimonial Box
*/

// Element Class
class WP_Blog_Box extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'wp_blog_box_mapping' ) );
        add_shortcode( 'wp_blog_box', array( $this, 'wp_blog_box_html' ) );
    }

    // Element Mapping
    public function wp_blog_box_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                "name" => __( "Blog Box", 'Insperia-child' ),
                "base" => "wp_blog_box",
                "category" => __( "Content", 'Insperia-child' ),
                "icon" => "",
                "class" => "",
                'description' => __( 'Show Blog Box', 'Insperia-child' ),
                "params" => array(
                    array(
                        'save_always'=>true,
                        "type" => "attach_image",
                        'heading' => __( 'Image', 'Insperia-child' ),
                        'param_name' => 'image',
                        'description' => __(
                            'Choose an image from library.',
                            'Insperia-child' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'Insperia-child' ),
                        'param_name' => 'title',
                        'description' => __(
                            'Enter text which will be used as title.',
                            'Insperia-child' ) ),
                    array(
                        'save_always'=>true,
                        "type" => "textarea",
                        "heading" => __( "Description", 'Insperia-child' ),
                        "param_name" => "descrip") ,
                    array(
                        'save_always'=>true,
                        'type' => 'href',
                        'heading' => __( 'URL (Link)', 'Insperia-child' ),
                        'param_name' => 'link')
                )));
    }

    // Element HTML
    public function wp_blog_box_html( $atts ) {
        extract(shortcode_atts(array('image' => '' , 'title' => '' , 'descrip' => '', 'link' => ''), $atts));

        $getimageurlarray = wp_get_attachment_image_src( $image , 'full');

        if( $getimageurlarray ) {$getimageurl = $getimageurlarray[0];} else {$getimageurl = '';}
        $link_tag = ($link)? '<a href="'.esc_attr($link).'"><h4 class="strong">'.esc_attr($title).'</h4></a>':'<h4 class="strong">'.esc_attr($title).'</h4>';
        $output = '
        <div class="post-wrapper">
            <div class="thumbnail">
                <img alt="image" src="'.esc_url($getimageurl).'">
                <div class="caption">
                    '.$link_tag.'
                    <p>'.esc_attr($descrip).'</p>
                </div>
            </div>
        </div>';
    return $output;
    }
} // End Element Class


// Element Class Init
new WP_Blog_Box();