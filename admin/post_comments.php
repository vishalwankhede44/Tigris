  <?php
    if ($_COOKIE['user_role'] != 'Admin') {
        header("Location: ../index.php");
    }


    ?>
  <?php


    if (isset($_POST['checkBoxArrray'])) {

        foreach ($_POST['checkBoxArrray'] as $commentValueId) {
            $bulk_options  = $_POST['bulk_options'];


            switch ($bulk_options) {

                case 'approved':
                    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id=$commentValueId";
                    $approve_query = mysqli_query($connection, $query);
                    header("location: post_comments.php");
                    break;

                case 'unapproved':
                    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id=$commentValueId";
                    $unapprove_query = mysqli_query($connection, $query);
                    header("location: post_comments.php");
                    break;
                case 'delete':
                    $query = "DELETE FROM comments WHERE comment_id = {$commentValueId} ";
                    $delete_query = mysqli_query($connection, $query);
                    header("location: post_comments.php");
                    if (!$delete_query) {
                        die("QUERY FAILED " . mysqli_error($connection));
                    }

                    break;
            }
        }
    }


    ?>

  <?php include "includes/admin_header.php"; ?>

  <div id="wrapper">

      <!-- Navigation -->

      <?php include "includes/admin_navigation.php"; ?>


      <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Welcome to Comments
                          <small><?php echo $_SESSION['username']; ?></small>
                      </h1>


                      <form action="" method="post">
                          <table class="table table-responsive table-bordered table-hover">
                              <div id="bulkOptionContainer" class="col-xs-6">

                                  <select class="form-control" name="bulk_options" id="">

                                      <option value="" id="">Select Options</option>
                                      <option value="approved" id="">Approve</option>
                                      <option value="unapproved" id="">Unapprove</option>
                                      <option value="delete" id="">Delete</option>

                                  </select>

                              </div>
                              <div class="col-xs-4">

                                  <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                  <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                              </div>
                              <thead>
                                  <th><input id="selectAllBoxes" type="checkbox"></th>
                                  <th>Id</th>
                                  <th>Author</th>
                                  <th>Comment</th>
                                  <th>Email</th>
                                  <th>Status</th>
                                  <th>In Response to</th>
                                  <th>Date</th>
                                  <th>Approve</th>
                                  <th>Unapprove</th>
                                  <th>Delete</th>
                              </thead>
                              <tbody>
                                  <?php
                                    if (isset($_GET['id'])) {
                                        $comment_post_get_id = $_GET['id'];
                                    }

                                    $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']) . "";
                                    $all_comment_data = mysqli_query($connection, $query);
                                    if (!$all_comment_data) {

                                        die("QUERY FAILED " . mysqli_error($connection));
                                    }
                                    while ($row = mysqli_fetch_assoc($all_comment_data)) {
                                        $comment_id = $row['comment_id'];
                                        $post_id = $row['comment_post_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_content = $row['comment_content'];
                                        $comment_email = $row['comment_email'];
                                        $comment_status = $row['comment_status'];
                                        $comment_date = $row['comment_date'];


                                        echo "<tr>";
                                    ?>
                                      <td><input class="checkBoxes" id="selectAllBoxes" type="checkbox" name="checkBoxArrray[]" value="<?php echo $comment_id;  ?>"></td>
                                  <?php
                                        echo "<td>{$comment_id}</td>";

                                        echo "<td>{$comment_author}</td>";
                                        echo "<td>{$comment_content}</td>";

                                        echo "<td>{$comment_email}</td>";
                                        echo "<td>{$comment_status}</td>";

                                        $query = "SELECT * FROM posts WHERE post_id = $post_id";
                                        $select_post_id_query = mysqli_query($connection, $query);

                                        while ($row = mysqli_fetch_assoc($select_post_id_query)) {

                                            $post_id = $row['post_id'];
                                            $post_title = $row['post_title'];
                                            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                        }


                                        echo "<td>{$comment_date}</td>";
                                        echo "<td><a href='post_comments.php?id=$comment_post_get_id&approve=$comment_id'>Approve</a></td>";
                                        echo "<td><a href='post_comments.php?id=$comment_post_get_id&unapprove=$comment_id'>Unapprove</a></td>";
                                        echo "<td><a href='post_comments.php?id=$comment_post_get_id&delete=$comment_id'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                              </tbody>
                          </table>
                      </form>
                      <?php

                        if (isset($_GET['approve'])) {
                            $cid = $_GET['approve'];
                            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id=$cid";
                            $approve_query = mysqli_query($connection, $query);
                            header("location: post_comments.php?id=$comment_post_get_id");
                        }

                        if (isset($_GET['unapprove'])) {
                            $cid = $_GET['unapprove'];
                            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id=$cid";
                            $unapprove_query = mysqli_query($connection, $query);
                            header("location: post_comments.php?id=$comment_post_get_id");
                        }

                        if (isset($_GET['delete'])) {
                            $cid = $_GET['delete'];
                            $query = "DELETE FROM comments WHERE comment_id = {$cid} ";
                            $delete_query = mysqli_query($connection, $query);
                            header("location: post_comments.php?id=$comment_post_get_id");
                        }

                        ?>
                  </div>
              </div>
              <!-- /.row -->

          </div>
          <!-- /.container-fluid -->

      </div>
      <!-- /#page-wrapper -->

      <?php include "includes/admin_footer.php" ?>