<?php

include ("delete_modal.php"); 




?>



   <table class="table  table-bordered table-hover table-responsive">
                         <thead>
                           
                              <th>Id</th>              
                              <th>Post_id</th>
                              <th>Title</th>
                              <th>Author</th>
                              <th>Status</th>
                              <th>File Name</th>
                              <th>Language</th>
                              <th>Publish<th>
                             
                              <th>Edit</th>
                              <th>Delete</th>
                             
                           </thead>
                           <tbody>
         <?php 
          
                               
         

             if(isset($_SESSION['username'])){
              $user =  $_SESSION['username'];
            }
            if(isset($_SESSION['user_role'])){

              $role = $_SESSION['user_role'];
              }
              else
                $role = '';

              $query = "SELECT * FROM codes ORDER BY id DESC";
                     
                               
           $all_code_data = mysqli_query($connection , $query);
                               confirm($all_code_data);
           while($row = mysqli_fetch_assoc($all_code_data))
           {
               $id = $row['id'];
               $post_id = $row['post_id'];
               $code_author = $row['code_author'];
               $code_title = $row['code_title'];
               $code_status = $row['code_status'];
               $language = $row['language'];
               $filename = $row['code'];
           
               
               echo "<tr>";
                                
               echo "<td>{$id}</td>";
                
               echo "<td>$post_id</td>";
               
               echo "<td>{$code_title}</td>"; 
                
               echo "<td>$code_author</td>";
  
               echo "<td>{$code_status}</td>";
               
               echo "<td>{$filename}</td>";
               
               echo "<td>{$language}</td>";
           
               echo "<td><a href='codes.php?publish={$id}'>Publish</a></td>";
               echo "<td><a href='codes.php?draft={$id}'>Draft</a></td>";
      
               echo "<td><a class='btn btn-info' href='codes.php?source=edit_code&edit_code={$id}'>Edit</a></td>";  
               echo "<td><a class='btn btn-primary' href='codes.php?delete={$id}&filename=$filename'>Delete</a></td>";
              
               echo "</tr>";
           }
         ?>
                        





         <?php
          
            if(isset($_GET['delete'])&& isset($_GET['filename']))
            {
                $id = escape($_GET['delete']);
             
                $query = "DELETE FROM codes WHERE id = {$id} ";
                $delete_query = mysqli_query($connection , $query);
               
               
                header("location: codes.php");
            }
             if(isset($_GET['publish']))
            {
                $id = escape($_GET['publish']);
                $query = "UPDATE codes SET code_status = 'publish' WHERE id = {$id} ";
                $publish_query = mysqli_query($connection , $query);
                
               
                header("location: codes.php");
            }

           if(isset($_GET['draft']))
            {
                $id = escape($_GET['draft']);
                $query = "UPDATE codes SET code_status = 'draft' WHERE id = {$id} ";
                $draft_query = mysqli_query($connection , $query);
                
               
                header("location: codes.php");
            }
         

                               
        ?>      
        

                               
           </tbody>
        </table>
      </form> 