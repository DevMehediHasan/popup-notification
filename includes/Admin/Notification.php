<?php

namespace CustomPopup\Notification\Admin;
use CustomPopup\Notification\Traits\Form_Error;

/**
 * The notification handler class
 * 
 */

class Notification
{
    use Form_Error;

    /**
     * Plugin page handler
     *
     * @return void
     */
    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/notification-new.php';
                break;

            case 'edit':
                $notification = cp_get_notification( $id );
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

        if (! wp_verify_nonce($_POST['_wpnonce'], 'new-notification')) {
            wp_die('Are you cheating?');
        }

        if (! current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }

        $id      = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
        $name    = isset($_POST['product_name']) ? sanitize_textarea_field($_POST['product_name']) : '';
        $description    = isset($_POST['ps_description']) ? sanitize_textarea_field($_POST['ps_description']) : '';
        $producturl   = isset($_POST['product_url']) ? sanitize_text_field($_POST['product_url']) : '';

        if (empty($name)) {
            $this->errors['product_name'] = __('Please provide a product name', 'custom-popup-notification');
        }

        if (empty($description)) {
            $this->errors['ps_description'] = __('Please provide a description.', 'custom-popup-notification');
        }

        if (empty($producturl)) {
            $this->errors['product_url'] = __('Please provide a URL.', 'custom-popup-notification');
        }

        if (!empty($this->errors)) {
            return;
        }

        $args = [
            'product_name'   => $name,
            'ps_description' => $description,
            'product_url'    => $producturl
        ];

        if ( $id ) {
            $args['id'] = $id;
        }

        $insert_id = cp_insert_notification( $args );

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }

        if ( $id ) {
            $redirected_to = admin_url( 'admin.php?page=custom-popup-notification&action=edit&notification-updated=true&id=' . $id );
        } else {
            $redirected_to = admin_url( 'admin.php?page=custom-popup-notification&inserted=true' );
        }
        
        wp_redirect($redirected_to);
        exit;
    }
    public function delete_notification() {
        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'cp-delete-notification' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

        if ( cp_delete_notification( $id ) ) {
            $redirected_to = admin_url( 'admin.php?page=custom-popup-notification&notification-deleted=true' );
        } else {
            $redirected_to = admin_url( 'admin.php?page=custom-popup-notification&notification-deleted=false' );
        }

        wp_redirect( $redirected_to );
        exit;
    }
}
