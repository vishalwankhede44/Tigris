<?PHP
         if(isset($_GET['edit_code']))
         {
           $the_code_id=escape($_GET['edit_code']);  
         }

        if(isset($_GET['edit_code']))
         {
          
            
           $query = "SELECT * FROM codes WHERE id={$the_code_id}";
           $code_by_id = mysqli_query($connection , $query);
             
           while($row = mysqli_fetch_assoc($code_by_id))
           {
               
               $post_id = $row['post_id'];
               $code_title = $row['code_title'];
               $code_author = $row['code_author'];
               $filename = $row['code'];
               $language = $row['language'];
               $code_status = $row['code_status'];
           }
        
      }
       else {
       header("Location:  index.php");
     }
      if(isset($_POST['update_code'])){
            
               $post_id = escape($_POST['post_id']);
               $code_title = escape($_POST['title']);
               $code_author = escape($_POST['author']);
               $language = escape($_POST['language']);
               $code_status = escape($_POST['code_status']);
       
        
         
             
 
          $query  = "UPDATE codes SET ";
          $query .= "post_id = {$post_id}, ";
          $query .= "code_title = '{$code_title}', ";
          $query .= "code_author = '{$code_author}', ";
          $query .= "code_status = '{$code_status}', ";
          $query .= "language = '{$language}' ";
          $query .= "WHERE id = {$the_code_id} ";
//          
          
        $update_code= mysqli_query($connection , $query);
    
        echo "<p class='bg-success'>Code Updated :   ". "<a href='codes.php'>View All Codes</a></p>";
      }
     
?>


<form action="" method="post" enctype="multipart/form-data">

   
     <div class="form-group">
        <label for="cat">Select Post Id</label>
      <select name="post_id" class="form-control" id="" >
    <?php  
      
           $user_query = "SELECT * FROM posts";
           $select_users = mysqli_query($connection , $user_query) ;
    
      
           while($row = mysqli_fetch_assoc($select_users)){
              $post_ids   = $row['post_id'];
              if($post_id == $post_ids)
                 echo "<option selected value=$post_ids>{$post_ids}</option>" ;
                 else
                  echo "<option value=$post_ids>{$post_ids}</option>" ;
       
           }
    ?>  
          
        </select>
    </div>
    <div class="form-group">
      <label for="title">Code Title</label> 
       <input type="text" class="form-control" name="title" value="<?php echo $code_title; ?>" required>
  </div>
    
     <div class="form-group">
      <label for="author">Code Author</label> 
       <input type="text" class="form-control" name="author" value="<?php echo $code_author; ?>" required>
  </div>
  

    <div class="form-group">
    <label for="title">Code Status</label>
    <select name="code_status" class="form-control">
            <option  value="draft">Draft</option> 

    </select>
        </div>

   
    
    <div class="form-group">
      <label for="post_category">Programming Language</label> 
       <input type="text" class="form-control" name="language" value="<?php echo $language; ?>" required>
    </div>
    
    
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_code" value="Update Code">
    
    </div>


</form>
