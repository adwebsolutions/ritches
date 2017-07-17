<?php
/*
Element Description: WP Testimonial Box
*/

// Element Class
class WP_Testimonial_Box extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'wp_testimonial_box_mapping' ) );
        add_shortcode( 'wp_testimonial_box', array( $this, 'wp_testimonial_box_html' ) );
    }

    // Element Mapping
    public function wp_testimonial_box_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                "name" => __( "Testimonial Box", 'Insperia-child' ),
                "base" => "wp_testimonial_box",
                "category" => __( "Content", 'Insperia-child' ),
                "icon" => "",
                "class" => "",
                'description' => __( 'Show Testimonial Box.', 'Insperia-child' ),
                "params" => array(
                    array(
                        'save_always'=>true,
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'Insperia-child' ),
                        'param_name' => 'title',
                        'description' => __(
                            'Enter text which will be used as widget title. Leave blank if no title is needed.',
                            'Insperia-child' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'colorpicker',
                        'heading' => __( 'Title Color', 'Insperia-child' ),
                        'param_name' => 'title_color',
                        'description' => __( 'Title color.', 'Insperia-child' ) ),
                    array(
                        'save_always'=>true,
                        "type" => "textfield",
                        "heading" => __( "Testimonial Per Page", 'Insperia-child' ),
                        "param_name" => "per_page",
                        "admin_label" => true,
                        "value" => 2 ),
                    array(
                        'save_always'=>true,
                        "type" => "dropdown",
                        "heading" => __( "Columns", 'Insperia-child' ),
                        "param_name" => "columns",
                        "std" => 4,
                        "admin_label" => true,
                        "value" => array( 1,2) ),
                    array(
                        'save_always'=>true,
                        'param_name' => 'show_filter',
                        'heading' => __( 'Show Filters', 'Insperia-child' ),
                        'type' => 'checkbox',
                        'value' => array( __( 'Yes,please', 'Insperia-child' ) => '1' ) ),
                    array(
                        'save_always'=>true,
                        'param_name' => 'show_button',
                        'heading' => __( 'Show see more Button', 'Insperia-child' ),
                        'type' => 'checkbox',
                        'value' => array( __( 'Yes,please', 'Insperia-child' ) => '1' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'href',
                        'dependency' => array( 'element' => 'show_button', 'not_empty' => true ),
                        'heading' => __( 'URL (Link)', 'Insperia-child' ),
                        'param_name' => 'btn_href',
                        'description' => __( 'Button link.', 'Insperia-child' ) ),
                    array(
                        'save_always'=>true,
                        'type' => 'colorpicker',
                        'dependency' => array( 'element' => 'show_button', 'not_empty' => true ),
                        'heading' => __( 'Button Color', 'Insperia-child' ),
                        'param_name' => 'btn_color',
                        'description' => __( 'Button color.', 'Insperia-child' ) ),
                    array(
                        'save_always'=>true,
                        "type" => "textfield",
                        'dependency' => array( 'element' => 'show_button', 'not_empty' => true ),
                        "heading" => __( "Button Text", 'Insperia-child' ),
                        "param_name" => "btn_text",
                        "admin_label" => true,
                        "value" => "See More" )) ) );

    }

    // Element HTML
    public function wp_testimonial_box_html( $atts ) {

        $output ='';
        extract(shortcode_atts(array(
            'title'=>'',
            'title_color'=>'',
            'per_page'=>'2',
            'columns'=>'2',
            'show_filter'=>'',
            'show_button'=>'',
            'btn_color'=>'',
            'btn_href'=>'',
            'btn_text'=>'',
            'el_class' => ''
        ),$atts));

        $title_color = ic_format_color($title_color);

        $query_args = array(
            'numberposts' => $per_page,
            'post_status'    => 'publish',
            'post_type'      => 'testimonial',
            'meta_query'     => array()
        );

        $temp_post = get_posts($query_args);
        $class = 'testimonial-box';
        ?>
        <div class="testimonials-wrapper">
        <?php
        if(!empty($title))
        ?>
            <h1 <?php if(!empty($title_color)){?> style="color:<?php echo esc_attr($title_color)?>"<?php }?>><?php echo esc_attr($title);?></h1>
        <?php
        if ($show_filter) :
            $terms = get_terms( array(
                'taxonomy' => 'testimonial-cat',
                'hide_empty' => false,
            ) );
            if(count($terms)>0):?>
                <ul class="nav testimonial-filter">
                <?php  if(count($terms)>1)?>
                    <li class="active" data-term="-1"><?php echo __('All','insperia-child');?></li>
                <?php
                foreach ($terms as $term):
                ?>
                    <li  class="<?php echo $term->slug?>" data-term="<?php echo $term->term_id ?>"><?php echo $term->name?></li>
                <?php endforeach; ?>
                </ul>
                <?php
                endif;
        endif;
        ?>
        <div class="testimonials-content" data-columns="<?php echo $columns;?>">
        <?php
        if(count($temp_post)>0):
            $c = 0;

            foreach($temp_post as $tp):
                $class = 'testimonial-item col-'.$columns;
                $c++;
                $cat = wp_get_post_terms($tp->ID,'testimonial-cat',array('fields'=>'slugs'))[0];
                $class .= ' '.$cat;
                if ($c == $columns ):
                    $class .= ' last';
                    $c = 0;
                endif;
                $img_before = get_post_meta($tp->ID,'ba_image_before_id')[0];
                $img_after = get_post_meta($tp->ID,'ba_image_after_id')[0];
            ?>
                <div class="<?php echo $class?>">
                    <div class="testimonial-box">
                        <?php echo get_image_tag($img_before['id'],'Before','Before','center','full');?>
                        <h2><?php echo $tp->post_title; ?></h2>
                        <span>ANTES</span>
                        <p><?php echo $tp->post_content;?></p>
                    </div>
                    <div class="testimonial-box">
                        <?php echo get_image_tag($img_after['id'],'After','After','center','full');?>
                        <h2><?php echo $tp->post_title; ?></h2>
                        <span>DESPUÉS</span>
                        <p><?php echo $tp->post_content;?></p>
                    </div>
                </div>
                <?php
            endforeach;
        else:
        ?>
            <p>No se encontraron testimonios</p>
        <?php
        endif;
        ?>
            </div>
            <?php
        if($show_button):
            ?>
            <div class="more-testimonial">
                <a <?php if(!empty($btn_color)){?> style="background:<?php echo esc_attr($btn_color)?>"<?php }?> href="<?php echo esc_attr($btn_href);?>"><?php echo esc_attr($btn_text);?></a>
            </div>
            <?php
        endif;
        ?>
        </div>
        <?php


        echo $output;
    }
} // End Element Class


// Element Class Init
new WP_Testimonial_Box();