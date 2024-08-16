<?php

function category_add()
{
    ?>

    <h2>Stwórz nową kategorię</h2>
    <div>
        <form method="post" action="">
            <label for="shortcode_name">Wpisz nazwę kategorii:</label><br>
            <input type="hidden" name="reserv_id" value="<?= $_POST['reserv_id'] ?>">
            <input type="text" id="category_name" name="category_name"><br><br>
            <input type="submit" name="create_category" value="Stwórz" class="category-add-button">
        </form>
    </div>

    <?php
    wp_die();
}
add_action( 'wp_ajax_add_category', 'category_add' );

?>