<?php include "admin/includes/db.php"; ?>
<?php include "admin/function.php"; ?>

<?php

if (!isset($_COOKIE['uid'])) {
    header("Location: index.php");
} else {
    $role = $_COOKIE['user_role'];
    if ($role != "Customer") {
        header("Location: index.php");
    }
    //echo "<h1>{$_COOKIE['uid']}</h1>";
}
$uid = $_COOKIE['uid'];
$query = "SELECT * FROM orders WHERE o_u_id={$uid}";
$all_order_data = mysqli_query($connection, $query);
confirm($all_order_data);
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
                        <a class="nav-link" href="aboutus.html">ABOUT US</a>
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
            <div class="col-10 offset-1">
                <?php if (mysqli_num_rows($all_order_data) == 0) { ?>
                    <h4 class="text-left mb-5">Your haven't Purchased anything yet</h4>
                <?php  } else { ?>
                    <h4 class="text-left mb-5">Your Orders</h4>
                <?php  } ?>


            </div>
        </div>
        <?php
        while ($row = mysqli_fetch_assoc($all_order_data)) {
            $oid   = $row['o_id'];
            $odate = $row['o_date'];
            $ostatus = $row['o_status'];
            $opay  = $row['o_pay_status'];
            if ($opay == 0)
                $opay = "Pending";
            else
                $opay = "Done";
        ?>
            <div class="row cart-row">
                <div class="col-10 offset-1 col-md-6 offset-md-2 py-2 my-2 order-col">
                    <div class="media">
                        <a class="d-flex align-self-center" href="#">
                            <img src=<?php echo "assets/images/orders.png"; ?> class="img-thumbnail" width="125" style="height:auto" alt="">
                        </a>
                        <div class="media-body pl-3 pt-2 mt-md-2">
                            <p><strong>Order Id : </strong><?php echo $oid; ?><br>
                                <strong>Order Date : </strong><?php echo $odate; ?><br>
                                <strong>Order Status : </strong><?php echo $ostatus; ?><br>
                                <strong>Order Payment : </strong><?php echo $opay; ?>
                            </p>
                            <a href=<?php echo "order_details.php?oid=" . $oid; ?> role="button" class="btn btn-outline-primary mb-2 btn-sm">View Order</a>
                            <?php if (!checkReview($oid)) { ?>
                                <a href=<?php echo "review_order.php?oid=" . $oid; ?> role="button" class="btn btn-outline-info mb-2 btn-sm">Submit Feedback</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
</main>
<?php include "includes/footer.php"; ?>