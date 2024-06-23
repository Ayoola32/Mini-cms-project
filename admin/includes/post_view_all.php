<?php
// For multi clone, delete, publish, draft
if (isset($_POST['checkBoxArr'])) {
    foreach ($_POST['checkBoxArr'] as $checkBoxValue) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = ? WHERE post_id = ?";
                $query_published_result = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($query_published_result, 'si', $bulk_options, $checkBoxValue);
                if (!mysqli_stmt_execute($query_published_result)) {
                    die("Query Failed:" . mysqli_error($connection));
                }
                mysqli_stmt_close($query_published_result);
            break;
                
            case 'draft':
                $query = "UPDATE posts SET post_status = ? WHERE post_id = ?";
                $query_draft_result = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($query_draft_result, 'si', $bulk_options, $checkBoxValue);
                if (!mysqli_stmt_execute($query_draft_result)) {
                    die("Query Failed:" . mysqli_error($connection));
                }
                mysqli_stmt_close($query_draft_result);
            break;

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = ?";
                $query_draft_result = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($query_draft_result, 'i', $checkBoxValue);
                if (!mysqli_stmt_execute($query_draft_result)) {
                    die("Query Failed:" . mysqli_error($connection));
                }
                $result = mysqli_stmt_get_result($query_draft_result);
                $row = mysqli_fetch_assoc($result);
                mysqli_stmt_close($query_draft_result); // Close the statement after fetching the result

                if ($row) {
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_users = $row['post_users'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];

                    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_content, post_tags, post_status, post_image, post_users, post_comment_count, post_date) ";
                    $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                    $query_clone_result = mysqli_prepare($connection, $query);
                    mysqli_stmt_bind_param($query_clone_result, "isssssssi", $post_category_id, $post_title, $post_author, $post_content, $post_tags, $post_status, $post_image, $post_users, $post_comment_count);

                    if (!mysqli_stmt_execute($query_clone_result)) {
                        die("Query Failed: " . mysqli_error($connection));
                    }
                    mysqli_stmt_close($query_clone_result);
                } else {
                    die("Query Failed: No post found with the given ID");
                }
            break;

            case 'delete':
                // $query = "DELETE FROM posts WHERE post_id = ?";
                // $stmt = mysqli_prepare($connection, $query);
                // mysqli_stmt_bind_param($stmt, 'i', $checkBoxValue);
                // if (!mysqli_stmt_execute($stmt)) {
                //     die("Query Failed:" . mysqli_error($connection));
                // }
                // mysqli_stmt_close($stmt);
                // break;

                // First, delete comments related to the post
                $delete_comments_query = "DELETE FROM comments WHERE comment_post_id = ?";
                $stmt_delete_comments = mysqli_prepare($connection, $delete_comments_query);
                mysqli_stmt_bind_param($stmt_delete_comments, 'i', $checkBoxValue);
                if (!mysqli_stmt_execute($stmt_delete_comments)) {
                    die("Query Failed to delete comments:" . mysqli_error($connection));
                }
                mysqli_stmt_close($stmt_delete_comments);

                // Then, delete the post itself
                $delete_post_query = "DELETE FROM posts WHERE post_id = ?";
                $stmt_delete_post = mysqli_prepare($connection, $delete_post_query);
                mysqli_stmt_bind_param($stmt_delete_post, 'i', $checkBoxValue);
                if (!mysqli_stmt_execute($stmt_delete_post)) {
                    die("Query Failed to delete post:" . mysqli_error($connection));
                }
                mysqli_stmt_close($stmt_delete_post);
                break;


            default:
                break;
        }
    }
}
?>



<?php
// for post status update
if (isset($_POST['status']) && isset($_POST['post_id'])) {
    $status = $_POST['status'];
    $post_id = $_POST['post_id'];

    $query = "UPDATE posts SET post_status = ? WHERE post_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'si', $status, $post_id);
    if (!mysqli_stmt_execute($stmt)) {
        die("Query Failed: " . mysqli_error($connection));
    }
    mysqli_stmt_close($stmt);

    header("Location: ".$_SERVER['PHP_SELF']); // Refresh the current page
    exit;
}
?>



<form action="" method="post">
    <table class="table table-bordered hovered table-hover table-striped">
        <div class="bulkOptionsContainer row">
            <div class="col-xs-2">
                <select class="form-control" name="bulk_options" id="">
                    <option value="">Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="clone">Clone</option>
                    <option value="delete">Delete</option>
                </select>
            </div>

            <div class="col-xs-3">
                <div class="row">
                    <div class="col-xs-5">
                        <input type="submit" name="submit" class="btn btn-success btn-block" value="Apply">
                    </div>
                    <div class="col-xs-5">
                        <a class="btn btn-primary btn-block" href="posts.php?source=post_add">Add New Post</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllboxes"></th>
                <th>Id</th>
                <th>Category</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Image</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Status</th>
                <th>Comment Count</th>
                <th>Users</th>
                <th>View Post</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dynamic Display Post from database -->
            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $query_post_result = mysqli_query($connection, $query);
            if (!$query_post_result) {
                die("Query Failed" . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($query_post_result)) {
                $post_id = $row['post_id'];
                echo "<tr>";
                ?>
                <td><input class='checkBoxes' type='checkbox' id='checkAllboxes' name='checkBoxArr[]' value='<?php echo $post_id ?>'></td>
                <?php
                echo "<td>{$post_id}</td>";

                // Display Post category title instead of post category id
                $query_cat = "SELECT cat_title FROM category_header WHERE cat_id = {$row['post_category_id']}";
                $query_cat_result = mysqli_query($connection, $query_cat);
                $cat_title = mysqli_fetch_assoc($query_cat_result)['cat_title'];
                echo "<td>{$cat_title}</td>";

                echo "<td>{$row['post_title']}</td>";
                echo "<td>{$row['post_author']}</td>";
                echo "<td>{$row['post_date']}</td>";
                echo "<td><img class='img-responsive' src='../images/{$row['post_image']}' alt='image' width='150'></td>";
                echo "<td>{$row['post_content']}</td>";
                echo "<td>{$row['post_tags']}</td>";
                ?>
                <td>
                    <form action="" method="post">
                        <select name="status" onchange="this.form.submit()">
                            <option value='<?php echo $row['post_status']; ?>'><?php echo ucwords($row['post_status']); ?></option>
                            <?php
                            if ($row['post_status'] == 'published') {
                                echo "<option value='draft'>Draft</option>";
                            } else {
                                echo "<option value='published'>Published</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    </form>
                </td>
                <?php
                $query_comments = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                $query_comments_result = mysqli_query($connection, $query_comments);
                $count_comments = mysqli_num_rows($query_comments_result);

                echo "<td><a href='./comment_list.php?p_id={$post_id}'>{$count_comments}</a></td>";
                echo "<td>{$row['post_users']}</td>";
                echo "<td><a class='btn btn-warning' href='../post_comment.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a class='btn btn-info mr-2' href='./posts.php?source=post_update&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this Post and all its comments')\" href='./posts.php?source=post_delete&p_id={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>
