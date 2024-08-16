<?php

include "category_create.php";
include "sub_category_create.php";
//include "admin-toolbar2.php";
function list_category_form ()
{
    global $wpdb;

    if (isset($_POST['create_category'])) {
        create_new_category();
    } else if (isset($_POST['create_sub_category'])){
        create_new_sub_category();
    } else {

    $table_name = $wpdb->prefix . 'reservations';
    $reservations = $wpdb->get_results("SELECT * FROM $table_name");

    include plugin_dir_path(__DIR__). "admin-toolbar.php";
    ?>
    <div class="mp-wrap">
    <h1> Dodaj nową kategorię </h1>
    <p><b> Wybierz panel </b></p>
    <div class="mp-reserv-list"><?php
    foreach ($reservations as $reservation) {
        echo '<div class="mp-button">';
        echo $reservation->name;
        echo '</div>';
    }
    ?>
    </div>
    </div>
    <?php
    }

    ?>

    <?php
}

?>