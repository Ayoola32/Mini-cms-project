<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    if (isset($_GET['p_id'])) {
                        $post_id_get = $_GET['p_id'];
                    
                        $query = "SELECT * FROM posts WHERE post_id = $post_id_get";
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
                                $post_content = $row['post_content'];
                    ?>
                                <!-- Display each post -->
                                <h1 class="page-header">
                                    Page Heading
                                    <small>Secondary Text</small>
                                </h1>
                                <h2><a href=""><?php echo $post_title ?></a></h2>
                                <p class="lead">by <a href=""><?php echo $post_author ?></a></p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date('F d, Y \a\t g:i A', strtotime($post_date)); ?></p>

                                <?php
                                    if (isset($_SESSION['user_role'])) {
                                    echo "<span><a href='admin/posts.php?source=post_update&p_id={$post_id}'>Edit Post</a></span>";
                                    }
                                ?>   
                                <hr>
                                <a href=""><img class="img-responsive" src="images/<?php echo $post_image?>" alt=""></a><br>
                                <p><?php echo $post_content ?></p>
                                <hr>
                <?php
                            }
                        }
                    }else{
                        header("Location: index.php");
                    }
                    
                ?>
            




                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <?php
                        if (isset($_POST['create_comment'])) {
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment_content'];
                            
                            if (empty($comment_author || $comment_email || $comment_content)) {
                                echo "<h3 class=''>Field can't be empty</h3>";
                            }else{
                                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                                $query.= "VALUES (?, ?, ?, ?, 'Unapproved', NOW())";
                                $query_result = mysqli_prepare($connection, $query);
                                
                                mysqli_stmt_bind_param($query_result, "isss", $post_id_get, $comment_author, $comment_email, $comment_content);
                                if (!mysqli_stmt_execute($query_result)) {
                                    die("Execute failed: " . mysqli_stmt_error($query_result));
                                }
                                mysqli_stmt_close($query_result);
                                mysqli_close($connection);
                                header("Location: post_comment.php?p_id=$post_id_get");
                            }
                        }
                    ?>

                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content" placeholder="Type in your comment"></textarea>
                        </div>
                        <button type="submit" name ="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

               
                <!-- Posted Comments -->
                <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id_get} AND comment_status = 'Approved' ORDER BY comment_id DESC";
                    $comment_display_result= mysqli_query($connection, $query);

                    if (!$comment_display_result) {
                        die("Query Failed" . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($comment_display_result)) {
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];
                ?>

                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author;?>
                                    <small><?php echo date('F d, Y \a\t g:i A', strtotime($comment_date)); ?></small>
                                    <small><?php //echo $comment_date;?></small>
                                </h4>
                                <?php echo $comment_content;?>
                            </div>

                        </div>
                <?php }?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                
                <?php include "includes/sidebar_post.php"?>
            </div>

        </div>
        <!-- /.row -->

        <hr>
<?php include "includes/footer.php"?>