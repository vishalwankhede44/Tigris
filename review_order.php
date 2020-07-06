<?php ob_start(); ?>
<?php include "admin/includes/db.php"; ?>
<?php include "admin/function.php"; ?>
<?php
if (isset($_GET['oid'])) {
    $oid = $_GET['oid'];
    if (checkReview($oid)) {
        header("Location: your_orders.php");
    }
} else {
    header("Location: your_orders.php");
}
?>

<?php
if (isset($_POST['submitreview'])) {
    $name  = $_POST['nameInput'];
    $msg = $_POST['message'];
    $ratings = $_POST['stars'];

    addReview($name, $msg, $ratings, $oid);
?>
    <script>
        alert("Thank you for feedback");
        window.location.href = "your_orders.php";
    </script>
<?php
}

?>

<?php include "includes/header.php"; ?>
<header>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4 offset-sm-4 text-center">
                <h2 class="my-md-3 site-title text-white p-3 p-md-0">Tigris Enterprises</h2>
            </div>
            <?php if (!isset($_COOKIE['uid'])) { ?>
                <div class="col-12 col-sm-4 text-right">
                    <p class="my-md-4 header-links">
                        <a href="account/login.php" class="px-2">Sign In</a>
                        <a class="vl px-1"></a>
                        <a href="account/signup.php" class="px-1">Create an Account</a>
                    </p>
                </div>
            <?php } else { ?>
                <div class="col-12 col-sm-4 text-right">
                    <p class="my-md-4 header-links">
                        <a href="account/logout.php" role="button" class="px-2 btn btn-outline-light"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item mt-2 mt-sm-0">
                        <a class="nav-link" href="view_product.php">SHOP <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mt-2 mt-sm-0">
                        <a class="nav-link" href="aboutus.php">ABOUT US</a>
                    </li>
                    <?php if (isset($_COOKIE['uid'])) {
                        $role = $_COOKIE['user_role'];
                        if ($role == "Customer") {
                    ?>
                            <li class="nav-item mt-2 mt-sm-0 active">
                                <a class="nav-link" href="your_orders.php">My Orders</a>
                            </li>
                        <?php } else if ($role == "Employee") { ?>
                            <li class="nav-item mt-2 mt-sm-0">
                                <a class="nav-link" href="neworders.php">New Orders</a>
                            </li>
                            <li class="nav-item mt-2 mt-sm-0">
                                <a class="nav-link" href="oldorders.php">Previous Orders</a>
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
<main>
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-sm-4 offset-sm-1 my-3">
                <h4 class="text-center contact-us-text text-white">Order Review</h4>
                <form method="post" action=<?php echo "review_order.php?oid=" . $oid; ?>>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nameInput" id="nameInput" aria-describedby="emailHelp" placeholder="Enter Your Name">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Feedback ..."></textarea>
                    </div>
                    <div class="rating">
                        <label>
                            <input type="radio" name="stars" value="1" />
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="stars" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </div>
                    <br>
                    <button type="submit" name="submitreview" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>


<?php include "includes/footer.php"; ?>