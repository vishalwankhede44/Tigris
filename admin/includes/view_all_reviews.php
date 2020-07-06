<?php
if (isset($_GET['rid']) && isset($_GET['stat'])) {
    $rid = $_GET['rid'];
    $stat = $_GET['stat'];
    $query = "UPDATE reviews SET rstatus = '{$stat}' WHERE r_id={$rid}";
    $update_post = mysqli_query($connection, $query);
    confirm($update_post);
    header("Location: all_reviews.php");
}


?>
<form action="" method="post">
    <table class="table table-responsive table-bordered table-hover">
        <thead>

            <th>Id</th>
            <th>Name</th>
            <th>Message</th>
            <th class="text-center">Order Id</th>
            <th>Rating</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM reviews";
            $all_comment_data = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($all_comment_data)) {
                $r_id = $row['r_id'];
                $name = $row['r_by'];
                $oid = $row['oid'];
                $rmsg = $row['r_msg'];
                $rstar = $row['r_star'];
                $rstatus = $row['rstatus'];

                echo "<tr>";

                echo "<td>{$r_id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$rmsg}</td>";
                echo "<td>{$oid}</td>";
                echo "<td>{$rstar}</td>";

                if ($rstatus == "D")
                    $rstatus = "Disapproved";
                else
                    $rstatus = "Approved";
                echo "<td>{$rstatus}</td>";

                echo "<td><a href='./all_reviews.php?rid={$r_id}&stat=A'  role=button class='btn btn-success'>Approve</a></td>";
                echo "<td><a href='./all_reviews.php?rid={$r_id}&stat=D'  role=button class='btn btn-danger'>Disapprove</a></td>";
                echo "</tr>";
            }
            ?>


        </tbody>
    </table>
</form>