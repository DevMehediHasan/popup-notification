<?php

namespace CustomPopup\Notification\Admin;

/**
 * The notification handler class
 * 
 */

class Notification
{
    public $errors = [];

    /**
     * Plugin page handler
     *
     * @return void
     */
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

        $name    = isset($_POST['product-name']) ? sanitize_text_field($_POST['product-name']) : '';
        $description = isset($_POST['ps-description']) ? sanitize_textarea_field($_POST['ps-description']) : '';
        $producturl   = isset($_POST['product-url']) ? sanitize_text_field($_POST['product-url']) : '';

        if (empty($name)) {
            $this->errors['product-name'] = __('Please provide a product-name', 'wedevs-academy');
        }

        if (empty($description)) {
            $this->errors['ps-description'] = __('Please provide a ps-description.', 'wedevs-academy');
        }

        if (!empty($this->errors)) {
            return;
        }

        $insert_id = cpn_insert_notification([
            'product-name'   => $name,
            'ps-description' => $description,
            'product-url'    => $producturl
        ]);

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }

        $redirected_to = admin_url('admin.php?page=custom-popup-notification&inserted=true');
        wp_redirect($redirected_to);
        exit;
    }
}
