<?php

include "calendar/calendar.php";
include "calendar/calendar_choose_date.php";
include "informations/information.php";
include "summary/summary.php";
include "summary/summary_save_database.php";
include "category/service.php";

global $wpdb;
$tableName = $wpdb->prefix . 'reservations';
$reservations = $wpdb->get_results("SELECT * FROM $tableName");

foreach ($reservations as $reservation) {
    add_shortcode($reservation->name, function() use ($reservation) {
        reservationsShortcode($reservation->id);
    });
}

function reservationsShortcode($shortcode_id){

    global $wpdb;

    $tableName = $wpdb->prefix . 'reservations_category';
    $reservations_category = $wpdb->get_results("SELECT * FROM $tableName WHERE reserv_id = '{$shortcode_id}'");
    $category = [];

    foreach ($reservations_category as $cat) {
        $category[$cat->category_name] = $cat->id;
    }

    ?>
  <script type="text/javascript">
    shortcodeId = "<?= $shortcode_id ?>";
  </script>

    <div id="loading">
        <div class="spinner"></div>
    </div>
    <div class="mp-calendar">
        <div class="mp-calendar-left">
            <div class="mp-calendar-left-field1">
                <div>
                    <h2> <i class="icon-magic"></i> Wybierz Usługę</h2>
                </div>
                <div>
                    <h2 id="dataButton"> <i class="icon-calendar"></i> Data i Godzina</h2>
                </div>
                <div>
                    <h2> <i class="icon-pencil"></i> Podaj Informacje </h2>
                </div>
                <div>
                    <h2> <i class="icon-shopping-cart"></i> Płatność </h2>
                </div>
            </div>
            <div class="mp-calendar-left-field2"></div>
            <div class="mp-calendar-left-field3"></div>
        </div>
        <div class="mp-calendar-right">

            <div class="mp-calendar-right-field1">
                <div class="mp-calendar-back">
                    <div class="mp-calendar-back-box-txt">
                        <p> Wybierz usłguę </p>
                    </div>
                </div>
            </div>

            <div class="mp-calendar-right-field2">

                <div class="mp-reservation-select">
                    <div id="mp-categories">
                        <select id="mp-category" name="category">
                            <option value="" disabled selected style="display:none;">Wybierz kategorię</option>
                            <?php
                            foreach ($category as $category_name => $category_id) {
                                echo '<option value="' . $category_id . '">' . $category_name . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div id="mp-subcategories">
                        <select id="mp-sub-category" name="sub-category">
                            <option value="" disabled selected style="display:none;">Wybierz pod kategorię</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="mp-calendar-right-field3">
                <div class="mp-error-info"></div>
                <button id="mp-submit-category-and-price" class="mp-submit-button" type="submit">kontynuuj</button>
            </div>

        </div>

    </div>


    <?php
    return 'Cos tutaj sobie pisze';
}

function get_sub_categories_main()
{
    global $wpdb;

    $choose = $_POST['button_text'];
    $categoryId = get_categories_id_by_name($choose);

    $tableName = $wpdb->prefix . 'reservations_subcategory';
    $reservations_subcategory = $wpdb->get_results("SELECT * FROM $tableName WHERE cat_id = '$categoryId'");

    ?>
    <select id="mp-sub-category" name="sub-category">
        <option value="" disabled selected style="display:none;">Wybierz pod kategorię</option>
        <?php
        foreach ($reservations_subcategory as $sub) {
            echo '<option value="' . $sub->id . '">' . $sub->subcategory_name . '</option>';
        }
        ?>
    </select>
    <?php
}
add_action( 'wp_ajax_get_data_sub_category', 'get_sub_categories_main' );
add_action( 'wp_ajax_nopriv_get_data_sub_category', 'get_sub_categories_main' );

function get_categories_id_by_name($name)
{
    global $wpdb;

    $tableName = $wpdb->prefix . 'reservations_category';
    $reservations_subcategory = $wpdb->get_results("SELECT * FROM $tableName WHERE category_name = '$name'");

    return $reservations_subcategory[0]->id;
}

