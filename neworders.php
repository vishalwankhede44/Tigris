<?php include "admin/includes/db.php"; ?>
<?php include "admin/function.php"; ?>
<?php
if (isset($_COOKIE['user_role'])) {
    $role = $_COOKIE['user_role'];
    if ($role != "Employee") {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}

?>

<?php
if (isset($_GET['d'])) {
    $oid = $_GET['oid'];
    $d = $_GET['d'];
    $name = $_COOKIE['username'];
    $deli_date = date('d-m-Y');
    if ($d == "dp") {
        $query = "UPDATE orders SET o_status = 'Delivered',o_pay_status=1,o_deli_by = '{$name}',o_deli_date='{$deli_date}' WHERE o_id={$oid}";
    } else {

        $query = "UPDATE orders SET o_status = 'Delivered',o_deli_by = '{$name}',o_deli_date='{$deli_date}' WHERE o_id={$oid}";
    }

    $update_q = mysqli_query($connection, $query);
    confirm($update_q);
    header("Location: neworders.php");
}
?>
<?php

$uid = $_COOKIE['uid'];
$query = "SELECT * FROM orders WHERE o_status='Ready to Deliver'";
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
                            <li class="nav-item mt-2 mt-sm-0 active">
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
                    <h4 class="text-left mb-5">Wait for Orders</h4>
                <?php } else { ?>
                    <h4 class="text-left mb-5">Your Orders</h4> <?php } ?>
            </div>
        </div>
        <?php
        while ($row = mysqli_fetch_assoc($all_order_data)) {
            $oid   = $row['o_id'];
            $oname = $row['o_name'];
            $oaddr = $row['o_address'];
            $omobile = $row['o_mobile'];
        ?>
            <div class="row cart-row">
                <div class="col-10 offset-1 col-md-6 offset-md-2 py-2 my-2 order-col">
                    <div class="media">
                        <a class="d-flex align-self-center" href="#">
                            <img src=<?php echo "assets/images/orders.png"; ?> class="img-thumbnail" width="125" style="height:auto" alt="">
                        </a>
                        <div class="media-body pl-3 pt-2 mt-md-2">
                            <p><strong>Order Id : </strong><?php echo $oid; ?><br>
                                <strong>Name : </strong><?php echo $oname; ?><br>
                                <strong>Delivery Address : </strong><?php echo $oaddr; ?><br>
                                <strong>Mobile : </strong><?php echo $omobile; ?>
                            </p>
                            <a href=<?php echo "neworders.php?oid=" . $oid . "&d=d"; ?> role="button" class="btn btn-outline-primary mb-2 btn-sm">Delivered</a>
                            <a href=<?php echo "neworders.php?oid=" . $oid . "&d=dp"; ?> role="button" class="btn btn-outline-success mb-2 btn-sm">Delivered with Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
</main>

<?php include "includes/footer.php"; ?>