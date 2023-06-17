<?php
namespace CustomPopup\Notification\Admin;

class Settings
{
    public function settings_page()
    {
        if (isset($_POST['update_settings'])) {
            $popup_position = $_POST['popup_position'];
            update_option('popup_position', $popup_position);
            $image_selection = $_POST['image_selection'];
            update_option('image_selection', $image_selection);
        }
        ?>
        <div class="wrap">
            <h1>Notification Settings</h1>
            <form method="post" action="">
                <?php
                // Output a nonce field for security
                wp_nonce_field('popup_settings_nonce', 'popup_settings_nonce');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Popup Position:</th>
                        <td>
                            <select name="popup_position">
                                <option value="left" <?php selected(get_option('popup_position'), 'left'); ?>>Left</option>
                                <option value="right" <?php selected(get_option('popup_position'), 'right'); ?>>Right</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Image Selection:</th>
                        <td>
                            <?php
                            $image_selection = get_option('image_selection', 'image1');
                            $image_directory = CPN_ASSETS . '/images/';
                            ?>
                            <label for="image1">
                                <input type="radio" name="image_selection" id="image1" value="image1" <?php checked($image_selection, 'image1'); ?>>
                                <img src="<?php echo $image_directory . 'layout1.png'; ?>" alt="Image 1">
                            </label><br>
                            <label for="image2">
                                <input type="radio" name="image_selection" id="image2" value="image2" <?php checked($image_selection, 'image2'); ?>>
                                <img src="<?php echo $image_directory . 'layout2.png'; ?>" alt="Image 2">
                            </label><br>
                            <label for="image3">
                                <input type="radio" name="image_selection" id="image3" value="image3" <?php checked($image_selection, 'image3'); ?>>
                                <img src="<?php echo $image_directory . 'layout3.png'; ?>" alt="Image 3">
                            </label>
                        </td>
                    </tr>
                </table>
                <?php submit_button(__('Update Settings', 'custom-popup-notification'), 'primary', 'update_settings'); ?>
            </form>
        </div>
        <?php
    }
}
