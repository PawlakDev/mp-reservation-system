<?php

function create_new_sub_category ()
{

    global $wpdb;

    $sub_category_name = $_POST['sub_category_name'];
    $cat_id = $_POST['selected_value'];

    $data = array(
        'cat_id' => $cat_id,
        'subcategory_name' => $sub_category_name
    );

    $table_name = $wpdb->prefix . 'reservations_subcategory';
    $wpdb->insert( $table_name, $data );

    if ( !$wpdb->insert_id ) {
        echo'<div class="notice notice-warning is-dismissibl"><p>Wystąpił problem podczas dodawania nowego wpisu.</p></div>';
    } else {
        echo'<div class="updated"><p>Stworzono nową podkategorię: ' . $sub_category_name . '</p></div>';
    }

    wp_die();
}
add_action( 'wp_ajax_create_sub_category', 'create_new_sub_category' );
?>