<div class="wrap">
    <h1><?php _e( 'New Address', 'custom-popup-notification' ); ?></h1>

    <?php // var_dump( $this->errors ); ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
            <tr class="row<?php echo $this->has_error( 'product_name' ) ? ' form-invalid' : '' ;?>">
                    <th scope="row">
                        <label for="product_name"><?php _e( 'Product Name', 'custom-popup-notification' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="product_name" id="product_name" class="regular-text" value="">
                        <?php if ( $this->has_error( 'product_name' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'product_name' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="ps_description"><?php _e( 'Products short description', 'custom-popup-notification' ); ?></label>
                    </th>
                    <td>
                        <textarea class="regular-text" name="ps_description" id="ps_description"></textarea>
                        <?php if ( $this->has_error( 'ps_description' ) ) { ?>
                            <p class="description error"><?php echo $this->get_error( 'ps_description' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="product_url"><?php _e( 'Product URL', 'custom-popup-notification' ); ?></label>
                    </th>
                    <td>
                        <input type="url" name="product_url" id="product_url" class="regular-text" value="">
                    </td>
                </tr>
            </tbody>
        </table>

        <?php wp_nonce_field( 'new-notification' ); ?>
        <?php submit_button( __( 'Save Notification', 'custom-popup-notification' ), 'primary', 'submit_notification' ); ?>
    </form>
</div>