<?php 
    // Query to get the post data from database using the unique post id getting from the get request link sent to this page
    if (isset($_GET['p_id'])) {
        $get_post_id = $_GET['p_id'];
    }
    
    $query = "SELECT * FROM posts WHERE post_id = '{$get_post_id}'";
    $query_post_id_result = mysqli_query($connection, $query);
    if (!$query_post_id_result) {
        die("Query Failed" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($query_post_id_result)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_users = $row['post_users'];
        
    }
    
    
    
    
    ?>





<!-- FORM UPDATE -->
<form action="" method="post" enctype="multipart/form-data">
    <h2>Edit Post <?php echo $get_post_id;?></h2>
    <div class="form-group">

        <label for="">Categories</label><br>
        <select name="post_category_id" id="post_category" class>
            <option value="<?php echo $post_category_id?>"><?php echo $post_category_id?></option>
        </select>
        </div>

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author;?>" type="text" class="form-control" name="post_users">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class ="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content?></textarea>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags;?>"type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="" class="control">
        <option value=<?php echo $post_status?>><?php echo $post_status?></option> <!-- Default -->
            <option value="published">Draft*</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_users">Post User</label>
        <input value="<?php echo $post_users;?>"type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <input class= "btn btn-primary" type="submit" class="form-control" name="submit" value="Update Post">
    </div>
</form>