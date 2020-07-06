<table class="table table-responsive table-bordered table-hover" id="table-scroll">
    <thead>
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Role</th>
            <th>Username</th>
            <th>Mobile</th>
            <th>Location</th>
            <th>Delete</th>


        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM employees";
        $all_comment_data = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($all_comment_data)) {
            $user_id = $row['e_id'];
            $user_email = $row['emp_email'];
            $user_mobile = $row['emp_mobile'];
            $username = $row['username'];
            $user_role = $row['user_role'];
            $mlink = $row['maplink'];


            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_email}</td>";

            echo "<td>{$user_role}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_mobile}</td>";
            echo "<td><a href={$mlink} target='_blank' class='btn btn-primary'> <i class='fa fa-map-o' aria-hidden='true'></i>Track Location</a></td>";


            echo "<td><a href='users.php?delete={$user_id}' class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";
        }
        ?>

        <?php


        if (isset($_GET['delete'])) {
            if (isset($_COOKIE['user_role'])) {

                if ($_COOKIE['user_role'] == 'Admin') {
                    $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
                    $query = "DELETE FROM employees WHERE e_id = {$the_user_id} ";
                    $delete_query = mysqli_query($connection, $query);

                    if (!$delete_query) {
                        die("QUERY FAILED " . mysqli_error($connection));
                    }
                    header("location: users.php");
                }
            }
        }

        ?>

    </tbody>
</table>