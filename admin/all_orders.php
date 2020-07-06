<?php include "includes/admin_header.php"; ?>



<?php
if ($_COOKIE['user_role'] != 'Admin') {
    header("Location: ../index.php");
}

?>
<div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php"; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $_COOKIE['username']; ?></small>
                    </h1>

                    <?php
                    include "includes/view_all_orders.php";
                    ?>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>