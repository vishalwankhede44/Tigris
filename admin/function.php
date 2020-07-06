<?php ob_start(); ?>
<?php

/*
    function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;


    }


   return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}


  



     
    
    function is_admin($username = ''){
        global $connection;

        $query = "SELECT user_role FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        confirm($result);

        $row = mysqli_fetch_assoc($result);

        if($row['user_role'] == 'Admin'){
            return true;
        }
        else
         {
          return false;
         }  

    }
    
   
   function checkStatus($table , $column , $status)
   {
       global $connection;
        $query = "SELECT * FROM ".$table." WHERE ".$column." = '$status' ";
        $count_col = mysqli_query($connection , $query);
        $result = mysqli_num_rows($count_col);
         return $result;

        
   }
   


   function users_online() {



    if(isset($_GET['onlineusers'])) {

    global $connection;

    if(!$connection) {

        session_start();

        include("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

            if($count == NULL) {

            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");


            } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");


            }

        $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online_query);


    }






    } // get request isset()


}

users_online();



*/

function redirect($red)
{
    header("Location: " . $red);
    exit();
}

function register_employee($username, $email, $password, $mobile)
{
    global $connection;


    $username = mysqli_real_escape_string($connection, $username);
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $mobile   = mysqli_real_escape_string($connection, $mobile);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));


    $query = "INSERT INTO employees(username,emp_email,emp_password,user_role,emp_mobile) ";
    $query .= "VALUES('{$username}','{$email}', '{$password}',  'Employee','{$mobile}' ) ";
    $register_user_query = mysqli_query($connection, $query);
    confirm($register_user_query)
?>
    <script type="text/javascript">
        alert("Employee Added Successfully");
    </script>
    <?php

}
function register_user($username, $email, $password, $mobile)
{
    global $connection;


    $username = mysqli_real_escape_string($connection, $username);
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $mobile   = mysqli_real_escape_string($connection, $mobile);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));


    $query = "INSERT INTO customers(name,user_email,user_password,mobile) ";
    $query .= "VALUES('{$username}','{$email}', '{$password}',  '{$mobile}' ) ";
    $register_user_query = mysqli_query($connection, $query);
    confirm($register_user_query);
}

function login_user($useremail, $password)
{

    global $connection;


    $useremail = mysqli_real_escape_string($connection, $useremail);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM customers WHERE user_email= '{$useremail}' ";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED " . mysqli_error($connection));
    } else {

        while ($row = mysqli_fetch_array($select_user_query)) {

            $db_user_id = $row['c_id'];
            $db_username = $row['name'];
            $db_user_password = $row['user_password'];
            if (password_verify($password, $db_user_password)) {
                setcookie("uid", $db_user_id, time() + (86400 * 10), "/");
                setcookie("username", $db_username, time() + (86400 * 10), "/");
                setcookie("user_role", "Customer", time() + (86400 * 10), "/");
                header("Location: ../index.php");
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    return false;
}

function login_emp($username, $password)
{

    global $connection;


    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM employees WHERE emp_email= '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED " . mysqli_error($connection));
    } else {

        while ($row = mysqli_fetch_array($select_user_query)) {

            $db_user_id = $row['e_id'];
            $db_user_email = $row['emp_email'];
            $db_user_password = $row['emp_password'];
            $db_username = $row['username'];
            $db_user_role = $row['user_role'];
            date_default_timezone_set('Asia/Kolkata');
            if (password_verify($password, $db_user_password)) {
                $expire_time  =  24 - (int) date("H");
                setcookie("uid", $db_user_id, time() + (3600 * $expire_time), "/");
                setcookie("username", $db_username, time() + (3600 * $expire_time), "/");
                setcookie("user_role", $db_user_role, time() + (3600 * $expire_time), "/");
                setcookie("map_link", "Undefined", time() + (3600 * $expire_time), "/");
                if ($db_user_role == "Employee")
                    header("Location: ../neworders.php");
                else
                    header("Location: ../admin/index.php");
            } else {
    ?>
                <script>
                    alert("Invalid Credentials");
                </script>
<?php
            }
        }
    }
    return true;
}

function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}
function email_exists($email)
{
    global $connection;

    $query = "SELECT user_email FROM customers WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirm($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {

        return false;
    }
}


function  mobile_exists($mobile)
{
    global $connection;

    $query = "SELECT name FROM customers WHERE mobile = '$mobile'";
    $result = mysqli_query($connection, $query);
    confirm($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {

        return false;
    }
}

function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {

            echo "This field should not be empty";
        } else {

            $query = "INSERT INTO categories(name) ";
            $query .= "VALUE('{$cat_title}') ";


            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {

                die('QUERY FAILED' . mysqli_error($connection));
            } else {
                header("location: categories.php");
            }
        }
    }
}

function findAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $categories_all = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($categories_all)) {
        $cat_id   = $row['id'];
        $cat_name = $row['name'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_name}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
        echo "</tr>";
    }
}


function deleteCategories()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("location: categories.php");
    }
}

function escape($string)
{
    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function recordCount($table)
{
    global $connection;
    $post_query_count = "SELECT * FROM " . $table;
    $find_count = mysqli_query($connection, $post_query_count);
    $result = mysqli_num_rows($find_count);



    if ($result == null)
        $result = 0;

    return $result;
}

function checkReview($oid)
{
    global $connection;
    $post_query_count = "SELECT * FROM reviews WHERE oid=" . $oid;
    $find_count = mysqli_query($connection, $post_query_count);
    $result = mysqli_num_rows($find_count);
    $flag = true;
    if ($result == null || $result == 0)
        $flag = false;

    return $flag;
}

function addReview($name, $msg, $ratings, $oid)
{
    global $connection;
    $name = escape($name);
    $msg = escape($msg);
    $oid = escape($oid);
    $ratings = escape($ratings);
    $query = "INSERT INTO reviews(r_by,oid,r_msg,r_star) ";
    $query .= "VALUES('{$name}',{$oid}, '{$msg}',{$ratings} ) ";
    $register_review_query = mysqli_query($connection, $query);
    confirm($register_review_query);
}

function insert_link($link, $id)
{
    global $connection;
    mysqli_query($connection, "UPDATE employees SET maplink = '{$link}' WHERE e_id = {$id}");
}
