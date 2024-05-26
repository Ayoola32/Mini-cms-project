<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update Categories</label>

        <?php
            if (isset($_GET['edit'])) {
                $cat_id = $_GET['edit'];

                $query = "SELECT * FROM category_header WHERE cat_id = $cat_id";
                $update_cat_result = mysqli_query($connection, $query);
                
                while ($row = mysqli_fetch_assoc($update_cat_result)) {
                    $admin_cat_id= $row["cat_id"];
                    $admin_cat_title= $row["cat_title"];

        ?>

            <input value="<?php if(isset($admin_cat_title)){echo $admin_cat_title;}?>" class= "form-control" type="text" name="cat_title">
            
        <?php } } ?>


        <?php //UPDATE CATEGORY
            if (isset($_POST['update'])) {
                $edit_cat_title = $_POST['cat_title'];

                $query = "UPDATE category_header SET cat_title = '{$edit_cat_title}' WHERE cat_id = {$cat_id}";
                $edit_result = mysqli_query($connection, $query);
                    if (!$edit_result) {
                        die("Query Failed" . mysqli_error($connection));
                    }
                    header("Location: categories.php");
            }          
        ?>

    </div>

    <div class="form-group">
        <input type="submit" value="Update Category" name="update" class="btn btn-primary">
    </div>

</form>
