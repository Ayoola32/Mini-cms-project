<?php
// for post status update
if (isset($_POST['status']) && isset($_POST['post_id'])) {
    $status = $_POST['status'];
    $post_id = $_POST['post_id'];

    $query = "UPDATE posts SET post_status = '{$status}' WHERE post_id = {$post_id}";
    $query_result = mysqli_query($connection, $query);
    if (!$query_result) {
        die("Query Failed: " . mysqli_error($connection));
    }
}
?>

<table class="table table-bordered hovered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Image</th>
            <th>Content</th>
            <th>Tags</th>
            <th>Status</th>
            <script>...</script> <!-- No additional JavaScript here -->
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
            echo "<tr>";
            echo "<td>{$row['post_id']}</td>";

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
                    <input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
                </form>
            </td>
            <?php
            // Comment count
            $query_comments = "SELECT * FROM comments WHERE comment_post_id = {$row['post_id']}";
            $query_comments_result = mysqli_query($connection, $query_comments);
            $count_comments = mysqli_num_rows($query_comments_result);

            echo "<td><a href='./comment_list.php?p_id={$row['post_id']}'>{$count_comments}</a></td>";
            echo "<td>{$row['post_users']}</td>";
            echo "<td><a href='../post_comment.php?p_id={$row['post_id']}'>View Post</a></td>";
            echo "<td><a class='btn btn-info mr-2' href='./posts.php?source=post_update&p_id={$row['post_id']}'>Edit</a></td>";
            echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this Post')\" href='./posts.php?source=post_delete&p_id={$row['post_id']}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>

            <tr>
                <td>1</td>
                <td>Php</td>
                <td>Fundamental</td>
                <td>Abusidiq</td>
                <td>11 May</td>
                <td>image.img</td>
                <td>Content Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias eum vero repudiandae neque fuga iure!</td>
                <td>php, fundamental</td>
                <td>
                    <form action="" method="post">
                        <select name="status" id="">
                            <option value="1">Draft</option>
                            <option value="2">Published</option>
                        </select>
                    </form>
                </td>
                <td>1</td>
                <td>user</td>
                <td>view post</td>
                <td>editt</td>
                <td>delete</td>
            </tr>
    </tbody>
</table>
