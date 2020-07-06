<?php include "../admin/includes/db.php"; ?>
<?php include "../admin/function.php"; ?>
<?php


if (isset($_POST['signin'])) {
    $name = escape($_POST['your_name']);
    $pass = escape($_POST['your_pass']);
    if (login_user($name, $pass)) {
        header("../index.php");
    } else {
?>
        <script>
            alert("Invalid Credentials");
        </script>
<?php
    }
}


if (isset($_COOKIE['uid'])) {
    header("Location: ../index.php");
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
    <title>Login In - Eaqua</title>

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
        <section class="sign-in">
            <div class="login-container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin.jpg" alt="sing up image"></figure>
                        <a href="elogin.php" class="signup-image-link">Are you an Employee ?</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title" style="color:rgb(0,127,152)">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action="login.php">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="your_name" id="your_name" placeholder="Your Email" required />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password" required />
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" style="background-color:rgb(31,139,165);" />
                                <a href="" style="text-decoration: none;color:rgb(31,139,165);">&emsp; Forgot Password</a>
                            </div>

                        </form>

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