<?php

function create_custom_shortcode() {
    if (isset($_POST['create_shortcode'])) {
        global $wpdb;

        $shortcode_name = $_POST['shortcode_name'];
        $shortcode_name = sanitize_text_field($shortcode_name);
        $userId = get_current_user_id();
        $data = array(
            'user_id' => $userId,
            'name' => $shortcode_name
        );

        $table_name = $wpdb->prefix . 'reservations';
        $wpdb->insert( $table_name, $data );

        if ( $wpdb->insert_id ) {
            echo "Nowy wpis został dodany do tabeli.";
        } else {
            echo "Wystąpił problem podczas dodawania nowego wpisu.";
        }

        echo '<div class="updated"><p>Stworzony nowy shortcode: [' . $shortcode_name . ']</p></div>';
    }
}

?>