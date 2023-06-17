<?php

namespace CustomPopup\Notification\Admin;

/**
 * The menu handler class
 * 
 */

class Menu
{
    public $notification;

    function __construct( $notification )
    {
        $this->notification = $notification;
        add_action('admin_menu', [$this, 'admin_menu' ]);
    }

    public function admin_menu()
    {
        $parent_slug = 'custom-popup-notification';
        $manage_options = 'manage_options';
        $hook = add_menu_page(__('Popup Notification', 'custom-popup-notification'), __('Notification', 'custom-popup-notification'), $manage_options, 'custom-popup-notification', [$this->notification, 'plugin_page'], 'dashicons-bell' );
        add_submenu_page( $parent_slug, __('All Notification', 'custom-popup-notification'), __('All Notification', 'custom-popup-notification'), $manage_options, $parent_slug, [$this->notification, 'plugin_page'], );
        add_submenu_page( $parent_slug, __('Notification Settings', 'custom-popup-notification'), __('Notification Settings', 'custom-popup-notification'), $manage_options, 'notification-settings', [$this, 'notification_settings'], );
       
        add_action( 'admin_head-' . $hook, [ $this, 'enqueue_assets' ] );
    }

    public function notification_settings()
    {
        echo 'notification_settings';
    }
    /**
     * Enqueue scripts and styles
     *
     * @return void
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'cpn-admin-style' );
    }
}
