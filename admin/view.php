<?php
// view.php

function custom_admin_page_callback() {
    if (isset($_POST['submit'])) {
        // Process form data here
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        // Handle image upload
        $image = $_FILES['image'];
        $image_path = wp_upload_dir()['path'] . '/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $image_path);
    }
?>

<div class="wrap">
    <h1>Add New Item</h1>

    <form method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tr>
                <th><label for="title">Title</label></th>
                <td>
                    <input type="text" id="title" name="title" value="<?php echo isset($title) ? $title : ''; ?>" required>
                </td>
            </tr>
            <tr>
                <th><label for="description">Short Description</label></th>
                <td>
                    <textarea id="description" name="description" rows="5" required><?php echo isset($description) ? $description : ''; ?></textarea>
                </td>
            </tr>
            <tr>
                <th><label for="image">Image Upload</label></th>
                <td>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="submit" value="Save" class="button-primary">
        </p>
    </form>
</div>

<?php
}
?>
