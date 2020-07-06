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
                    <li class="nav-item active">
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

<main>
    <div class="container-fluid p-0">
        <div class="site-slider">
            <div class="slider-one">
                <div>
                    <img src="./assets/images/first.jpg" class="img-fluid" alt="Banner 1">
                </div>
                <div>
                    <img src="./assets/images/second.jpg" class="img-fluid" alt="Banner 2">
                </div>
                <div>
                    <img src="./assets/images/thrd.jpg" class="img-fluid" alt="Banner 3">
                </div>
            </div>
            <div class="slider-btn">
                <span class="prev position-top"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                <span class="next position-top right-0"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-sm-1">
        <h3 class="text-center feature-title">Features Products</h3>
        <div class="row mb-5">
            <div class="col-6 col-sm-3 pt-1 pt-sm-0 product text-center">
                <a href="view_product.php"><img class="img-fluid rounded" src="./assets/images/bottles.png"></a>
                <span>Water Bottles</span>
            </div>
            <div class="col-6 col-sm-3 pt-1 pt-sm-0 product text-center">
                <a href="view_product.php"><img class="img-fluid rounded" src="./assets/images/jars.png"></a>
                <span>Water Jars</span>
            </div>
            <div class="col-6 col-sm-3 pt-2 pt-sm-0 product text-center">
                <a href="view_product.php"><img class="img-fluid rounded" src="./assets/images/ice.jpg"></a>
                <span>Ice Cubes</span>
            </div>
            <div class="col-6 col-sm-3 pt-2 pt-sm-0 product text-center">
                <a href="view_product.php"><img class="img-fluid rounded" src="./assets/images/drink.png"></a>
                <span>Soft Drinks</span>
            </div>
        </div>
    </div>

    <div class="container-fluid justify-content-center">
        <h3 class="text-center feature-title mb-3">Why Choose Us ?</h3>
        <div class="row">
            <div class=" mt-5 col-8 offset-2 col-sm-2 offset-sm-2">
                <div class="card pt-5 s-card">
                    <div class="row">
                        <div class="col-6 offset-3 justify-content-center">
                            <img class="card-img-top img-fluid" src="assets/images/faquality.png" alt="Card image cap">
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Quality Service</h5>
                    </div>
                </div>
            </div>

            <div class=" mt-5 col-8 offset-2 col-sm-2 offset-sm-1">
                <div class="card pt-5 s-card">
                    <div class="row">
                        <div class="col-6 offset-3 justify-content-center">
                            <img class="card-img-top img-fluid" src="assets/images/delivery.png" alt="Card image cap">
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center mb-2">Door Step<br />Delivery</h5>
                    </div>
                </div>
            </div>

            <div class=" mt-5 col-8 offset-2 col-sm-2 offset-sm-1">
                <div class="card pt-5 s-card">
                    <div class="row">
                        <div class="col-6 offset-3 justify-content-center">
                            <img class="card-img-top img-fluid" src="assets/images/facall.png" alt="Card image cap">
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">On Call Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <h3 class="text-center feature-title mt-3 ">What Our Client Say ?</h3>
        <div class="site-slider">
            <div class="slider-two">
                <div class="container-fluid mb-2">
                    <div class="row">
                        <div class="col-10 offset-1 col-sm-6 offset-sm-3 feedback-view p-5 mt-5">
                            <h4 class="text-center p-2">Vishal Wankhede</h4>
                            <div class="row">
                                <p class="text-justify  col-12 col-sm-8 offset-sm-2">&emsp;There are many variations of passages of available but the majority have alteration in some form by inject humour or random words which don't look even slightly they will believe you. proident.
                                </p>
                            </div>
                            <div class="col-8 offset-2 d-flex justify-content-center">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $query = "SELECT * FROM reviews WHERE rstatus='A'";
                $all_review_data = mysqli_query($connection, $query);
                confirm($all_review_data);
                while ($row = mysqli_fetch_assoc($all_review_data)) {
                    $name = $row['r_by'];
                    $name = ucwords($name);
                    $msg = $row['r_msg'];
                    $star = $row['r_star'];
                ?>
                    <div class="container-fluid mb-2">
                        <div class="row">
                            <div class="col-10 offset-1 col-sm-6 offset-sm-3 feedback-view p-5 mt-5">
                                <h4 class="text-center p-2"><b><?php echo $name; ?></b></h4>
                                <div class="row">
                                    <p class="text-justify  col-12 col-sm-8 offset-sm-2">&emsp;<?php echo $msg; ?>
                                    </p>
                                </div>
                                <div class="col-8 offset-2 d-flex justify-content-center">
                                    <?php for ($i = 1; $i <= $star; $i++) { ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php } ?>

                                    <?php for ($i = $star; $i < 5; $i++) { ?>
                                        <span class="fa fa-star"></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="slider-btn">
                <span class="prev position-top"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                <span class="next position-top right-0"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

</main>



<!-- <div class="col-12 col-sm-4 offset-sm-1 my-3">
                    <h4 class="text-center contact-us-text text-white">Contact Us</h4>
                    <form >
                        <div class="form-group">
                            <input type="text" class="form-control" id="nameInput" aria-describedby="emailHelp" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="numInput" aria-describedby="emailHelp" placeholder="Enter Mobile Number">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="message" rows="5" placeholder="Enter Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> -->
<?php include "includes/footer.php"; ?>