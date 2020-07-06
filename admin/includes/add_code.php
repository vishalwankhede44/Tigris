<?php 
   if(isset($_POST['submit_code']))
   {
        $post_id= escape($_POST['post_id']);
       $code_title= escape($_POST['title']);
       $code_author= escape($_POST['author']);
       $code_status= escape($_POST['code_status']);
       $language = escape($_POST['language']);
       $source_code= $_FILES['text']['name'];
       $source_code_temp= $_FILES['text']['tmp_name'];
        
      
     
      
       move_uploaded_file( $source_code_temp,"../codes/files/$source_code" );
     // move_uploaded_file('1.txt',"../codes/files/$source_code" );
       
       $query = "SELECT post_id from codes";
       $code_post_id =  mysqli_query($connection , $query);
       $row = mysqli_fetch_assoc($code_post_id);
       if($row['post_id'] != $post_id)
       {      
       
       $query = "INSERT INTO codes(post_id,code_title,code_author,code,language,code_status)  ";
       
       $query .="VALUES({$post_id},'{$code_title}','{$code_author}','{$source_code}','{$language}','{$code_status}' ) ";
       
       $create_post_query =mysqli_query($connection , $query);
       
       confirm($create_post_query);
      
        }else{
           echo "<h3>SELECTED POST ID ALREADY HAVE CODE</h3>";
           } 
       
   }
?>

<form action="" method="post" enctype="multipart/form-data">

   
     <div class="form-group">
        <label for="cat">Select Post Id</label>
      <select name="post_id" class="form-control" id="">
    <?php  
      
           $user_query = "SELECT * FROM posts ORDER BY post_id DESC";
           $select_users = mysqli_query($connection , $user_query) ;
    
      
           while($row = mysqli_fetch_assoc($select_users)){
              $post_id   = $row['post_id'];
            echo "<option value=$post_id>{$post_id}</option>" ;
       
           }
    ?>  
          
        </select>
    </div>
    <div class="form-group">
      <label for="title">Code Title</label> 
       <input type="text" class="form-control" name="title" required>
  </div>
    
     <div class="form-group">
      <label for="author">Code Author</label> 
       <input type="text" class="form-control" name="author" required>
  </div>
  

    <div class="form-group">
    <label for="title">Code Status</label>
    <select name="code_status" class="form-control">
            <option  value="draft">Draft</option> 

    </select>
        </div>

    <div class="form-group">
      <label for="post_category">Source Code  </label> 
       <input type="file" accept="text/plain" class="form-control" name="text" required>
    </div>
    
    <div class="form-group">
      <label for="post_category">Programming Language</label> 
       <input type="text" class="form-control" name="language" required>
    </div>
    
    
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="submit_code" value="Request to Admin">
    
    </div>


</form>