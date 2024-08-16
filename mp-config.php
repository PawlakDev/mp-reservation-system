<?php

function mp_plugin_styles_and_scripts() {

    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true);
    wp_enqueue_style( 'mp-custom-style', plugins_url( 'css/site/style.css', __FILE__ ) );
    wp_enqueue_script('mp-custom-scripts', plugins_url('scripts/site/calendar.js', __FILE__), array(), null, true);
//    wp_enqueue_script('mp-custom-scripts-info', plugins_url('scripts/site/informations.js', __FILE__), array(), null, true);
    wp_enqueue_script('ajax-script', plugins_url('/scripts/site/service.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('ajax-script2', plugins_url('scripts/site/informations.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('ajax-script3', plugins_url('scripts/site/summary.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('ajax-script4', plugins_url('scripts/site/category-service.js', __FILE__), array('jquery'), null, true);
    wp_localize_script('ajax-script', 'my_ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_ajax_nonce')
    ));
}
add_action( 'wp_enqueue_scripts', 'mp_plugin_styles_and_scripts' );

function enqueue_admin_custom_scripts_styles() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true);
    wp_enqueue_style('mp-custom-style', plugins_url('css/admin/style.css', __FILE__));
    wp_enqueue_script('mp-custom-scripts-panel', plugins_url('scripts/admin/panel.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('mp-custom-scripts-category', plugins_url('scripts/admin/category.js', __FILE__), array('jquery'), null, true);

    wp_enqueue_script('ajax-script', plugins_url('scripts/admin/reservations.js', __FILE__), array('jquery'), null, true);

    wp_localize_script('ajax-script', 'my_ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_ajax_nonce')
    ));
}

add_action('admin_enqueue_scripts', 'enqueue_admin_custom_scripts_styles');

?>