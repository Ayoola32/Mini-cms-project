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

    // For displaying the default header categories
    $query = "SELECT * FROM category_header WHERE cat_id = $post_category_id";
    $query_result_result = mysqli_query($connection, $query);
    if (!$connection) {
        die("Query Failed" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($query_result_result)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
    }




    // Query to send the updated version of the post back to the database
    if (isset($_POST['submit'])) {
        $post_category_id = $_POST['post_category_id'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
        $post_users = $_POST['post_users'];
        
        
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES["post_image"]['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/$post_image");

        // Incase image input is empty
        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
            $query_result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($query_result)) {
                $post_image = $row['post_image'];
            }
        }


        if (empty($post_category_id) || empty($post_title) || empty($post_author) || empty($post_content) || empty($post_tags) || empty($post_status) || empty($post_users)) {
            echo "<h3 class='text-center'>Field can't be empty</h3>";
        }else{

        }
        
    }
    
    
    
    
    
?>





<!-- FORM UPDATE -->
<form action="" method="post" enctype="multipart/form-data">
    <h2>Edit Post: <?php echo $get_post_id;?></h2>
    <div class="form-group">

        <label for="">Categories</label><br>
        <select name="post_category_id" id="post_category" class>
            <option value="<?php echo $cat_id?>"><?php echo $cat_title?></option>
            <?php
            $query = "SELECT * FROM category_header";
            $query_result = mysqli_query($connection, $query);
            if (!$query_result) {
                die("Query Failed" . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($query_result)) {
                $cat_id    = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
        </div>

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author?>" type="text" class="form-control" name="post_author" readonly>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img width="200" src="../images/<?php echo $post_image?>" alt="post_image">
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
        <option value=<?php echo $post_status?>><?php echo ucwords($post_status)?></option> <!-- Default -->
            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
            }else{
                echo "<option value='published'>Published</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_users">Post User</label>
        <input value="<?php echo $post_users;?>"type="text" class="form-control" name="post_users">
    </div>

    <div class="form-group">
        <input class= "btn btn-primary" type="submit" class="form-control" name="submit" value="Update Post">
    </div>
</form>