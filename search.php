<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                    if (isset($_POST['submit'])) {
                        $search = $_POST['search'];
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $search_result = mysqli_query($connection, $query);
                        if (!$search_result) {
                            die("Query Failed" . mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($search_result);
                        if ($count == 0) {
                            echo "<h1 class='text-center'>Search not found!</h1>";
                        }else {
                            while ($row = mysqli_fetch_assoc($search_result)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];

                ?>

                        <h1 class="page-header">
                            Page Heading
                        <small>Secondary Text</small>
                        </h1>
        
                        <!-- First Blog Post -->
                        <h2>
                        <a href=""><?php echo $post_title?></a>
                        </h2>
                        <p class="lead">
                            by <a href=""><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                        <hr>
                        <a href="">
                            <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                        </a>                        
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        

                <?php


                        }
                    }

                }
                
                
                ?>

                
                <hr>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                
                <?php include "includes/sidebar.php"?>
            </div>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"?>
