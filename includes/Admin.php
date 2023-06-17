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
        $notification = new Admin\Notification();
        $this->dispatch_actions($notification);

        new Admin\Menu( $notification );
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions( $notification) {
       

        add_action( 'admin_init', [ $notification, 'form_handler' ] );
        add_action( 'admin_post_cp-delete-notification', [ $notification, 'delete_notification' ] );

    }
}
