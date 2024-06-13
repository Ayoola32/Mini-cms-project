<?php

?>

<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Change Password
                        <small><?php echo $_SESSION['username'];?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Change password
                        </li>
                    </ol>
                </div>

                <div class="col-xs-4">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password"> Confirm New Password</label>
                                <input type="password" class="form-control" name="comfirm_password">
                            </div>

                            <div class="form-group">
                                <input class= "btn btn-primary" type="submit" class="form-control" name="submit" value="Change Password">
                            </div>
                        </form>
                </div>
            </div>

               
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
