<?php
if (isset($_POST['submit'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['password'];
    $user_role = $_POST['user_role'];
    

    // Image file handling
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES["user_image"]['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");


    //Advance Hash Password
    $randSalt = "alwayskeepchaseYOURgreatness2024tilleternity";
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array($randSalt => 10 ));


    // FORM VALIDATION USING PREPARE STATMENT
    if (empty($user_firstname &&  $user_lastname && $username && $user_email && $user_password && $user_image)) {
        echo "<h3>Field can't be empty</h3>";
    }else{
        $query = "INSERT INTO users(user_firstname, user_lastname, username, user_email, `password`, user_role, user_image, user_date_created) ";
        $query .= "VALUE (?, ?, ?, ?, ?, ?, ?, NOW())";
        $query_result = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($query_result, "sssssss", $user_firstname, $user_lastname, $username, $user_email, $user_password, $user_role, $user_image);

        if (!mysqli_stmt_execute($query_result)) {
            die("Execute failed: " . mysqli_stmt_error($query_result));
        }else {
            echo "<h4>User Added Successfully <a class='bg bg-success' href='users.php' style='padding: 5px 10px; margin-left: 10px;'>View All Users</a></h4>";
        }
        mysqli_stmt_close($query_result);
        mysqli_close($connection);

    }




}

?>

<div class="col-xs-4">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Role</option> <!-- Default -->
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <input class= "btn btn-primary" type="submit" class="form-control" name="submit" value="Add User">
    </div>
</form>
</div>