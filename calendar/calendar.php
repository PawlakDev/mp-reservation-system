<?php

function get_calendar_html()
{
    ?>
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <div class="mp-calendar-right">
                <div class="mp-calendar-right-field1">
                    <div class="mp-calendar-back" id="mp-back-box-category-service">
                        <div class="mp-calendar-back-box">
                            <i class="icon-chevron-left"></i>
                        </div>
                        <div class="mp-calendar-back-box-txt">
                            <p>Data i Godzina</p>
                        </div>
                    </div>
                </div>
                <div class="mp-calendar-right-field2">
                    <div class="mp-calendar-select">
                        <select id="month" name="month">
                            <?php
                            $currentMonth = date('n');
                            $months = [
                                1 => 'Styczeń',
                                2 => 'Luty',
                                3 => 'Marzec',
                                4 => 'Kwiecień',
                                5 => 'Maj',
                                6 => 'Czerwiec',
                                7 => 'Lipiec',
                                8 => 'Sierpień',
                                9 => 'Wrzesień',
                                10 => 'Październik',
                                11 => 'Listopad',
                                12 => 'Grudzień'
                            ];

                            foreach ($months as $value => $label) {
                                $selected = ($value == $currentMonth) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$label</option>";
                            }
                            ?>
                        </select>
                        <select id="year" name="year">
                            <?php
                            $currentYear = date('Y');
                            $startYear = $currentYear;
                            $endYear = $currentYear + 3;
                            for ($year = $startYear; $year <= $endYear; $year++) {
                                $selected = ($year == $currentYear) ? 'selected' : '';
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                        <div id="mp-calendar-table">
                            <table id="calendar">
                                <thead>
                                    <tr>
                                        <th>Pon</th>
                                        <th>Wt</th>
                                        <th>Śr</th>
                                        <th>Czw</th>
                                        <th>Pt</th>
                                        <th>Sob</th>
                                        <th>Ndz</th>
                                    </tr>
                                </thead>
                                <tbody id="calendar-body">
                                </tbody>
                            </table>
                        </div>
                    <div class="calendar-dates"></div>
                </div>
                        <div class="mp-calendar-right-field3">
                            <div class="mp-error-info"></div>
                            <button id="mp-button-getinfo" class="mp-submit-button" type="submit">Kontynuuj</button>
                        </div>
            </div>
    <?php
    wp_die();
}
add_action( 'wp_ajax_get_calendar', 'get_calendar_html' );
add_action( 'wp_ajax_nopriv_get_calendar', 'get_calendar_html' );