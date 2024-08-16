<?php

function sub_category_add()
{
    ?>

    <h2>Stwórz nową podkategorię</h2>
    <p class="mp-p"> Wybierz kategorię: </p>

    <?php
    global $wpdb;

    if(isset($_POST['reserv_id']) && !empty($_POST['reserv_id'])) {

        $reserv_id = intval($_POST['reserv_id']);

        $table_name = $wpdb->prefix . 'reservations_category';
        $query = $wpdb->prepare("SELECT * FROM $table_name WHERE reserv_id = %d", $reserv_id);

        $reservations = $wpdb->get_results($query);

    } else {
        echo 'Błąd: Brak wartości "reserv_id" lub jest pusta.';
    }

    ?>


    <div class="mp-sub-cat-add">
        <div>
            <div class="mp-sub_category_radio_button">
                <?php foreach ($reservations as $cat): ?>
                    <div class="mp-flex">
                        <input type="radio" name="reservation_category" value="<?php echo $cat->id; ?>">
                        <?php echo $cat->category_name; ?><br>
                    </div>
                <?php endforeach; ?>
            </div>
            <label for="sub_category_name"><b>Wpisz nazwę podkategorii:</b></label>
            <input type="text" id="sub_category_name" name="sub_category_name">
            <input type="submit" id="create_sub_category" value="Stwórz" class="mp-button">
        </div>
    </div>
    
    <?php
    wp_die();
}
add_action( 'wp_ajax_add_sub_category', 'sub_category_add' );

?>