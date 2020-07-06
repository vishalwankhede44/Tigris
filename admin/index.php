<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php
    if ($_COOKIE['user_role'] != 'Admin') {
        header("Location: ../index.php");
    }


    ?>


    <!-- Navigation -->

    <?php include "includes/admin_navigation.php"; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row" id="rowid">
                <div class="col-lg-32">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php //secho $_SESSION['username']; 
                                ?></small>
                    </h1>

                </div>
                <!-- /.row -->

            </div>

            <!-- /.row -->

            <div class="row" id="rowid">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $post_counts =  recordCount('products');
                                    ?>

                                    <div class='huge'>
                                        <?php echo $post_counts;
                                        ?>
                                    </div>
                                    <div>Products</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $comment_counts = recordCount('reviews');

                                    ?>

                                    <div class='huge'>
                                        <?php echo $comment_counts;
                                        ?>
                                    </div>
                                    <div>Feedbacks</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php


                                    $user_counts = recordCount('customers');

                                    ?>
                                    <div class='huge'>
                                        <?php echo $user_counts;
                                        ?>
                                    </div>
                                    <div>Customers</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $category_counts = recordCount('categories');
                                    ?>
                                    <div class='huge'>
                                        <?php echo $category_counts;
                                        ?>
                                    </div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php

            /*   $draft_post_counts = checkStatus('posts', 'post_status', 'draft');

            $unapproved_comment_counts = checkStatus('comments', 'comment_status', 'unapproved');

            $subscriber_counts = checkStatus('users', 'user_role', 'Subscriber');*/

            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php

                            $active_post_counts = 0; //checkStatus('posts', 'post_status', 'Published');

                            $element_text = ['Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$active_post_counts, $draft_post_counts, $comment_counts, $unapproved_comment_counts, $user_counts, $subscriber_counts, $category_counts];

                            for ($i = 0; $i < 7; $i++) {
                                echo "['{$element_text[$i]}' " . " , " . "{$element_count[$i]}], ";
                            }


                            ?>
                            //   ['Posts', 1000],

                        ]);

                        var options = {
                            chart: {
                                title: 'CMS',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>


            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php"; ?>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://js.pusher.com/4.1/pusher.min.js"></script>