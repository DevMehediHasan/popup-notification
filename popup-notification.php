<?php
/*
 * Plugin Name:       Popup Notification
 * Plugin URI:        https://github.com/DevMehediHasan
 * Description:       Popup Notification.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mehedi Hasan
 * Author URI:        https://github.com/DevMehediHasan
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       popup-notification
 */

//  don't call the file directly
if (defined('abspath')) {
    exit;
}

add_action( 'admin_menu', 'wp_menu_popup_notification' );
function wp_menu_popup_notification() {
    add_menu_page(
        'Notificationoptions',
        'Notification',
        'manage_options',
        plugin_dir_path(__FILE__) . 'admin/view.php',
        null,
        'dashicons-bell',
        20
    );
}
?>