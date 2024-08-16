<?php

function mp_get_summary()
{
    if (isset($_POST['firstname'])) $FirstName = $_POST['firstname'];
    if (isset($_POST['lastname'])) $LastName = $_POST['lastname'];
    if (isset($_POST['email'])) $Email = $_POST['email'];
    if (isset($_POST['category'])) $Category = $_POST['category'];
    if (isset($_POST['subCategory'])) $SubCategory = $_POST['subCategory'];
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
        $Date = new DateTime($date);
    }
    ?>
    <div class="mp-calendar-right">
        <div class="mp-calendar-right-field1">
            <div class="mp-calendar-back">
                <div class="mp-calendar-back-box">
                    <i class="icon-chevron-left"></i>
                </div>
                <div class="mp-calendar-back-box-txt">
                    <p>Podsumowanie</p>
                </div>
            </div>
        </div>

        <div class="mp-calendar-right-field2">
            <div class="mp-grid-2">
                <div class="mp-summary">
                    <div class="mp-flex mp-flex-column">
                        <span> <b> Kategoria: </b> <?= mp_get_category_by_id($Category); ?> </span>
                    </div>
                    <div class="mp-flex mp-flex-column">
                        <span> <b> Pod Kategoria: </b> <?= mp_get_subcategory_by_id($SubCategory); ?> </span>
                    </div>
                    <div class="mp-flex mp-flex-column">
                        <span> <b> Data: </b> <?= $Date->format('Y-m-d H:i') ?> </span>
                    </div>
                    <div class="mp-flex mp-flex-column">
                        <span> <b> Imie: </b> <?= $FirstName ?> </span>
                    </div>
                    <div class="mp-flex mp-flex-column">
                        <span> <b> Nazwisko: </b> <?= $LastName ?> </span>
                    </div>
                    <div class="mp-flex mp-flex-column">
                        <span> <b> Email: </b> <?= $Email ?> </span>
                    </div>
                </div>

                <div>
                </div>
            </div>
        </div>

        <div class="mp-calendar-right-field3">
            <div class="mp-error-info"></div>
            <button id="mp-submit-save" class="mp-submit-button" type="submit">Potwierdź</button>
        </div>

        <?php
    wp_die();
}
add_action( 'wp_ajax_get_summary', 'mp_get_summary' );
add_action( 'wp_ajax_nopriv_get_summary', 'mp_get_summary' );

function mp_get_category_by_id($ID) : ?string {
    global $wpdb;

    $id = intval($ID);

    $table_name = $wpdb->prefix . 'reservations_category';

    $prepared_query = $wpdb->prepare(
        "SELECT * FROM $table_name WHERE id = %d",
        $id
    );
    $results = $wpdb->get_results($prepared_query, ARRAY_A);

    if (!empty($results)) {
        return $results[0]['category_name'];
    } else {
        return null;
    }
}

function mp_get_subcategory_by_id($ID) : ?string {
    global $wpdb;

    $id = intval($ID);

    $table_name = $wpdb->prefix . 'reservations_subcategory';

    $prepared_query = $wpdb->prepare(
        "SELECT * FROM $table_name WHERE id = %d",
        $id
    );
    $results = $wpdb->get_results($prepared_query, ARRAY_A);

    if (!empty($results)) {
        return $results[0]['subcategory_name'];
    } else {
        return null;
    }


}
?>