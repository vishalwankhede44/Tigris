<?php include "admin/includes/db.php"; ?>
<?php include "admin/function.php"; ?>
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
                            <li class="nav-item mt-2 mt-sm-0 active">
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
<script>
    function neworder() {
        window.location.href = "neworders.php";
    }

    function prevorder() {
        window.location.href = "oldorders.php";
    }
</script>
<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 col-md-2 offset-md-3 mt-3">
                <div class="card ecart pt-5" onclick=neworder()>
                    <div class="row">
                        <div class="col-6 offset-3 justify-content-center">
                            <img class="card-img-top img-fluid" src="assets/images/cart.png" alt="Card image cap">
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center" style="color:rgb(62,80,180);">New Orders</h5>
                    </div>
                </div>
            </div>

            <div class="col-8 offset-2 col-md-2 offset-md-1 mt-3">
                <div class="card ecart pt-5" onclick="prevclick();">
                    <div class="row">
                        <div class="col-6 offset-3 justify-content-center">
                            <img class="card-img-top img-fluid" src="assets/images/cart.png" alt="Card image cap">
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-center" style="color:rgb(62,80,180);">Previous Orders</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.php"; ?>