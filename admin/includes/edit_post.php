<?PHP
if (isset($_GET['p_id'])) {
    $pid = escape($_GET['p_id']);
    $query = "SELECT * FROM products WHERE p_id={$pid}";
    $post_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($post_by_id)) {
        $id = $row['p_id'];
        $p_name = $row['p_name'];
        $post_image = $row['p_img'];
        $p_unit = $row['p_unit'];
        $p_status = $row['p_status'];
        $p_cat = $row['p_cat'];
    }
}
if (isset($_POST['update_post'])) {

    $p_name = escape($_POST['title']);
    $p_unit = escape($_POST['p_unit']);
    $category_id = escape($_POST['post_category']);
    $p_status = escape($_POST['p_status']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $img = explode(".", $post_image);
    $extension = $img[count($img) - 1];
    $post_image = $extension;
    move_uploaded_file($post_image_temp, "../assets/products/images/$id" . '.' . $extension);

    if (empty($post_image)) {

        $query = "SELECT * FROM products WHERE p_id=$id";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['p_img'];
        }
    }

    $query  = "UPDATE products SET ";
    $query .= "p_cat = {$category_id}, ";
    $query .= "p_name = '{$p_name}', ";
    $query .= "p_unit = '{$p_unit}', ";
    $query .= "p_img = '{$post_image}', ";
    $query .= "p_status = '{$p_status}' ";
    $query .= "WHERE p_id = {$pid} ";
    //          

    $update_post = mysqli_query($connection, $query);
    confirm($update_post);
    echo "<p class='bg-success'>Product Updated :   " . "<a href='posts.php'>Edit More Products</a></p>";
}


?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Product Title</label>
        <input value="<?php echo $p_name; ?>" type="text" class="form-control" name="title" required>
    </div>

    <div class="form-group">
        <label for="p_unit">Product Unit</label>
        <input value="<?php echo $p_unit; ?>" type="text" class="form-control" name="p_unit" required>
    </div>

    <div class="form-group">
        <label for="post_category">Categories</label>
        <select name="post_category" class="form-control" id="">
            <?php

            $query = "SELECT * FROM categories";
            $categories_ids = mysqli_query($connection, $query);

            confirm($categories_ids);
            while ($row = mysqli_fetch_assoc($categories_ids)) {
                $cat_id   = $row['id'];
                $cat_title = $row['name'];


                if ($cat_id == $p_cat) {

                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                } else {
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            ?>

        </select>
    </div>


    <div class="form-group">
        <label for="p_status">Product Status</label>
        <select name="p_status" class="form-control">
            <option value="<?php echo $p_status; ?>"><?php echo $p_status; ?></option>
            <?php

            if ($p_status == 'Published') {

                echo "<option value= 'draft'>Draft</option>";
            } else {
                echo "<option value= 'Published'>Publish</option>";
            }



            ?>
        </select>
    </div>




    <div class="form-group">
        <img src='../assets/products/images/<?php echo $id . '.' . $post_image; ?>' alt='../assets/products/images/<?php echo $id . '.' . $post_image; ?>' width="100">
        <input type="file" name="image">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Product">
    </div>


</form>