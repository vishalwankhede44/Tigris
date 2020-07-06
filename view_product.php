<?php include "admin/includes/db.php"; ?>
<?php include "admin/function.php"; ?>
<?php include "includes/header.php"; ?>
<?php

$query1 = "SELECT * FROM categories";
$all_cat = mysqli_query($connection, $query1);
confirm($all_cat);
?>
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
                    <li class="nav-item mt-2 mt-sm-0 active">
                        <a class="nav-link" href="view_product.php">SHOP <span class="sr-only">(current)</span></a>
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

<main class="view-product mt-5">
    <div class="container">
        <?php
        while ($row = mysqli_fetch_assoc($all_cat)) {
            $cid = $row['id'];
            $cname = $row['name'];
            $query = "SELECT * FROM products WHERE p_status = 'Published' AND p_cat = {$cid} ORDER BY p_id DESC";
            $all_p_data = mysqli_query($connection, $query);
            confirm($all_p_data);
            if (mysqli_num_rows($all_p_data) == 0)
                continue;
        ?>
            <h3><?php echo $cname; ?></h3>
            <div class="row">
                <?php
                while ($rw = mysqli_fetch_assoc($all_p_data)) {
                    $pid = $rw['p_id'];
                    $pimg = $rw['p_img'];
                    $pname = $rw['p_name'];
                    $punit = $rw['p_unit'];
                    $pid = $rw['p_id'];
                ?>
                    <div class="col-6 col-sm-3 my-4">
                        <div class="card zoom">
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <img class="card-img-top img-fluid" style="max-height: 11rem;min-height: 11rem; object-fit: scale-down;" src=<?php echo "assets/products/images/$pid" . "." . "$pimg"; ?> alt="Card image cap">
                                </div>
                            </div>
                            <div class=" card-body pb-0 px-0">
                                <h5 class="card-title text-center"><?php echo $pname; ?></h5>
                                <p class="text-center"><?php echo $punit; ?></p>
                                <div class="middle">
                                    <?php if (isset($_COOKIE['uid'])) { ?>
                                        <button class="btn btn-md btn-primary text" value=<?php echo $pid; ?> onclick="add_to_cart(this)">Add to Cart</button>
                                    <?php } else { ?>
                                        <button class="btn btn-md btn-primary text" value=<?php echo $pid; ?> onclick="loginAlert(this)">Add to Cart</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        <?php } ?>
    </div>


</main>

<?php include "includes/footer.php"; ?>