<?php
if (isset($_GET['p_id'])) {
    $get_post_id = $_GET['p_id'];
}

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
                       Post Comments Page
                        <small><?php echo $_SESSION['username'];?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Post Comments Page
                        </li>
                    </ol>
                </div>




                <table class="table table-bordered hovered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <!-- <th>Comment Id</th> -->
                            <th>Author</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>In Response to</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $get_post_id) . " ORDER BY comment_id DESC";
                            $query_result = mysqli_query($connection, $query);
                            if (!$connection) {
                                die("Query Failed" . mysqli_error($connection));
                            }

                            while ($row = mysqli_fetch_assoc($query_result)) {
                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_author = $row['comment_author'];
                                $comment_email = $row['comment_email'];
                                $comment_content = $row['comment_content'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];

                                echo "<tr>";
                                echo "<td>{$comment_id}</td>";
                                echo "<td>{$comment_author}</td>";
                                echo "<td>{$comment_email}</td>";
                                echo "<td>{$comment_content}</td>";
                                echo "<td>{$comment_status}</td>";

                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                $select_post_id_result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($select_post_id_result)) {
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];

                                    echo "<td><a href='../post_comment.php?p_id={$post_id}'>$post_title</a></td>";
                                }
                                echo "<td>{$comment_date}</td>";
                                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                                echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this Comment')\" href='comments.php?delete={$comment_id}'>Delete</a></td>";
                                echo "</td>";
                            } 
                        



                            // APPROVE BUTTON
                            if (isset($_GET['approve'])) {
                                    $approve_comment_id = $_GET['approve'];

                                    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $approve_comment_id";
                                    $comment_approve_result = mysqli_query($connection, $query);
                                    header("Location: comments.php");
                            }

                            // UNAPPROVE BUTTON
                            if (isset($_GET['unapprove'])) {
                                    $approve_comment_id = $_GET['unapprove'];

                                    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $approve_comment_id";
                                    $comment_unapprove_result = mysqli_query($connection, $query);
                                    header("Location: comments.php");
                            }


                            // DELETE BUTTON
                            if (isset($_GET['delete'])) {
                                $del_comment_id = $_GET['delete'];

                                $query = "DELETE FROM comments WHERE comment_id = '{$del_comment_id}'";
                                $query_result = mysqli_query($connection, $query);
                                header("Location: comments.php");
                            }


                        ?>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>