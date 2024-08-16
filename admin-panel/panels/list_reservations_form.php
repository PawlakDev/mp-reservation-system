<?php
include "create_custom_shortcode.php";

function list_reservations_form()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'reservations';
    $reservations = $wpdb->get_results("SELECT * FROM $table_name");

    include plugin_dir_path(__DIR__). "admin-toolbar.php";

    echo '<div class="mp-wrap">';
    echo '<h2>Lista Paneli Rezerwacji</h2>';
    echo '<table class="widefat">';
    echo '<thead>';
    echo '<tr>';
    echo '<th> ID </th>' ;
    echo '<th>Autor</th>';
    echo '<th>Name</th>';
    echo '<th> ShortCode </th>';
    echo '<th> Akcje </th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($reservations as $reservation) {
        $userLogin = get_user_by( 'id', $reservation->user_id );
        echo '<tr>';
        echo '<td>' . $reservation->id . '</td>';
        echo '<td>' . $userLogin->user_login . '</td>';
        echo '<td>' . $reservation->name . '</td>';
        echo '<td> [' . $reservation->name . '] </td>';
        echo '<td>';
        echo '<div class="mp-reservations-actions">';
        echo '<span class="mp-reservations-action-edit mp-panel-edit"> Edytuj </span>';
        echo '<span class="mp-reservations-action-del mp-panel-del"> Usuń </span>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    ?>
    <div class="popupBackground"></div>
    <div class="mp-popupForm"></div>
    <?php

    if (isset($_POST['create_shortcode'])) {
        create_custom_shortcode();
    }
    ?>

    <div class="mp-add-new-panel">
        <input type="submit" name="go_shortcode" value="Dodaj nowy panel" class="button-primary" id="addPanelButton">
    </div>

    <?php

}

function mp_panel_action_edit ()
{
global $wpdb;

if (isset($_POST['ID'])) $id = $_POST['ID'];

$table_name = $wpdb->prefix . 'reservations';
$query = $wpdb->prepare("SELECT * FROM $table_name WHERE ID = %d", $id);
$results = $wpdb->get_results($query);
?>
<form action="process.php" method="post">
    <label class="mp-grid-2">
        <div class="mp-edit-popup-div">
            <span class="mp-edit-popup-span">ID</span>
            <input type="text" name="field1" value="<?= $results[0]->id ?>" disabled>
        </div>
        <div class="mp-edit-popup-div">
            <span class="mp-edit-popup-span">Autor</span>
            <input type="text" name="field1" value="<?= get_user_by( 'id',$results[0]->user_id)->user_login ?>" disabled>
        </div>
        <div class="mp-edit-popup-div">
          <span class="mp-edit-popup-span">Nazwa</span>
          <input type="text" name="field1" value="<?= $results[0]->name ?>">
        </div>
        <div class="mp-edit-popup-div">
          <span class="mp-edit-popup-span">ShortCode</span>
          <input type="text" name="field1" value="<?= "[" . $results[0]->name . "]" ?>" disabled>
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
add_action( 'wp_ajax_mp_panel_action_edit', 'mp_panel_action_edit' );
add_action( 'wp_ajax_nopriv_mp_panel_action_edit', 'mp_panel_action_edit' );

function mp_panels_action_del()
{
    global $wpdb;

    if (isset($_POST['ID'])){
        $id = $_POST['ID'];
    } else{
        wp_die(__('Invalid ID.'));;
    }

    //remove sub category assigned to this panel id
    $table_name = $wpdb->prefix . 'reservations_category';
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE reserv_id = %d", $id);
    $results = $wpdb->get_results($query);

    foreach ($results as $row) {
        $cat_id = $row->id;
        $table_name = $wpdb->prefix . 'reservations_subcategory';
        $query = $wpdb->prepare("DELETE FROM $table_name WHERE cat_id = %d", $cat_id);
        $wpdb->query($query);
    }

    //remove category assigned to this panel id
    $table_name = $wpdb->prefix . 'reservations_category';
    $query = $wpdb->prepare("DELETE FROM $table_name WHERE reserv_id = %d", $id);
    $wpdb->query($query);

    //remove panel
    $table_name = $wpdb->prefix . 'reservations';
    $query = $wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id);
    $wpdb->query($query);

    list_reservations_form();
    wp_die();
}
add_action( 'wp_ajax_mp_panels_action_del', 'mp_panels_action_del' );
add_action( 'wp_ajax_nopriv_mp_panels_action_del', 'mp_panels_action_del' );

?>