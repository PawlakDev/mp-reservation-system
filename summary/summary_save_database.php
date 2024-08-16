<?php

function mp_save_summary_to_database()
{
    global $wpdb;
    if (isset($_POST['firstname'])) $FirstName = $_POST['firstname'];
    if (isset($_POST['lastname'])) $LastName = $_POST['lastname'];
    if (isset($_POST['email'])) $Email = $_POST['email'];
    if (isset($_POST['panelId'])) $PanelId = $_POST['panelId'];
    if (isset($_POST['category'])) $Category = $_POST['category'];
    if (isset($_POST['subCategory'])) $SubCategory = $_POST['subCategory'];
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
        $Date = new DateTime($date);
    }

    $table_name = $wpdb->prefix . 'reservations_dates';
    $data = array(
        'date' => $Date->format('Y-m-d'),
        'time' => $Date->format('H:i'),
        'cat_id' => $Category,
        'sub_id' => $SubCategory,
        'first_name' => $FirstName,
        'last_name' => $LastName,
        'email' => $Email,
        'panel_id' => $PanelId
    );

    ?>
    <div class="mp-calendar-right" style="display: flex;flex-direction: column;justify-content: space-between;">
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
            <div>
                <div class="mp-summary" style="padding-left:20px">
                    <?php
                    $wpdb->insert($table_name, $data, $format);
                    if ($wpdb->insert_id) {
                        echo '<p style="font-size: x-large"> Rezerwacja została zatwierdzona </br> ID rezerwacji: ' . $wpdb->insert_id . '</p>';
                    } else {
                        echo '<p style="font-size: x-large"> Wystąpił błąd podczas dodawania wpisu: ' . $wpdb->last_error . ' : ' . $wpdb->print_error() . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="mp-calendar-right-field3">
            <div class="mp-error-info"></div>
            <button id="mp-button-summary-done" class="mp-submit-button" type="submit">Powrót</button>
        </div>
    </div>

    <?php

    wp_die();
}
add_action( 'wp_ajax_save_summary_to_database', 'mp_save_summary_to_database' );
add_action( 'wp_ajax_nopriv_save_summary_to_database', 'mp_save_summary_to_database' );
?>