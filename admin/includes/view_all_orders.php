<?php
if (isset($_POST['update_status'])) {
    $stat = $_POST['ostatusinp'];
    $oid = $_GET['oid'];
    $query = "UPDATE orders SET o_status = '{$stat}' WHERE o_id={$oid}";
    $update_post = mysqli_query($connection, $query);
    confirm($update_post);
    header("Location: all_orders.php");
}


?>
<form action="" method="post">
    <table class="table table-responsive table-bordered table-hover">
        <thead>

            <th>Id</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Date</th>
            <th>Payment</th>
            <th>Status</th>
            <th></th>
            <th>View</th>
            <th>Delivery Date</th>
            <th>Delivered By</th>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM orders";
            $all_comment_data = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($all_comment_data)) {
                $order_id = $row['o_id'];
                $oname = $row['o_name'];
                $omobile = $row['o_mobile'];
                $oaddress = $row['o_address'];
                $ostatus = $row['o_status'];
                $odate = $row['o_date'];
                $opay = $row['o_pay_status'];
                $odelidate = $row['o_deli_date'];
                $odeliby = $row['o_deli_by'];

                echo "<tr>";

                echo "<td>{$order_id}</td>";
                echo "<td>{$oname}</td>";
                echo "<td>{$omobile}</td>";
                echo "<td>{$oaddress}</td>";
                echo "<td>{$odate}</td>";
                if ($opay == 0) {
                    $opay = "Pending";
                } else {
                    $opay = "Done";
                }
                echo "<td>{$opay}</td>";

            ?><?php if ($ostatus != "Delivered") { ?>

            <form action="all_orders.php?oid=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data">
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control" name="ostatusinp" value="<?php echo $ostatus; ?>" required>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="update_status">Update</button>
                    </div>
                </td>
            </form>
    <?php } else {
                    echo "<td>{$ostatus}</td>";
                    echo "<td></td>";
                }

                echo "<td><a href='../order_details.php?oid={$order_id}' target='_blank' role=button class='btn btn-success'>View Order</a></td>";
                echo "<td>{$odelidate}</td>";
                echo "<td>{$odeliby}</td>";
                echo "</tr>";
            }
    ?>


        </tbody>
    </table>
</form>