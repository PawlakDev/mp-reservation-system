<?php

include "sub_category_add.php";
function category_getdata() {
    global $wpdb;

    if (isset($_POST['button_text'])) {
        $reserv_name = $_POST['button_text'];
        $table_name = $wpdb->prefix . 'reservations';
        $getReservationId = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT `id` FROM $table_name WHERE `name` = %s",
                $reserv_name
            )
        );

        $table_name = $wpdb->prefix . 'reservations_category';
        $categories = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE `reserv_id` = %s",
                $getReservationId[0]->id
            )
        );

        $subCategories = get_sub_categories_array($getReservationId[0]->id);

        ?>
        <div class="mp-category-grid">
            <div class="wrap">
                <h2>Lista Kategorii Panelu <?= $reserv_name ?> </h2>
                    <table class="widefat">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Nazwa kategorii </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($categories as $cat) {
                            echo '<tr>';
                            echo '<td>' . $cat->id . '</td>';
                            echo '<td>' . $cat->category_name . '</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                <div class="mp-add-new-category">
                    <input type="hidden" id="reserv_id" name="reserv_id" value="<?= $getReservationId[0]->id ?>">
                    <input type="submit" name="go_shortcode" value="Dodaj kategorie" class="button-primary" id="addCategoryButton">
                </div>
            </div>

            <div class="wrap">
                <h2>Lista Podkategorii Panelu <?= $reserv_name ?> </h2>
                <table class="widefat">
                    <thead>
                    <tr>
                        <th> ID </th>
                        <th> Nazwa kategorii </th>
                        <th> Nazwa podkategorii </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($subCategories as $subCat) {
                        echo '<tr>';
                        echo '<td>' . $subCat->id . '</td>';
                        echo '<td>' . get_categories_name_by_id($subCat->cat_id) . '</td>';
                        echo '<td>' . get_sub_categories_by_id($subCat->id) . '</td>';
                        echo '</tr>';
                    }

                    ?>
                    </tbody>
                </table>


                <div class="mp-add-new-sub-category">
                    <input type="hidden" id="reserv_id" name="reserv_id" value="<?= $getReservationId[0]->id ?>">
                    <input type="submit" name="go_shortcode" value="Dodaj podkategorie" class="button-primary" id="addCategoryButton">
                </div>
            </div>

        </div>

        <?php

    } else echo 'Brak wybranego panelu';

    wp_die();
}
add_action( 'wp_ajax_get_data', 'category_getdata' );

function get_sub_categories_array($RVID)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations_subcategory';
    $subCategories = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name"
        )
    );

    $table_name = $wpdb->prefix . 'reservations_category';
    $categories = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name"
        )
    );

    $subCategoriesArray = [];

    foreach ($subCategories as $sub) {
        $catId = $sub->cat_id;
        foreach ($categories as $cat){
            if ($cat->id == $catId) {
                $reservationID = get_id_from_reservations_by_reserv_id($cat->reserv_id);
                if($reservationID == $RVID){
                    $subCategoriesArray[] =  $sub;
                }
            }
        }
    }

    if(!empty($subCategoriesArray)){
        return $subCategoriesArray;
    } else {
        return null;
    }
}

function get_id_from_reservations_by_reserv_id($RSRVID)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations';
    $reservations = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name"
        )
    );

    foreach ($reservations as $reserv) {
        if ($reserv->id == $RSRVID) {
            return $reserv->id;
        }
    }
    echo 'null';

}
function get_categories_name_by_id($id){
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations_category';
    $categories = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name"
        )
    );

    foreach ($categories as $cat) {
        if ($cat->id == $id) {
            return $cat->category_name;
        }
    }
    echo 'null';
}

function get_sub_categories_by_id($id){
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations_subcategory';
    $sub_categories = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name"
        )
    );
    foreach ($sub_categories as $sub_cat) {
        if ($sub_cat->id == $id) {
            return $sub_cat->subcategory_name;
        }
    }
    echo 'null';
}

?>