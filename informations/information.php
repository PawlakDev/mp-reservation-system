<?php

function mp_get_user_info()
{
    ?>
    <div class="mp-calendar-right">
        <div class="mp-calendar-right-field1">
            <div class="mp-calendar-back">
                <div class="mp-calendar-back-box" id="mp-back-box-information">
                    <i class="icon-chevron-left"></i>
                </div>
                <div class="mp-calendar-back-box-txt">
                    <p>Informacje</p>
                </div>
            </div>
        </div>

        <div class="mp-calendar-right-field2">
            <div class="mp-user-info">

                    <div class="mp-user-info-name">
                        <div class="mp-user-info-username">
                            <span>Imie</span>
                            <input type="text" id="mp-firstname" name="myTextField1"><br>
                        </div>

                        <div class="mp-user-info-surname">
                            <span>Nazwisko</span>
                            <input type="text" id="mp-lastname" name="myTextField2"><br>
                        </div>
                    </div>

                    <div class="mp-user-info-email">
                        <span>Adres Email</span>
                        <input type="text" id="mp-email" name="myTextField3"><br>
                    </div>

            </div>
        </div>

        <div class="mp-calendar-right-field3">
            <div class="mp-error-info"></div>
            <button id="mp-button-summary" class="mp-submit-button" type="submit">Podsumowanie</button>
        </div>
    <?php
    wp_die();
}

add_action( 'wp_ajax_get_user_info', 'mp_get_user_info' );
add_action( 'wp_ajax_nopriv_get_user_info', 'mp_get_user_info' );
?>