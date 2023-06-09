<div class="wrap">
    <h1><?php _e('Edit Notification', 'custom-popup-notification'); ?></h1>

    <?php if (isset($_GET['notification-updated'])) { ?>
        <div class="notice notice-success">
            <p><?php _e('Notification has been updated successfully!', 'wedevs-academy'); ?></p>
        </div>
    <?php } ?>
<?php var_dump($_POST)?>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tbody>
            <tr class="row<?php echo $this->has_error('product_name') ? ' form-invalid' : ''; ?>">
                <th scope="row">
                    <label for="product_name"><?php _e('Product Name', 'custom-popup-notification'); ?></label>
                </th>
                <td>
                    <input type="text" name="product_name" id="product_name" class="regular-text" value="<?php echo esc_attr($notification->product_name) ?>">
                    <?php if ($this->has_error('product_name')) { ?>
                        <p class="name error"><?php echo $this->get_error('product_name'); ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr class="row<?php echo $this->has_error('ps_description') ? ' form-invalid' : ''; ?>">
                <th scope="row">
                    <label for="ps_description"><?php _e('Products short description', 'custom-popup-notification'); ?></label>
                </th>
                <td>
                    <textarea class="regular-text" name="ps_description" id="ps_description"><?php echo esc_textarea($notification->ps_description) ?></textarea>
                    <?php if ($this->has_error('ps_description')) { ?>
                        <p class="description error"><?php echo $this->get_error('ps_description'); ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr class="row<?php echo $this->has_error('product_url') ? ' form-invalid' : ''; ?>">
                <th scope="row">
                    <label for="product_url"><?php _e('Product URL', 'custom-popup-notification'); ?></label>
                </th>
                <td>
                    <input type="url" name="product_url" id="product_url" class="regular-text" value="<?php echo esc_attr($notification->product_url) ?>">
                    <?php if ($this->has_error('product_url')) { ?>
                        <p class="url error"><?php echo $this->get_error('product_url'); ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr class="row<?php echo $this->has_error('product_image') ? ' form-invalid' : ''; ?>">
                <th scope="row">
                    <label for="product_image"><?php _e('Product Image', 'custom-popup-notification'); ?></label>
                </th>
                <td>
                    <input type="file" name="product_image" id="product_image">
                    <?php if ($notification->product_image) { ?>
                        <p><img src="<?php echo wp_get_attachment_image_url($notification->product_image); ?>" alt="Product Image" style="max-width: 300px;"></p>
                    <?php } else { ?>
                        <p><?php _e('No image available', 'custom-popup-notification'); ?></p>
                    <?php } ?>
                    <?php if ($this->has_error('product_image')) { ?>
                        <p class="image error"><?php echo $this->get_error('product_image'); ?></p>
                    <?php } ?>
                </td>
            </tr>
            </tbody>
        </table>

        <input type="hidden" name="id" value="<?php echo esc_attr($notification->id); ?>">
        <?php wp_nonce_field('new-notification'); ?>
        <?php submit_button(__('Update Notification', 'custom-popup-notification'), 'primary', 'submit_notification'); ?>
    </form>
</div>
