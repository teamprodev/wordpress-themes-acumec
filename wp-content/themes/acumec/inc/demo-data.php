<?php 

add_filter('ef3-theme-options-opt-name', 'acumec_set_demo_opt_name');
function acumec_set_demo_opt_name(){
    return 'opt_theme_options';
}

add_filter('ef3-replace-theme-options', 'acumec_replace_theme_options');
function acumec_replace_theme_options(){
    return array(
        'opt_dev_mode' => 0,
    );
}

add_filter('ef3-enable-create-demo', 'acumec_enable_create_demo');
function acumec_enable_create_demo(){
    return false;
}

add_action('ef3-import-start', 'acumec_move_trash', 1);
if(!function_exists('acumec_move_trash')){
    function acumec_move_trash(){
        wp_trash_post(1);
        wp_trash_post(2);
        wp_trash_post(3);
        wp_trash_post(4);
        wp_trash_post(5);
        wp_trash_post(6);
        wp_trash_post(7);
        wp_trash_post(8);
        wp_trash_post(9);
        wp_trash_post(10);
        wp_trash_post(11);
        wp_trash_post(12);
        wp_trash_post(13);
    }
}

add_action('ef3-import-start','acumec_removed_widgets', 10, 2);
function acumec_removed_widgets(){
    global $wp_registered_sidebars;

    $widgets = get_option('sidebars_widgets');

    foreach ($wp_registered_sidebars as $sidebar => $value) {
        unset($widgets[$sidebar]);
    }

    update_option('sidebars_widgets',$widgets);  
}

add_action('ef3-import-finish', 'acumec_set_options_page');
function acumec_set_options_page(){
    $pages = array(        
        'woocommerce_shop_page_id'      => 'Shop',
        'woocommerce_cart_page_id'      => 'Cart',
    );
    foreach ($pages as $key => $page){
        $page = get_page_by_title($page);
        if(!isset($page->ID))
            return ;
        update_option($key, $page->ID);
    }
}


add_action('ef3-import-finish', 'acumec_crop_images',99,2);
function acumec_crop_images() {
    $query = array(
        'post_type'      => 'attachment',
        'posts_per_page' => -1,
        'post_status'    => 'inherit',
    );

    $media = new WP_Query($query);
    if ($media->have_posts()) {
        foreach ($media->posts as $image) {
            if (strpos($image->post_mime_type, 'image/') !== false) {
                $image_path = get_attached_file($image->ID);
                $metadata = wp_generate_attachment_metadata($image->ID, $image_path);
                wp_update_attachment_metadata($image->ID, $metadata);
            }
        }
    }
}