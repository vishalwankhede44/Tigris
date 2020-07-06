<?php
if (isset($_POST['add_product'])) {
  $p_name = escape($_POST['title']);
  $p_unit = escape($_POST['unit']);
  $product_category = escape($_POST['product_category']);
  $p_status = escape($_POST['status']);

  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];

  $img = explode(".", $post_image);

  $extension = $img[count($img) - 1];


  $query = "INSERT INTO products(p_name,p_img,p_unit,p_status,p_cat)  ";

  $query .= "VALUES('{$p_name}','{$extension}','{$p_unit}','{$p_status}',{$product_category}) ";

  $create_post_query = mysqli_query($connection, $query);

  confirm($create_post_query);
  $id = mysqli_insert_id($connection);
  move_uploaded_file($post_image_temp, "../assets/products/images/$id" . '.' . $extension);
  echo "<p class='bg-success'>Product Added :   " . "<a href='posts.php'>View All Products</a></p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Product Name</label>
    <input type="text" class="form-control" name="title" required>
  </div>

  <div class="form-group">
    <label for="post_category">Product Unit</label>
    <input type="text" class="form-control" name="unit" required>
  </div>

  <div class="form-group">
    <label for="cat">Category </label>
    <select name="product_category" class="form-control" id="">
      <?php

      $query = "SELECT * FROM categories";
      $categories_ids = mysqli_query($connection, $query);

      confirm($categories_ids);
      while ($row = mysqli_fetch_assoc($categories_ids)) {
        $cat_id   = $row['id'];
        $cat_title = $row['name'];

        echo "<option value='$cat_id'>{$cat_title}</option>";
      }
      ?>

    </select>
  </div>

  <?php


  ?>

  <div class="form-group">
    <label for="title">Product Status</label>
    <select name="status" class="form-control">
      <option value="draft">Draft</option>
      <option value="Published">Publish</option>
    </select>
  </div>

  <div class="form-group">
    <label for="image">Product Image</label>
    <input type="file" class="form-control" name="image" required>
  </div>


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="add_product" value="Add Product">
  </div>


</form>