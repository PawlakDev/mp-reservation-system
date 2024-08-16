<?php

function calendar_get_hours()
{
    global $wpdb;
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
        $Date = new DateTime($date);
        $formattedDate = $Date->format('Y-m-d');
    }

    if (isset($_POST['cat_id'])) {
        $categoryId = $_POST['cat_id'];
    }

    $table_name = $wpdb->prefix . 'reservations_dates';
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE date = %s AND cat_id = %d", $formattedDate, $categoryId);
    $results = $wpdb->get_results($query);
    $timeArray = [];
    foreach ($results as $row) {
        $timeArray[] = substr($row->time, 0, 5);
    }

    ?>
    <div class="mp-calendar-hours">
        <?php
        $start = strtotime("08:00");
        $end = strtotime("16:00");

        for ($current = $start; $current <= $end; $current += 3600) { ?>
            <div class="mp-calendar-hour" style="<?= in_array(date("H:i", $current), $timeArray) ? 'opacity: 0.3; pointer-events: none;' : ''; ?> "  >
            <?= "Godzina: "; ?>
            <?= date("H:i", $current); ?>
            </div><?php
        }?>
    </div>
    <?php
    wp_die();
}
add_action( 'wp_ajax_get_calendar_hours', 'calendar_get_hours' );
add_action( 'wp_ajax_nopriv_get_calendar_hours', 'calendar_get_hours' );

?>