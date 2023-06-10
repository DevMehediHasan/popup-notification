<?php

namespace CustomPopup\Notification\Admin;

/**
 * The menu handler class
 * 
 */

class Menu
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu' ]);
    }

    public function admin_menu()
    {
        add_menu_page(__('Popup Notification', 'custom-popup-notification'), __('Notification', 'custom-popup-notification'), 'manage_options', 'custom-popup-notification', [$this, 'plugin_page'], 'dashicons-bell' );
    }

    public function plugin_page()
    {
        echo 'hello';
    }
}
