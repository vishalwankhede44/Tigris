<?php include "../admin/includes/db.php"; ?>
<?php include "../admin/function.php"; ?>
<?php
if (isset($_COOKIE['uid'])) {
    header("Location: ../index.php");
}
?>
<?php

if (isset($_POST['signup'])) {


    $name = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $pass = trim($_POST['pass']);
    $re_pass = trim($_POST['re_pass']);

    $error = [
        'username' => '',
        'email' => '',
        'password' => '',
        'mobile' => ''

    ];

    if (strlen($name) < 4) {
        $error['username'] = "Username needs to be longer";
    }


    if ($name == '') {
        $error['username'] = "Username cannot be empty";
    }

    if (mobile_exists($mobile)) {
        $error['mobile'] = "Mobile Number already exists, use another";
    }
    if ($email == '' || empty($email)) {
        $error['email'] = "Email cannot be empty";
    }


    if (email_exists($email)) {
        $error['email'] = "Email already exists, <a href='index.php'>Please Login</a>";
    }



    if ($pass == '') {
        $error['password'] = "Password cannot be empty";
    }

    if ($pass != $re_pass) {
        $error['password'] = "Password Dosen't Match";
    }


    foreach ($error as $key => $value) {
        if (empty($value)) {

            unset($error[$key]);
        }
    }

    if (empty($error)) {

        register_user($name, $email, $pass, $mobile);

        login_user($email, $pass);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0077be" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

    <link rel="stylesheet" href="../css/style.css">
    <title>Sign Up - Eaqua</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        i {
            color: rgb(0, 127, 152);
        }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4 offset-sm-4 text-center">
                    <h3 class="my-md-3 site-title text-white p-3 p-md-0">Tigris Enterprises</h3>
                </div>
                <div class="col-12 col-sm-4 text-right">
                    <p class="my-md-4 header-links">
                        <a href="login.php" class="px-2">Sign In</a>
                        <a class="vl px-1"></a>
                        <a href="signup.php" class="px-1">Create an Account</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item mt-2 mt-sm-0">
                            <a class="nav-link" href="view_product.php">SHOP</a>
                        </li>
                        <li class="nav-item mt-2 mt-sm-0">
                            <a class="nav-link" href="aboutus.html">ABOUT US</a>
                        </li>
                        <?php if (isset($_COOKIE['uid'])) {
                            $role = $_COOKIE['user_role'];
                            if ($role == "Customer") {
                        ?>
                                <li class="nav-item mt-2 mt-sm-0">
                                    <a class="nav-link" href="your_orders.php">My Orders</a>
                                </li>
                            <?php } else if ($role == "Employee") { ?>
                                <li class="nav-item mt-2 mt-sm-0">
                                    <a class="nav-link" href="neworders.php">New Orders</a>
                                </li>
                                <li class="nav-item mt-2 mt-sm-0">
                                    <a class="nav-link" href="oldorders.php">Previous Orders</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item mt-2 mt-sm-0">
                                    <a class="nav-link" href="admin/index.php">Admin Panel</a>
                                </li>
                        <?php }
                        } ?>

                    </ul>
                </div>

                <div class="navbar-nav">
                    <li class="nav-item border rounded-circle mx-2 search-icon">
                        <i class="fa fa-search p-2" aria-hidden="true"></i>
                    </li>
                    <?php if (isset($_COOKIE['uid'])) {
                        $role = $_COOKIE['user_role'];
                        if ($role == "Customer") { ?>
                            <li class="nav-item border rounded-circle mx-2 basket-icon"><a href="carth.php" style="text-decoration: none;">
                                    <i class="fa fa-shopping-basket p-2" aria-hidden="true"></i></a>
                            </li>
                    <?php }
                    } ?>
                </div>

            </nav>
        </div>


    </header>
    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="login-container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title" style="color:rgb(0,127,152)">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="mobile" id="mobile" placeholder="Your Mobile Number" />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" style="background-color:rgb(0,127,152)" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup.png" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>




    </div>

    <!-- JS -->
    <script src="../node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>