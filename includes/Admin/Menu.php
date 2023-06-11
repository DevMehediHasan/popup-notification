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
        $parent_slug = 'custom-popup-notification';
        $manage_options = 'manage_options';
        add_menu_page(__('Popup Notification', 'custom-popup-notification'), __('Notification', 'custom-popup-notification'), $manage_options, 'custom-popup-notification', [$this, 'all_notification'], 'dashicons-bell' );
        add_submenu_page( $parent_slug, __('All Notification', 'custom-popup-notification'), __('All Notification', 'custom-popup-notification'), $manage_options, $parent_slug, [$this, 'all_notification'], );
        add_submenu_page( $parent_slug, __('Notification Settings', 'custom-popup-notification'), __('Notification Settings', 'custom-popup-notification'), $manage_options, 'notification-settings', [$this, 'notification_settings'], );
    }

    public function all_notification()
    {
        $notification = new Notification();
        $notification->plugin_page();

    }
    public function notification_settings()
    {
        echo 'notification_settings';
    }
}
