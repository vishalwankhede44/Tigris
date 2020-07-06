<?PHP
         if(isset($_GET['edit_user']))
         {
           $the_user_id=escape($_GET['edit_user']);  
         }

        if(isset($_GET['edit_user']))
         {
            
           $query = "SELECT * FROM users WHERE user_id={$the_user_id}";
           $user_by_id = mysqli_query($connection , $query);
             
           while($row = mysqli_fetch_assoc($user_by_id))
           {
               
               $username = $row['username'];
               $user_password = $row['user_password'];
               $user_firstname = $row['user_firstname'];
               $user_lastname = $row['user_lastname'];
               $user_email = $row['user_email'];
//               $user_image = $row['user_image'];
               $user_role = $row['user_role'];
           }
        
      if(isset($_POST['update_user'])){
            
               $username = escape($_POST['username']);
               $user_password = escape($_POST['user_password']);
               $user_firstname = escape($_POST['user_firstname']);
               $user_lastname = escape($_POST['user_lastname']);
               $user_email = escape($_POST['user_email']);
               $user_role = escape($_POST['user_role']);
          
           $query ="SELECT randSalt FROM users";
           $select_randsalt_query = mysqli_query($connection , $query);
           
           if(!$select_randsalt_query){
               die("QUERY FAILED " . mysqli_error($connection));
           }
           
          $row = mysqli_fetch_array($select_randsalt_query);
          $salt = $row['randSalt'];
          $hashed_password = crypt($user_password, $salt);
      
          if(!empty($user_password)){
              $query_password =  "SELECT * FROM users WHERE user_id = $the_user_id";
              $get_user = mysqli_query($connection , $query_password);
              confirm($get_user);

              $row =  mysqli_fetch_array($get_user);

              $db_user_password = $row['user_password'];


          
       
          if($db_user_password != $user_password){

            $hashed_password = password_hash( $user_password , PASSWORD_BCRYPT, array('cost' => 10)); 
          }

          $query  = "UPDATE users SET ";
          $query .= "username = '{$username}', ";
          $query .= "user_password = '{$hashed_password}', ";
          $query .= "user_firstname = '{$user_firstname}', ";
          $query .= "user_lastname = '{$user_lastname}', ";
          $query .= "user_email = '{$user_email}', ";
          $query .= "user_role = '{$user_role}' ";
          $query .= "WHERE user_id = {$the_user_id} ";
//          
          
        $update_post= mysqli_query($connection , $query);
        confirm($update_post);
        echo "<p class='bg-success'>User Updated :   ". "<a href='users.php'>View All Users</a></p>";
      }
      }

     } else {
       header("Location:  index.php");
     }
?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname" required>
    </div>

    <div class="form-group">
        <label for="post_category">Lastname</label>
        <input type="text" class="form-control" value="<?php echo $user_lastname; ?>"  name="user_lastname" required>
    </div>

    <div class="form-group">
        <select name="user_role" class="form-control" id="">
            <option selected value="Admin">Admin</option>  
            <?php
             $query = "SELECT user_role FROM users WHERE user_id={$the_user_id}";
             $user_by_id = mysqli_query($connection , $query);
             $row = mysqli_fetch_assoc($user_by_id);
             $user_role = $row['user_role'];
              if($user_role == 'Subscriber'){
                 ?> <option selected value="Subscriber">Subscriber</option>  <?php
              }
            else
            {
                ?> <option value="Subscriber">Subscriber</option>  <?php
            }
            ?>
            
            
        </select>
    </div>    
    <!--
    <div class="form-group">
      <label for="post_category">Post Image</label> 
       <input type="file" class="form-control" name="image" required>
    </div>
-->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" value="<?php echo $username; ?>"  name="username" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email" required>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" value="<?php //echo $user_password; ?>" name="user_password" required >
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update User">

    </div>


</form>
