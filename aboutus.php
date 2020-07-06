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
<main>
  <div class="container">
    <div class="row mt-5">
      <div class="col-10 offset-1 col-md-8 offset-md-2">
        <h3 class="abt-head text-center">How we started our brand ? </h3>
        <p class="text-justify abt-con mt-4">&emsp;Brand is the proprietary visual, emotional, rational, and cultural image that one associates with a company.
          The fond memories of childhood and refreshment that people have when they drink Softdrink is often more important than a little bit better cola taste.This emotional relationship with brands that makes it powerful.Keeping more of emotions and the need of people in my vision I decided to establish a Brand Called <strong>'TIGRIS'</strong>.</p>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-10 offset-1 col-md-8 offset-md-2">
        <h3 class="abt-head text-center">What makes our brand unique ? </h3>
        <p class="text-justify abt-con mt-4">&emsp;Brand associations are the attributes that customers think of when they hear or see the brand name. To attain the success and fame along with elevating the equity of the brand in the market and industry as a whole, the company needs to have a consistent set of traits and characteristics to its brand so that the targeted set of the consumer market is able to connect with the same. This belief makes me select the most reputed but with developed brand character in the market.
          Associated brands are displayed on the home page of the website.Strong associations and strong principles followed by the proprietor distributed in its associated manpower makes the brand unique and different from the other distributors infact innumerous distributors around us.</p>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-10 offset-1 col-md-8 offset-md-2">
        <h3 class="abt-head text-center">What are our brand values and beliefs ? </h3>
        <p class="text-justify abt-con mt-4">&emsp;Management guru Tom Peters said it well:
          <i>“In an increasingly crowded marketplace, fools will compete on price. Winners will find a way to create lasting value in the customer’s mind."</i>
          TIGRIS enterprises sets its brand value on basis of services, professionalism and response time towards its customers and vendors. The brand name TIGRIS is the name of River, The Tigris River, which borders Mesopotamia in the Fertile Crescent, has been a key source of irrigation, power, and travel that dates back to the earliest known civilizations. The name and concept of establishment of the company matches the importance of the name.
          Company compells to establish its brand as a river which flows and it is astounding how a single river blesses us with its generosity by providing us with numerous aspects, essential to survival. </p>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-10 offset-1 col-md-8 offset-md-2">
        <h3 class="abt-head text-center">Why you should choose us ? </h3>
        <p class="text-justify abt-con mt-4">&emsp;Management guru Tom Peters said it well:
          <i>“In an increasingly crowded marketplace, fools will compete on price. Winners will find a way to create lasting value in the customer’s mind."</i>
          TIGRIS enterprises sets its brand value on basis of services, professionalism and response time towards its customers and vendors. The brand name TIGRIS is the name of River, The Tigris River, which borders Mesopotamia in the Fertile Crescent, has been a key source of irrigation, power, and travel that dates back to the earliest known civilizations. The name and concept of establishment of the company matches the importance of the name.
          Company compells to establish its brand as a river which flows and it is astounding how a single river blesses us with its generosity by providing us with numerous aspects, essential to survival. </p>
      </div>
    </div>

  </div>
</main>
<?php include "includes/footer.php"; ?>