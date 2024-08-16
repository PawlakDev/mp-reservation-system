<?php
// WordPress is loaded
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $wpdb;

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

//Reservation list
$table_name = $wpdb->prefix . 'reservations';

$sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255)
)";

// Execute SQL
dbDelta( $sql );

//List of categories for a given reservation
$table_name = $wpdb->prefix . 'reservations_category';

$sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reserv_id INT,
    category_name VARCHAR(255)
)";

dbDelta( $sql );

//List of subcategories for a given reservation
$table_name = $wpdb->prefix . 'reservations_subcategory';

$sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cat_id INT,
    subcategory_name VARCHAR(255)
)";

dbDelta( $sql );

//List of dates for a given reservation
$table_name = $wpdb->prefix . 'reservations_dates';

$sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    cat_id INT NOT NULL,
    sub_id INT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    panel_id INT,
    FOREIGN KEY (cat_id) REFERENCES {$wpdb->prefix}reservations_category(id),
    FOREIGN KEY (sub_id) REFERENCES {$wpdb->prefix}reservations_subcategory(id)
)";

dbDelta( $sql );
?>
