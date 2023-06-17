<div class="wrap">
    <h1><?php _e( 'New Address', 'custom-popup-notification' ); ?></h1>

    <?php // var_dump( $this->errors ); ?>

    <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <table class="form-table">
            <tbody>
            <tr class="row<?php echo $this->has_error( 'product_name' ) ? ' form-invalid' : '' ;?>">
                <th scope="row">
                    <label for="product_name"><?php _e( 'Product Name', 'custom-popup-notification' ); ?></label>
                </th>
                <td>
                    <input type="text" name="product_name" id="product_name" class="regular-text" value="">
                    <?php if ( $this->has_error( 'product_name' ) ) { ?>
                        <p class="name error"><?php echo $this->get_error( 'product_name' ); ?></p>
                    <?php } ?>
                </td>
            </tr>

            <tr class="row<?php echo $this->has_error( 'ps_description' ) ? ' form-invalid' : '' ;?>">
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

            <tr class="row<?php echo $this->has_error( 'product_url' ) ? ' form-invalid' : '' ;?>">
                <th scope="row">
                    <label for="product_url"><?php _e( 'Product URL', 'custom-popup-notification' ); ?></label>
                </th>
                <td>
                    <input type="url" name="product_url" id="product_url" class="regular-text" value="">
                    <?php if ( $this->has_error( 'product_url' ) ) { ?>
                        <p class="url error"><?php echo $this->get_error( 'product_url' ); ?></p>
                    <?php } ?>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <input type="hidden" name="action" value="product_image"/>
                    <label for="product_image"><?php _e('Featured Image', 'custom-popup-notification'); ?></label>
                </th>

                <td>
                    <input type="file" name="product_image" id="product_image" class="regular-text" value="">
                </td>
            </tr>
            </tbody>
        </table>

        <?php wp_nonce_field( 'new-notification' ); ?>
        <?php submit_button( __( 'Save Notification', 'custom-popup-notification' ), 'primary', 'submit_notification' ); ?>
    </form>
</div>