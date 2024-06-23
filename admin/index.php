<?php include "includes/admin_header.php";?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Admin Dashboard Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php
                                            $query = "SELECT * FROM posts";
                                            $post_query_result = mysqli_query($connection, $query);
                                            $post_count = mysqli_num_rows($post_query_result);

                                            echo  "<div class='huge'>{$post_count}</div>";
                                        ?>

                                        <div>Posts</div>
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
                                            $query = "SELECT * FROM comments";
                                            $comment_query_result = mysqli_query($connection, $query);
                                            $comment_count = mysqli_num_rows($comment_query_result);

                                            echo  "<div class='huge'>{$comment_count}</div>";
                                        ?>
                                        <div>Comments</div>
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
                                            $query = "SELECT * FROM users";
                                            $user_query_result = mysqli_query($connection, $query);
                                            $user_count = mysqli_num_rows($user_query_result);

                                            echo  "<div class='huge'>{$user_count}</div>";
                                        ?>
                                        <div> Users</div>
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
                                            $query = "SELECT * FROM category_header";
                                            $categories_query_result = mysqli_query($connection, $query);
                                            $category_count = mysqli_num_rows($categories_query_result);

                                            echo  "<div class='huge'>{$category_count}</div>";
                                        ?>
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
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $post_published_query_result = mysqli_query($connection, $query);
                    $post_published_count = mysqli_num_rows($post_published_query_result);
                    ?>

                    <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $post_draft_query_result = mysqli_query($connection, $query);
                    $post_draft_count = mysqli_num_rows($post_draft_query_result);
                    ?>

                    <?php
                    $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
                    $comment_approve_result = mysqli_query($connection, $query);
                    $approve_comment_count = mysqli_num_rows($comment_approve_result);
                    ?>

                    <?php
                    $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
                    $comment_unapprove_result = mysqli_query($connection, $query);
                    $unapprove_comment_count = mysqli_num_rows($comment_unapprove_result);
                    ?>

                    <?php
                    $query = "SELECT * FROM users WHERE user_role = 'admin'";
                    $user_admin_result = mysqli_query($connection, $query);
                    $user_admin_count = mysqli_num_rows($user_admin_result);
                    ?>

                    <?php
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $user_role_result = mysqli_query($connection, $query);
                    $user_role_count = mysqli_num_rows($user_role_result);
                    ?>

                    <?php
                    $query = "SELECT * FROM category_header";
                    $cat_header_result = mysqli_query($connection, $query);
                    $categories_count = mysqli_num_rows($cat_header_result);
                    ?>

                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count', {role: 'style'}],
                            ['All Post', <?php echo $post_count?>, 'blue'],
                            ['Published Post', <?php echo $post_published_count?>, 'blue'],
                            ['Drafted Posts', <?php echo $post_draft_count?>, 'red'],
                            ['All Comments', <?php echo $comment_count?>, 'blue'],
                            ['Approved Comments', <?php echo $approve_comment_count?>, 'red'],
                            ['Unapproved Comments', <?php echo $unapprove_comment_count?>, 'red'],
                            ['All Users', <?php echo $user_count?>, 'blue'],
                            ['Admin', <?php echo $user_admin_count?>, 'red'],
                            ['Subscribers', <?php echo $user_role_count?>, 'red'],
                            ['Categories', <?php echo $categories_count?>, 'blue']                         
                            ]);

                            var options = {
                                chart: {
                                    title: 'Content Rating',
                                    subtitle: 'Posts, Comments, Users, and Catgeories:',
                                },
                                legend: { position: 'none' } // Hide legend
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include "includes/admin_footer.php";?>