<?php

function create_new_category ()
{
    global $wpdb;

    $category_name = $_POST['category_name'];
    $reserv_id = $_POST['reserv_id'];
    $data = array(
        'reserv_id' => $reserv_id,
        'category_name' => $category_name
    );

    $table_name = $wpdb->prefix . 'reservations_category';
    $wpdb->insert( $table_name, $data );

    if ( !$wpdb->insert_id ) {
        echo'<div class="notice notice-warning is-dismissibl"><p>Wystąpił problem podczas dodawania nowego wpisu.</p></div>';
    } else {
        echo'<div class="updated"><p>Stworzono nową kategorię: ' . $_POST['category_name'] . '</p></div>';
    }

    wp_die();
}

?>