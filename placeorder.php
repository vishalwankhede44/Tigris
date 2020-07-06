<?php include "admin/includes/db.php"; ?>
<?PHP include "admin/function.php"; ?>
<?php
if (!isset($_COOKIE['uid'])) {
    header("Location: index.php");
}
if (isset($_POST['submit'])) {
    $name = $_POST['nameInput'];
    $num = $_POST['numInput'];
    $addr = $_POST['address'];

    //$uid = $_SESSION['uid'];
    $uid = $_COOKIE['uid'];

    $cartIds = "";
    $query = "SELECT c_id FROM carts WHERE u_id = {$uid}";
    $all_cart_data = mysqli_query($connection, $query);
    confirm($all_cart_data);
    if (mysqli_num_rows($all_cart_data) <= 0) {
?>
        <script>
            alert("No Product availble in your cart to place an order.");
            window.location.href = "your_orders.php";
        </script>
    <?php
    } else {
        while ($row = mysqli_fetch_assoc($all_cart_data)) {
            $cartIds .= $row['c_id'] . " ";
        }
    }

    $odate = date("d-m-Y");

    $query = "INSERT INTO orders(o_name,o_mobile,o_address,o_cart_ids,o_u_id,o_date,o_status)";
    $query .= " VALUES('{$name}','{$num}','{$addr}','{$cartIds}',{$uid},'{$odate}','Waiting For Confirmation')";

    $add_order_query = mysqli_query($connection, $query);

    confirm($add_order_query);
    $query = "UPDATE carts SET c_status = 'Done' WHERE u_id = {$uid} ";
    $delete_query = mysqli_query($connection, $query);
    ?>
    <script>
        alert("Thank You\nYour order has been placed\nYou can tract it from Your Orders Section");
        window.location.href = "view_product.html";
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


    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 col-md-6 offset-md-3">
                <h3 class="text-center my-3" id="billtxt">Billing Info</h3>
                <form method="post" action="placeorder.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nameInput" id="nameInput" aria-describedby="emailHelp" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="numInput" id="numInput" aria-describedby="emailHelp" placeholder="Enter Mobile Number">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="address" id="address" rows="5" placeholder="Enter Address"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.php"; ?>