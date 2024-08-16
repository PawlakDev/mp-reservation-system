<?php


function praca_dyplomowa_renderuj() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations_dates';
    $query = $wpdb->prepare("SELECT * FROM $table_name");
    $results = $wpdb->get_results($query);

    include plugin_dir_path(__DIR__). "admin-toolbar.php";
    echo '<div class="mp-wrap">';
    ?>
    <span id="mp-reservation-del-info"></span>
    <div class="mp-reserv-list-top">
        <div>
            <h2>Lista Rezerwacji</h2>
        </div>
        <div>
            <select name="pets" id="pet-select">
                <option value="">--Please choose an option--</option>
                <option value="dog">Dog</option>
            </select>
        </div>
    </div>
    <?php
    echo '<table class="widefat">' ;
    echo '<thead>' ;
    echo '<tr>';
    echo '<th> ID </th>' ;
    echo '<th>Data</th>';
    echo '<th>Godzina</th>';
    echo '<th> Kategoria </th>';
    echo '<th> Podkategoria </th>';
    echo '<th> Imię </th>';
    echo '<th> Nazwisko </th>';
    echo '<th> Email </th>';
    echo '<th> Panel </th>';
    echo '<th> Akcje </th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . $row->id . '</td>';
        echo '<td>' . $row->date . '</td>';
        echo '<td>' . $row->time . '</td>';
        echo '<td>' . mp_get_category_by_id($row->cat_id) . '</td>';
        echo '<td>' . mp_get_subcategory_by_id($row->sub_id) . '</td>';
        echo '<td>' . $row->first_name . '</td>';
        echo '<td>' . $row->last_name . '</td>';
        echo '<td>' . $row->email . '</td>';
        echo '<td>' . get_panel_name_by_id($row->panel_id) . '</td>';
        echo '<td>';
        echo '<div class="mp-reservations-actions">';
        echo '<span class="mp-reservations-action-edit mp-reservation-edit"> Edytuj </span>';
        echo '<span class="mp-reservations-action-del mp-reservation-del"> Usuń </span>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<span class="mp-reservation-list-results"> Wszystkich wyników: ' . count($results) . '</span>';
    echo '</div>';
    ?>
    <div class="popupBackground"></div>
    <div class="mp-popupForm">
    </div>
    <?php
}

function mp_reservations_action_edit ()
{
    global $wpdb;

    if (isset($_POST['ID'])) $id = $_POST['ID'];
    $table_name = $wpdb->prefix . 'reservations_dates';
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE ID = %d", $id);
    $results = $wpdb->get_results($query);

    ?>
        <form action="process.php" method="post">
            <label class="mp-grid-3">
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">ID</span>
                    <input type="text" name="field1" value="<?= $results[0]->id ?>" disabled>
                </div>
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">Data</span>
                    <input type="text" name="field1" value="<?= $results[0]->date ?>">
                </div>
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">Godzina</span>
                    <input type="text" name="field1" value="<?= $results[0]->time ?>">
                </div>
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">Kategoria</span>
                    <input type="text" name="field1" value="<?= mp_get_category_by_id($results[0]->cat_id) ?>" disabled>
                </div>
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">Podkategoria</span>
                    <input type="text" name="field1" value="<?= mp_get_subcategory_by_id($results[0]->sub_id) ?>" disabled>
                </div>
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">Imię</span>
                    <input type="text" name="field1" value="<?= $results[0]->first_name ?>">
                </div>
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">Nazwisko</span>
                    <input type="text" name="field1" value="<?= $results[0]->last_name ?>">
                </div>
                <div class="mp-edit-popup-div">
                    <span class="mp-edit-popup-span">Email</span>
                    <input type="text" name="field1" value="<?= $results[0]->email ?>">
                </div>
                <div class="mp-edit-popup-div">
                  <span class="mp-edit-popup-span">Panel</span>
                  <input type="text" name="field1" value="<?= get_panel_name_by_id($results[0]->panel_id) ?>" disabled>
                </div>
            </label>
            <div style="display:flex;justify-content: space-between;">
                <button type="button" class="mp-popup-close">Anuluj</button>
                <button type="submit">Zapisz</button>
            </div>
        </form>
    <?php

    wp_die();
}
add_action( 'wp_ajax_mp_reservations_action_edit', 'mp_reservations_action_edit' );
add_action( 'wp_ajax_nopriv_mp_reservations_action_edit', 'mp_reservations_action_edit' );

function mp_reservations_action_del ()
{
    global $wpdb;

    if (isset($_POST['ID'])) $id = $_POST['ID'];
    $table_name = $wpdb->prefix . 'reservations_dates';
    $query = $wpdb->prepare("DELETE FROM $table_name WHERE ID = %d", $id);
    $results = $wpdb->query($query);

    praca_dyplomowa_renderuj();
    wp_die();
}
add_action( 'wp_ajax_mp_reservations_action_del', 'mp_reservations_action_del' );
add_action( 'wp_ajax_nopriv_mp_reservations_action_del', 'mp_reservations_action_del' );

function get_panel_name_by_id($id)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations';
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id);
    $results = $wpdb->get_results($query);

    return $results[0]->name;
}
?>