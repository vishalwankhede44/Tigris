
  <table class="table table-responsive table-bordered table-hover">
                           <thead>
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
           $query = "SELECT * FROM 'comments' WHERE comment_post_id = " . mysqli_real_escape_string($connection, $_GET['id']) .'';
           $all_comment_data = mysqli_query($connection , $query);
           while($row = mysqli_fetch_assoc($all_comment_data))
           {
               $comment_id = $row['comment_id'];
               $post_id = $row['comment_post_id'];
               $comment_author = $row['comment_author'];
               $comment_content = $row['comment_content'];
               $comment_email = $row['comment_email'];
               $comment_status = $row['comment_status'];
               $comment_date = $row['comment_date'];
               
               
               echo "<tr>";
               echo "<td>{$comment_id}</td>";
//               echo "<td>{$post_id}</td>";
               echo "<td>{$comment_author}</td>";
               echo "<td>{$comment_content}</td>";
              
//                  $query = "SELECT * FROM categories WHERE cat_id = $category_id ";
//                   $categories_ids = mysqli_query($connection , $query);
//                confirm($categories_ids);
//                   while($row = mysqli_fetch_assoc($categories_ids)){
//                        $cat_title = $row['cat_title'];
//                        echo "<td>{$cat_title}</td>"; 
//                       
//                     }  
//             
              
                     
               echo "<td>{$comment_email}</td>";                
               echo "<td>{$comment_status}</td>";

               $query= "SELECT * FROM posts WHERE post_id = $post_id";
               $select_post_id_query = mysqli_query($connection , $query);
               
               while($row = mysqli_fetch_assoc($select_post_id_query)){
                   
                   $post_id = $row['post_id'];
                   $post_title = $row['post_title'];
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                   
               }
                
                
               echo "<td>{$comment_date}</td>";
               echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
               echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
               echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
               echo "</tr>";
           }
         ?>
                               
         <?php
                               
             if(isset($_GET['approve']))
            {
                $cid = $_GET['approve'];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id=$cid";
                $approve_query = mysqli_query($connection , $query);
                header("location: comments.php");
                
            }                          
                               
            if(isset($_GET['unapprove']))
            {
                $cid = $_GET['unapprove'];
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id=$cid";
                $unapprove_query = mysqli_query($connection , $query);
                header("location: comments.php");
                
            }                   
          
            if(isset($_GET['delete']))
            {
                $cid = $_GET['delete'];
                $query = "DELETE FROM comments WHERE comment_id = {$cid} ";
                $delete_query = mysqli_query($connection , $query);
                header("location: comments.php");
                  $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
                  $query .= " WHERE post_id = $post_id ";

                   $comment_count = mysqli_query($connection , $query);
                   if(!$comment_count)
                  {
                      die ("QUERY FAILED ". mysqli_error($connection));
                  }

            }
                               
        ?>     

                               
           </tbody>
        </table>
          </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php   include "includes/admin_footer.php" ?>
 