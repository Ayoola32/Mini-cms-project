<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>

<?php
if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // sanitize input
    $username = mysqli_real_escape_string($connection, $username);
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection,$password);
   
    // Hash Password
    $randSalt = "alwayskeepchaseYOURgreatness2024tilleternity";
    // $password = crypt($password, $randSalt); 

    //Advance hashpassworrd
    $password = password_hash($password, PASSWORD_BCRYPT, array($randSalt => 12 ));

    // fetching usernames from database to confirm with new one
    $query = "SELECT username FROM users WHERE username = '{$username}'";
    $query_db_username = mysqli_query($connection, $query);
    if (!$query_db_username) {
        die("Query Failed:" . mysqli_error($connection));
    }

    // fetching email from database to confirm with new one
    $query = "SELECT user_email FROM users WHERE user_email = '{$email}'";
    $query_db_email = mysqli_query($connection, $query);
    if (!$query_db_email) {
        die("Query Failed:" . mysqli_error($connection));
    }


 
    if (empty($username && $email && $password)) {
        $message = "<h4 class='text-center alert alert-danger' role='alert'>Field can't be empty</h4>";
    }elseif (mysqli_num_rows($query_db_username)>0 || mysqli_num_rows($query_db_email)>0) {
        $message = "<h4 class='alert alert-warning text-center'>Details has been taken</h4>";
    }else{
    // Using prepared statements to prevent SQL injection
    $query = "INSERT INTO users (username, `password`, user_firstname, user_lastname, user_email, user_image, user_role, user_date_created) ";
    $query.= "VALUES (?, ?, '', '', ?, '', 'subscriber', NOW())";
    $query_result = mysqli_prepare($connection, $query);
   
    mysqli_stmt_bind_param($query_result, "sss", $username, $password, $email);
    
    if (!mysqli_stmt_execute($query_result)) {
        die("Execute failed: " . mysqli_stmt_error($query_result));
    }
    $message = "<h4 class='text-center alert alert-success'>Register Successfully" . " " . "<a class='bg-success' href=./index.php>Login</a></h4>";
    // mysqli_stmt_close($query_result);
    // mysqli_close($connection);
    // header("Location: ./users.php");
    }
    
}else {
    $message="";
}

?>


<!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">
                            <div class="form-wrap">
                                <h1>Register New User</h1>
                                <div class="panel-body">

                                    <h6 class="text-center"><?php echo $message;?></h6>
                                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                        <div class="form-group">
                                            <label for="username" class="sr-only">username</label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter New Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="sr-only">Password</label>
                                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                        </div>
                                
                                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
