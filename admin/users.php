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
                        All Users Page
                        <small><?php echo $_SESSION['username'];?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Users Page
                        </li>
                    </ol>
                </div>

                <?php 
                // include "includes/post_view_all.php";
                if (isset($_GET['source'])) {
                    $source = $_GET['source'];
                }else {
                    $source = '';
                }

                    switch ($source) {
                        case 'user_add':
                            include "includes/user_add.php";
                            break;

                        case 'user_update':
                            include "includes/user_update.php";
                            break;

                        case 'user_delete':
                            include "includes/user_delete.php";
                            break;

                        default:
                            include "includes/user_view_all.php";
                        break;
                    }
                ?>          
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>