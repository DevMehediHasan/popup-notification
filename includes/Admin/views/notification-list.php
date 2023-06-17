<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'All Notification', 'custom-popup-notification' ); ?></h1>

    <a href="<?php echo admin_url( 'admin.php?page=custom-popup-notification&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'custom-popup-notification' ); ?></a>

    <?php if ( isset( $_GET['inserted'] ) ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Notification has been added successfully!', 'custom-popup-notification' ); ?></p>
        </div>
    <?php } ?>

    <?php if ( isset( $_GET['notification-deleted'] ) && $_GET['notification-deleted'] == 'true' ) { ?>
        <div class="notice notice-success">
            <p><?php _e( 'Notification has been deleted successfully!', 'custom-popup-notification' ); ?></p>
        </div>
    <?php } ?>

    <form action="" method="POST">
        <?php
            $table = new CustomPopup\Notification\Admin\Notification_List();
            $table->prepare_items();
            $table->search_box( 'search', 'search_id' );
            $table->display();
        ?>  
    </form>
</div>