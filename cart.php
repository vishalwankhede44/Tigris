<?php include "admin/includes/db.php"; ?>
<?PHP include "admin/function.php"; ?>
<?php
if (isset($_GET['pid'])) {

    $pid = escape($_GET['pid']);
    $uid = $_COOKIE['uid'];

    $query = "INSERT INTO carts(p_ids,u_id)";
    $query .= " VALUES({$pid},{$uid})";

    $add_cart_query = mysqli_query($connection, $query);

    confirm($add_cart_query);
?>
    <script>
        close();
    </script>
<?php

}

?>