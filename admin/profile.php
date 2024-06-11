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
                        Posts Page
                        <small><?php echo $_SESSION['username'];?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Post Page
                        </li>
                    </ol>
                </div>

                <div class="col-xs-6">
                    <h3>Profile</h3>
                    <p>I'm a creative PHP web developer</p>


                    <div class="col-md-4">
                        <h2>Details</h2>
                        <p><strong>Name:</strong> Hunter Norton</p>
                        <p><strong>Age:</strong> 33 years</p>
                        <p><strong>Location:</strong> 's-Hertogenbosch, The Netherlands, Earth</p>
                        <div>
                        <a href="#" class="mr-2"><i class="fa fa-fw fa-facebook"></i></a>
                        <a href="#" class="mr-2"><i class="fa fa-fw fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-fw fa-instagram"></i></a>
                    </div>
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
