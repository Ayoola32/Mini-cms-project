<?php
// IF statemtnet to get the GET request from user_view_all page on clicking edit button 
if (isset($_GET['user_id'])) {
    $get_user_id = $_GET['user_id'];

    $query = "SELECT * FROM users WHERE user_id = '{$get_user_id}'";
    $query_result = mysqli_query($connection, $query);
    if (!$query_result) {
        die("Query Failed" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($query_result)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }

}else {
    header("Location: ./users.php");
}
    

// Handle POST request for user update
if (isset($_POST['submit'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['password'];
    $user_role = $_POST['user_role'];
    
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");
    // incase image input is empty
    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = $get_user_id";
        $query_result = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_assoc($query_result)) {
            $user_image = $row['user_image'];
        }
    }
    
    //Advance Hash Password
    $randSalt = "alwayskeepchaseYOURgreatness2024tilleternity";
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array($randSalt => 10 ));
    
    
    //Fetch username from database
    $query = "SELECT username FROM users WHERE username = '{$username}'";
    $db_query_username = mysqli_query($connection, $query);
    if (!$db_query_username) {
        die("Query Failed" . mysqli_error($connection));
    }
    
    
    // Fetch email form database
    $query = "SELECT user_email FROM users WHERE user_email = '{$user_email}'";
    $db_query_user_email = mysqli_query($connection, $query);
    if (!$db_query_user_email) {
        die("Query Failed" . mysqli_error($connection));
    }
    
    
    
    if (empty($user_firstname) || empty($user_lastname) || empty($username) || empty($user_email) || empty($user_password) || empty($user_image)) {
        echo "<h3>Field can't be empty</h3>";
    }elseif (mysqli_num_rows($db_query_user_email)>1 || mysqli_num_rows($db_query_username)>1){
        echo "<h4 class=''>Details has been taken</h4>";
    }else{
        
        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "password = '{$user_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE user_id = {$get_user_id}";
        
        $query_result = mysqli_query($connection, $query);
        if (!$query_result) {
            die("Query Failed" . mysqli_error($connection));
        }else {
            echo "<h2 class='text-center'>User Updated</h2>";
        }
        // header("Location: ./users.php");
    }
}

    
    
?>



<div class="col-xs-4">
    <h2>Update User's </h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input value="<?php echo $user_firstname?>"type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input value="<?php echo $user_lastname?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username?>" type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email?>" type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role?>"><?php echo ucwords($user_role)?></option>
            <?php
                if ($user_role == 'admin') {
                    echo "<option value='subscriber'>Subscriber</option>";
                }else {
                    echo "<option value='admin'>Admin</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label><br>
        <img width="50" src="../images/<?php echo $user_image?>" alt="">
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <input class= "btn btn-primary" type="submit" class="form-control" name="submit" value="Update User">
    </div>
</form>
</div>