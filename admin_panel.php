<?php
include "admin-panel/reservations/reservations_list.php";
include "admin-panel/categories/list/category_getdata.php";
include "admin-panel/categories/list/category_add.php";
include "admin-panel/panels/list_reservations_form.php";
include "admin-panel/categories/list_category_form.php";

add_action('admin_menu', 'customMenu');
function customMenu() {
    add_menu_page(
        'Rezerwacje', // Tytuł wyświetlany w zakładce
        'Rezerwacje',   // Tekst wyświetlany w menu
        'read',         // Uprawnienia wymagane do dostępu do strony
        'reservations',   // Unikalny identyfikator strony
        'praca_dyplomowa_renderuj' // Funkcja do renderowania zawartości strony
    );

    add_submenu_page(
        'reservations',
        'Panele',
        'Panele',
        'read',
        'list_reservation',
        'list_reservations_form'
    );

    add_submenu_page(
        'reservations',          // Identyfikator strony nadrzędnej
        'Kategorie',     // Tytuł podstrony
        'Kategorie',     // Tekst wyświetlany w menu
        'read',                  // Uprawnienia wymagane do dostępu do strony
        'list_category',     // Unikalny identyfikator strony
        'list_category_form' // Funkcja do renderowania zawartości strony
    );
}
