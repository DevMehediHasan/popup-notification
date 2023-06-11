<div class="wrap">
    <h1><?php _e( 'New Address', 'custom-popup-notification' ); ?></h1>

    <?php var_dump( $this->errors ); ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="product-name"><?php _e( 'Product Name', 'custom-popup-notification' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="product-name" id="product-name" class="regular-text" value="">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ps-description"><?php _e( 'Products short description', 'custom-popup-notification' ); ?></label>
                    </th>
                    <td>
                        <textarea class="regular-text" name="ps-description" id="ps-description"></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="product-url"><?php _e( 'Product URL', 'custom-popup-notification' ); ?></label>
                    </th>
                    <td>
                        <input type="url" name="product-url" id="product-url" class="regular-text" value="">
                    </td>
                </tr>
            </tbody>
        </table>

        <?php wp_nonce_field( 'new-notification' ); ?>
        <?php submit_button( __( 'Save Notification', 'custom-popup-notification' ), 'primary', 'submit_notification' ); ?>
    </form>
</div>