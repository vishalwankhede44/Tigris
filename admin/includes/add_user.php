<?php
if (isset($_POST['create_user'])) {

    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);
    $user_email = escape($_POST['user_email']);
    $user_mob = escape($_POST['mobile']);
    register_employee($username, $user_email, $user_password, $user_mob);
}
?>
<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>


    <div class="form-group">
        <label for="username">Mobile</label>
        <input type="text" class="form-control" name="mobile" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" required>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" required>
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">

    </div>


</form>