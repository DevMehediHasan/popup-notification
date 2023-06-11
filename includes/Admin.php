<?php
namespace CustomPopup\Notification;

/**
 * 
 * Admin handler class
 */
class Admin
{
    function __construct()
    {
        $this->dispatch_actions();

        new Admin\Menu();
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions() {
        $notification = new Admin\Notification();
        
        add_action( 'admin_init', [ $notification, 'form_handler' ] );

    }
}
