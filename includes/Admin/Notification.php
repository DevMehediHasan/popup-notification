<?php

namespace CustomPopup\Notification\Admin;

/**
 * The notification handler class
 * 
 */

class Notification
{
    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/notification-new.php';
                break;

            case 'edit':
                $template = __DIR__ . '/views/notification-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/notification-view.php';
                break;

            default:
                $template = __DIR__ . '/views/notification-list.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }
    }
    /**
     * Handle the form
     *
     * @return void
     */
    public function form_handler()
    {
        if (!isset($_POST['submit_notification'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'new-notification')) {
            wp_die('Are you cheating?');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }

        var_dump($_POST);
        exit;
    }
}
