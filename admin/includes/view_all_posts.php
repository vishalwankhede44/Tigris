<?php

include("delete_modal.php");




?>

<form action="" method="post">

  <table class="table  table-bordered table-hover table-responsive">

    <thead>

      <th>Id</th>
      <th>Name</th>
      <th>Unit</th>
      <th>Category</th>
      <th>Image</th>
      <th>Status</th>
      <th>Edit</th>
      <th>Delete</th>
    </thead>
    <tbody>
      <?php


      // $query= "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
      // $query .= "FROM posts ";                       
      // $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";

      if (isset($_COOKIE['username'])) {
        $user =  $_COOKIE['username'];
      }


      if (isset($_COOKIE['user_role'])) {

        $role = $_COOKIE['user_role'];
      } else
        $role = '';

      $query = "SELECT * FROM products ORDER BY p_id DESC";

      $all_post_data = mysqli_query($connection, $query);
      confirm($all_post_data);
      while ($row = mysqli_fetch_assoc($all_post_data)) {
        $id = $row['p_id'];
        $product_name = $row['p_name'];
        $product_img = $row['p_img'];
        $product_unit = $row['p_unit'];
        $category_id = $row['p_cat'];
        $product_status = $row['p_status'];

        echo "<tr>";
      ?>


      <?php
        echo "<td>{$id}</td>";

        echo "<td>{$product_name}</td>";

        echo "<td>{$product_unit}</td>";

        $query = "SELECT * FROM categories WHERE id = $category_id ";
        $categories_ids = mysqli_query($connection, $query);
        confirm($categories_ids);
        while ($rw = mysqli_fetch_assoc($categories_ids)) {
          $cat_title = $rw['name'];
          echo "<td>{$cat_title}</td>";
        }



        echo "<td><img src='../assets/products/images/$id" . "." . "$product_img' alt='../assets/products/images/$id." . ".$product_img' height=40px;width=100px</img></td>";
        echo "<td><a class='btn btn-primary' href='posts.php?source=delete_post&p_id={$id}'>Publish</a></td>";
        echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$id}'>Edit</a></td>";
        echo "<td><a rel='$id' href='javascript:void(0)' class='delete_link btn btn-danger'>Delete</a></td>";

        echo "</tr>";
      }
      ?>






      <?php

      if (isset($_GET['delete'])) {
        $pid = escape($_GET['delete']);
        $query = "DELETE FROM products WHERE p_id = {$pid} ";
        $delete_query = mysqli_query($connection, $query);
        header("location: posts.php");
      }
      ?>
      <script type="text/javascript">
        $(document).ready(function() {

          $(".delete_link").on('click', function() {

            var id = $(this).attr("rel");

            var delete_url = "posts.php?delete= " + id + " ";

            $(".modal_delete_link").attr("href", delete_url);


            $("#myModal").modal('show');

          });

        });
      </script>



    </tbody>
  </table>
</form>