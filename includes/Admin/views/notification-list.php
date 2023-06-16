<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'All Notification', 'custom-popup-notification' ); ?></h1>

    <a href="<?php echo admin_url( 'admin.php?page=custom-popup-notification&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'custom-popup-notification' ); ?></a>

    <form action="" method="POST">
        <?php
            $table = new CustomPopup\Notification\Admin\Notification_List();
            $table->prepare_items();
            $table->display();
        ?>  
    </form>
</div>