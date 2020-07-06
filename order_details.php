<?php include "admin/includes/db.php"; ?>
<?php include "admin/function.php"; ?>
<?php
if (!isset($_COOKIE['uid'])) {
    header("Location: index.php");
}
if (isset($_GET['oid'])) {
    $order_id = $_GET['oid'];
    $i = 1;
    $query = "SELECT * FROM orders WHERE o_id={$order_id}";
    $specific_order = mysqli_query($connection, $query);
    confirm($specific_order);
    while ($row = mysqli_fetch_assoc($specific_order)) {
        $cids = $row['o_cart_ids'];
    }
    $cids = explode(" ", $cids);
    $c = count($cids) - 1;
} else {
?>
    <script>
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
                                <a class="nav-link" href="admin/index.php">Admin Dashboard</a>
                            </li>
                    <?php  }
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
    <?php
    if (mysqli_num_rows($specific_order) == 0) {
    ?>
        <script>
            window.location.href = "your_orders.php";
        </script>
    <?php
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 col-md-8 offset-md-2">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <caption>List of Products</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 1; $i <= $c; $i++) {

                                $query = "SELECT carts.p_qty,products.p_name,products.p_unit FROM products INNER JOIN carts ON products.p_id=carts.p_ids WHERE carts.c_id={$cids[$i - 1]} AND c_status = 'Done'";
                                $all_cart_data = mysqli_query($connection, $query);
                                confirm($all_cart_data);
                                while ($row = mysqli_fetch_assoc($all_cart_data)) {
                                    $pname = $row['p_name'] . " " . $row['p_unit'];
                                    $pqty = $row['p_qty'];
                                    echo "<tr>";
                                    echo "<th scope='row'>$i</th>";
                                    echo "<td>{$pname}</td>";
                                    echo "<td>{$pqty}</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.php"; ?>