 <form action="" method="post">
     <div class="form-group">
         <label for="cat_title">Edit Category</label>

         <!-- UPDATE QUERY --> <?php

                                if (isset($_GET['edit'])) {
                                    $cat_id   = escape($_GET['edit']);
                                    $query = "SELECT * FROM categories WHERE id = $cat_id ";
                                    $categories_ids = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($categories_ids)) {
                                        $cat_id   = $row['id'];
                                        $cat_title = $row['name'];

                                ?>

                 <input value="<?php if (isset($cat_title)) {
                                            echo $cat_title;
                                        }  ?>" class="form-control" type="text" name="cat_title">

         <?php   }
                                }

            ?>
         <!-- UPDATE QUERY --> <?php

                                if (isset($_POST['update_category'])) {
                                    $the_cat_title = escape($_POST['cat_title']);

                                    $query = "UPDATE categories SET name = '{$the_cat_title}' WHERE id = {$cat_id} ";
                                    $update_query = mysqli_query($connection, $query);
                                    if (!$update_query) {
                                        die("QUERY FAILED " . mysqli_error($connection));
                                    }
                                    header("location: categories.php");
                                }
                                ?>
     </div>
     <div class="form-group">
         <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
     </div>
 </form>