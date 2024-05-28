<?php
    if(isset($_POST['submit'])){
        $post_category_id   = $_POST['post_category_id'];
        $post_title         = $_POST['post_title'];
        $post_author        = $_POST['post_author'];
        $post_date          = date('d-m-Y H:i:s');
        $post_content       = $_POST['post_content'];
        $post_tags          = $_POST['post_tags'];
        $post_comment_count = 4;
        $post_status        = $_POST['post_status'];
        $post_users         = $_POST['post_users'];

        $post_image         = $_FILES['post_image']['name'];
        $post_image_temp    = $_FILES["post_image"]['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/$post_image");
    

        if (empty($post_category_id && $post_title && $post_author && $post_content && $post_tags && $post_status && $post_users)) {
            echo "<h3 class='text-center'>Field can't be empty</h3>";
        }else{
            // using prepare method write a query to add a new post and save to db and display it back to the admin and also homepage
            $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_content, post_tags, post_status, post_image, post_users, post_comment_count, post_date) ";
            $query.= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $query_result = mysqli_prepare($connection, $query);

            mysqli_stmt_bind_param($query_result, "isssssssi", $post_category_id, $post_title, $post_author, $post_content, $post_tags, $post_status, $post_image, $post_users, $post_comment_count);
            if (!mysqli_stmt_execute($query_result)) {
                die("Execute failed: " . mysqli_stmt_error($query_result));
            }
                mysqli_stmt_close($query_result);
                mysqli_close($connection);
                header("Location: ./posts.php");
        }
    }

?>




<form action="" method="post" enctype="multipart/form-data">
    <h2>Add New Post</h2>
    <div class="form-group">
        <!-- Display Categories from database so as to be able to select it dynamically from the add new post page -->
        <label for="">Categories</label><br>
        <select name="post_category_id" id="post_category" class>
            <option value="">Select Category</option>
            <?php
            $query = "SELECT * FROM category_header";
            $query_cat_result = mysqli_query($connection, $query);
            if (!$query_cat_result) {
                die("Query Failed" . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($query_cat_result)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>$cat_title</option>";
            }
            ?>
        </select>
        </div>

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class ="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="" class="control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_users">Post User</label>
        <input type="text" class="form-control" name="post_users">
    </div>

    <div class="form-group">
        <input class= "btn btn-primary" type="submit" class="form-control" name="submit" value="Add Post">
    </div>
</form>