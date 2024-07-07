<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
if (!isset($_GET['email']) && !isset($_GET['token'])) {
    header("Location: login.php");
    exit;
}


$message = "";


// Values get from the mail including token and mail address
$token = $_GET['token'];
$email = $_GET['email'];

// PREPARE STATEMENT TO CHECK IF TOKEN EXISTS IN DATABASE
$query = "SELECT token FROM users WHERE token = ?";
$query_result = mysqli_prepare($connection, $query);
if (!$query_result) {
    die("Prepare failed: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($query_result, "s", $token);

if (!mysqli_stmt_execute($query_result)) {
    die("Execute failed: " . mysqli_stmt_error($query_result));
}

// Bind result variables
mysqli_stmt_bind_result($query_result, $retrieved_token);

// Check if the token exists
if (!mysqli_stmt_fetch($query_result)) {
    $message = "No user found with the provided token.";
    mysqli_stmt_close($query_result);
    header("Location: login.php");
    exit;
}

// Close the statement
mysqli_stmt_close($query_result);


// 
// 
// 
// SUBMIT BUTTON
// 
// 
// 
if (isset($_POST['recover-submit'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    if (empty($password) || empty($confirmPassword)) {
        $message = "<h4 class='alert alert-warning'> Password can't be empty </h4>";
    }

    elseif ($password === $confirmPassword) {
        $hashPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        // PREPARE STATEMENT TO UPDATE PASSWORD
        $query = "UPDATE users SET token = '', password = ? WHERE token = ?";
        $query_result = mysqli_prepare($connection, $query);
        if (!$query_result) {
            die("Prepare failed: " . mysqli_error($connection));
        }
        
        mysqli_stmt_bind_param($query_result, "ss", $hashPassword, $token);
        
        if (!mysqli_stmt_execute($query_result)) {
            die("Execute failed: " . mysqli_stmt_error($query_result));
        }
        
        // Close the statement
        mysqli_stmt_close($query_result);
        // TO be adjusted(Style)
        $message = "<h4 class='alert alert-success'> Password reset successfully. <a href='login.php'>Login</a>";
    } else {
        $message = "<h4 class='alert alert-danger'> Passwords do not match.</h4>";
    }
}


?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                                <?php echo $message?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Enter Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-check color-blue"></i></span>
                                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <!-- <h2>Please check your email</h2> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

