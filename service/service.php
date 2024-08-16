<?php
function test123()
{
    return "test";
}
function mp_get_cat_service(){
    ?>
<div>cos</div>
    <?php
//    global $wpdb;
//    $shortcode_id = 1 ;
//
//    $tableName = $wpdb->prefix . 'reservations_category';
//    $reservations_category = $wpdb->get_results("SELECT * FROM $tableName WHERE reserv_id = '{$shortcode_id}'");
//    $category = [];
//
//    foreach ($reservations_category as $cat) {
//        $category[$cat->category_name] = $cat->id;
//    }
//
//    ?>
<!---->
<!--    <div class="mp-calendar">-->
<!--        <div class="mp-calendar-left">-->
<!--            <div class="mp-calendar-left-field1">-->
<!--                <div>-->
<!--                    <h2> <i class="icon-magic"></i> Wybierz Usługę</h2>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <h2 id="dataButton"> <i class="icon-calendar"></i> Data i Godzina</h2>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <h2> <i class="icon-pencil"></i> Podaj Informacje </h2>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <h2> <i class="icon-shopping-cart"></i> Płatność </h2>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="mp-calendar-left-field2"></div>-->
<!--            <div class="mp-calendar-left-field3"></div>-->
<!--        </div>-->
<!--        <div class="mp-calendar-right">-->
<!---->
<!--            <div class="mp-calendar-right-field1">-->
<!--                <div class="mp-calendar-back">-->
<!--                    <div class="mp-calendar-back-box-txt">-->
<!--                        <p> Wybierz usłguę </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="mp-calendar-right-field2">-->
<!---->
<!--                <div class="mp-reservation-select">-->
<!--                    <div id="mp-categories">-->
<!--                        <select id="mp-category" name="category">-->
<!--                            <option value="" disabled selected style="display:none;">Wybierz kategorię</option>-->
<!--                            --><?php
//                            foreach ($category as $category_name => $category_id) {
//                                echo '<option value="' . $category_id . '">' . $category_name . '</option>';
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
<!---->
<!--                    <div id="mp-subcategories">-->
<!--                        <select id="mp-sub-category" name="sub-category">-->
<!--                            <option value="" disabled selected style="display:none;">Wybierz pod kategorię</option>-->
<!--                        </select>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="mp-calendar-right-field3">-->
<!--                <div class="mp-error-info"></div>-->
<!--                <button id="mp-submit-category-and-price" class="mp-submit-button" type="submit">kontynuuj</button>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!---->
<!--    --><?php
//    return 'Cos tutaj sobie pisze';
}
add_action( 'wp_ajax_get_category_service', 'mp_get_service' );
add_action( 'wp_ajax_nopriv_get_category_service', 'mp_get_service' );

