<?php
/*
 * Plugin Name:       Custom Popup Notification
 * Plugin URI:        https://github.com/DevMehediHasan
 * Description:       You can add Popup notification for your Products/Services.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mehedi Hasan
 * Author URI:        https://github.com/DevMehediHasan
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       custom-popup-notification
 */

//  don't call the file directly
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main Class
 */
final class Custom_Popup_Notification
{

    /**
     * plugin version
     */

    const version = '1.0';


    /**
     * Class constructor
     */
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }
    /**
     * initializes a singleton instance
     * 
     * @return \Popup_Notification
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function define_constants()
    {
        define('CPN_VERSION', self::version);
        define('CPN_FILE', __FILE__);
        define('CPN_PATH', __DIR__);
        define('CPN_URL', plugin_dir_url('', CPN_FILE));
        define('CPN_ASSETS', CPN_URL . '/assets');
    }

    public function init_plugin()
    {

        new WeDevs\Academy\Assets();

        
        if ( is_admin() ) {
            new CustomPopup\Notification\Admin();
        } else {
            new \CustomPopup\Notification\Frontend();
        }
    }

    public function activate()
    {

        $installer = new \CustomPopup\Notification\Installer();
        $installer->run();
    }
}

/**
 * initializes the main plugin
 * 
 * @return \Popup_Notification
 */
function custom_popup_notification()
{
    return Custom_Popup_Notification::init();
}
// kick of the plugin
custom_popup_notification();
