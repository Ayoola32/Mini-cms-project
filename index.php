<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    $items_per_page = 5;  // How many posts i want to display per page

                    // Check if a page number is passed in the URL
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1; 
                    }
    
                    // Calculate the offset for the SQL query based on the current page
                    if ($page == 1) {
                        $offset = 0;  
                    } else {
                        $offset = ($page - 1) * $items_per_page;  
                    }
    
                    // SQL query to find out the total number of published posts
                    $post_count_query = "SELECT COUNT(*) FROM posts WHERE post_status = 'published'";
                    $post_count_result = mysqli_query($connection, $post_count_query);
                    if ($post_count_result) {
                        $row = mysqli_fetch_array($post_count_result);
                        $total_posts = $row[0];
                        $total_pages = ceil($total_posts / $items_per_page);  
                    } else {
                        die("QUERY FAILED: " . mysqli_error($connection)); 
                    }
    
                    // SQL query to fetch the posts to be displayed on the current page
                    $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $items_per_page OFFSET $offset";
                    // $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT ";
                    $query_post_result = mysqli_query($connection, $query);
                    if (!$query_post_result) {
                        die("Query Failed" . mysqli_error($connection));
                    }

                    if (mysqli_num_rows($query_post_result)>0) {
                        while ($row = mysqli_fetch_assoc($query_post_result)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'], 0, 300);
                            ?>
                            <!-- Display each post -->
                            <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                            </h1>
                            <h2><a href="post_comment.php?p_id=<?php echo $post_id?>"><?php echo $post_title ?></a></h2>
                            <p class="lead">by <a href="post_comment.php?p_id=<?php echo $post_id?>"><?php echo $post_author ?></a></p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                            <a href="post_comment.php?p_id=<?php echo $post_id?>"><img class="img-responsive" src="images/<?php echo $post_image?>" alt=""></a>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post_comment.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>

                        <?php
                        }
                    }else{
                        echo "<h1 class='text-center'>No post Available</h1>";  // Display message if no posts are found
                    }
                    
                ?>

                <!-- Pager -->
                <ul class="pager">
                <?php
                   // Set how many adjacent pages should be shown on each side of the current page
                    $range = 2;

                    // Show previous button if not on the first page
                    if ($page > 1) {
                        $prev_page = $page - 1;
                        echo "<li><a href='index.php?page=$prev_page'>&laquo; Previous</a></li>";
                    }

                    // Determine the first number in the pagination range
                    $start = ($page - $range > 1) ? $page - $range : 1;

                    // Determine the last number in the pagination range
                    $end = ($page + $range < $total_pages) ? $page + $range : $total_pages;

                    for ($i = $start; $i <= $end; $i++) {
                        $class = ($i == $page) ? 'active' : '';  // Current page or not
                        echo "<li><a href='index.php?page={$i}' class='{$class}'>{$i}</a></li>";
                    }

                    // Show next button if not on the last page
                    if ($page < $total_pages) {
                        $next_page = $page + 1;
                        echo "<li><a href='index.php?page=$next_page'>Next &raquo;</a></li>";
                    }

                    ?>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                
                <?php include "includes/sidebar.php"?>
            </div>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"?>
