<?php
namespace CustomPopup\Notification\Admin;

class Action
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'register_settings']);
        add_filter('option_page_capability_popup_settings', [$this, 'set_option_page_capability']);
        add_filter('whitelist_options', [$this, 'whitelist_popup_settings']);
    }

    public function register_settings()
    {
        register_setting('popup_settings', 'popup_position');
    }

    public function set_option_page_capability()
    {
        return 'manage_options';
    }

    public function whitelist_popup_settings($whitelist)
    {
        $whitelist['popup_settings'] = [
            'popup_position'
        ];
        return $whitelist;
    }
}

$action = new Action();

// Handle form submission
if (isset($_POST['update_settings'])) {
    update_option('popup_position', $_POST['popup_position']);
    // Redirect to the settings page after saving
    wp_redirect(admin_url('admin.php?page=notification-settings'));
    exit;
}
