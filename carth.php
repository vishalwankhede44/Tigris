<?php include "admin/includes/db.php"; ?>
<?PHP include "admin/function.php"; ?>

<?php if (isset($_POST['place'])) {


  foreach ($_POST as $key => $value) {
    $cart_id = substr($key, 5);
    $quant = $value;
    $query = "UPDATE carts SET p_qty={$quant} WHERE c_id={$cart_id}";
    $update_cart = mysqli_query($connection, $query);
?>
    <script>
      window.location.href = "placeorder.php";
    </script>
<?php

  }
}
?>
<?php
if (!isset($_COOKIE['uid'])) {
  header("Location: index.php");
}

$uid = $_COOKIE['uid'];
$query = "SELECT carts.c_id,carts.p_qty,products.p_id,products.p_name,products.p_unit,products.p_img FROM carts INNER JOIN products ON carts.p_ids=products.p_id WHERE carts.u_id={$uid} AND c_status = 'NotDone'";
$all_cart_data = mysqli_query($connection, $query);
confirm($all_cart_data);

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
<?php
if (mysqli_num_rows($all_cart_data) == 0) {
?>
  <main>
    <div class="container my-5">
      <h2 class="text-center my-5">Your cart is Empty</h2>
    </div>
  </main>
<?php
} else {
?>
  <main>
    <div class="container my-4">
      <h5 class="text-right my-3">Total Items in cart : <?php echo mysqli_num_rows($all_cart_data); ?></h5>
      <form method="post">
        <?php
        while ($row = mysqli_fetch_assoc($all_cart_data)) {
          $pid   = $row['p_id'];
          $pname = $row['p_name'];
          $punit = $row['p_unit'];
          $pimg  = $row['p_img'];
          $cid   = $row['c_id'];
          $c_qty = $row['p_qty'];

        ?>
          <div class="row cart-row">
            <div class="col-10 offset-1 col-md-6 offset-md-3 py-2 my-2 cart-col">
              <div class="media">
                <a class="d-flex align-self-center" href="#">
                  <img src=<?php echo "assets/products/images/$pid" . "." . "$pimg"; ?> class="img-thumbnail" width="125" style="height:auto;max-height: 8rem;min-height: 8rem; object-fit: scale-down;" alt="">
                </a>
                <div class="media-body pl-3 pt-2 mt-md-2">
                  <h5><?php echo $pname . " " . $punit; ?> <a href=<?php echo "carth.php?rem=$cid"; ?> class="btn btn-md btn-outline-danger del" title="Remove from Cart"><i class="fa fa-trash-o" aria-hidden="true"></i></a> </h5>

                  <div class="row mt-3 ml-0 mt-md-3">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-outline-primary col-2 justify-content-center" value="-" onclick="qtyClick(this,<?php echo $cid; ?>)"><b>-</b></button>
                      <input type="text" class="col-6 col-sm-3 text-center border border-primary" value=<?php echo $c_qty; ?> name=<?php echo "quant" . $cid; ?> id=<?php echo "qty" . $cid; ?> style="background: rgb(245,245,245);">
                      <button type="button" class="btn btn-outline-primary col-2 justify-content-center pr-3" onclick="qtyClick(this,<?php echo $cid; ?>)" value="+"><b>+</b></button>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        <?php }
        ?>
    </div>
    <div class="container">
      <button class="btn btn-outline-danger" style="margin-left:70%;">Remove All</button>
    </div>
    <div class="container">
      <div class="row">
        <a href="carth.php?c=5-7-8-1" class="col-8 offset-2 col-md-4 offset-md-4 "><input type="submit" value="Place Order" class="btn btn-success my-3" name="place" style="width: 100%;">
        </a>
      </div>
    </div>
    </form>
  </main>

<?php } ?>


<?php include "includes/footer.php"; ?>