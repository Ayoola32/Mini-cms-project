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
                        Categories Page
                        <small>username</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Categories Page
                        </li>
                    </ol>
                </div>


                <div class="col-xs-6">
                    <?php // CREATE CATEGORIES
                        insert_categories();
                    ?>


                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat_title">Add New Categories</label>
                            <input class= "form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Category" name="submit" class="btn btn-primary">
                        </div>
                    </form>

                    <hr>
                    
                


                </div> <!-- Category form -->

                <div class="col-xs-6">
                    <table class="table table-bordered hovered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th>Edit Title</th>
                                <th>Delete Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //READ CATEGORIES
                            readAllCategories(); 
                            ?>


                         
                        </tbody>
                    </table>
                </div> 
                <!-- Categories Table -->



            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>