<?php

namespace CustomPopup\Notification\Frontend;

/**
 * The Main handler class
 */
class Main
{
    public function __construct()
    {
        add_action('wp_footer', array($this, 'show_popup_modal'));
    }

    public function show_popup_modal()
{
    wp_enqueue_script('cpn-script');
    wp_enqueue_style('cpn-style');

    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cp_notification");

    $popup_position = get_option('popup_position', 'left');
    $popup_style = 'left: 20px;'; // Default style for left position

    if ($popup_position === 'right') {
        $popup_style = 'right: 20px;'; // Style for right position
    }

    $image_selection = get_option('image_selection', 'image1');
    $popup_container_class = 'popup-container';

    if ($image_selection === 'image2') {
        $popup_container_class = 'popup-container-2';
    } elseif ($image_selection === 'image3') {
        $popup_container_class = 'popup-container-3';
    }
    ?>

    <style>
        #popup_container {
            position: fixed;
            bottom: 20px;
            <?php echo $popup_style ?>
            z-index: 9999;
        }
    </style>

        <?php if ($image_selection === 'image1') : ?>
        
            <div id="popup_container">
                <?php foreach ($results as $notification) : ?>
                    <div class="popup">
                        <div class="popup-main">
                            <div class="notification-logo">
                                <img src="<?php echo wp_get_original_image_url($notification->product_image); ?>" alt="">
                            </div>
                            <div>
                                <h2 class="notification-title"><?php echo $notification->product_name; ?></h2>
                                <p class="notification-des"><?php echo $notification->ps_description; ?> </p>
                                <a href="<?php echo $notification->product_url; ?>" class="notification-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($image_selection === 'image2') : ?>
            <h1>Hi Bangla</h1>
        <?php elseif ($image_selection === 'image3') : ?>
            <h1>Hi Englis</h1>
    <?php endif; ?>
    <?php
}

}
