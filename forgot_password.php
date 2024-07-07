<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php require "./vendor/autoload.php"; ?>
<?php require "./classes/config.php"; ?>


<?php
// Check if the request method is GET and it holds a 'forgot' parameter with a value from forgot password link
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['forgot']) || empty($_GET['forgot'])) {
        header("Location: login.php");
        exit;
    }
}



if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));

    // Fetching email from database to confirm with new one
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query Failed" . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($result);
    if ($row && $row['user_email'] == $email) {
        // Using prepared statements to prevent SQL injection
        $query = "UPDATE users SET token = ? WHERE user_email = ?";
        $query_result = mysqli_prepare($connection, $query);
        if (!$query_result) {
            die("Prepare failed: " . mysqli_error($connection));
        }
        
        mysqli_stmt_bind_param($query_result, "ss", $token, $email);
        
        if (!mysqli_stmt_execute($query_result)) {
            die("Execute failed: " . mysqli_stmt_error($query_result));
        }
        mysqli_stmt_close($query_result);




        // CONFIGURE PHPMAILER
       $mail = new PHPMailer(true);        
       try {
           //Server settings
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
          // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
           $mail->isSMTP();                                            // Send using SMTP
           $mail->Host       = Config::SMTP_HOST;                      // Set the SMTP server to send through
           $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
           $mail->Username   = Config::SMTP_USER;                      // SMTP username
           $mail->Password   = Config::SMTP_PASSWORD;                  // SMTP password
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
           $mail->Port       = Config::SMTP_PORT;                      // TCP port to connect to
           $mail->CharSet    = 'UTF-8';                                // Set Character to UTF-8

           //Recipients
           $mail->setFrom('aabubakarsidiqq@gmail.com', 'Abubakar Sidiq');
           $mail->addAddress($email);                           

           //Content
           $mail->isHTML(true);                                        // Set email format to HTML
           $mail->Subject = 'Password Reset Request'; 
           $mail->Body    = '<p><b>Please click here to reset your password </b><a href="http://localhost/cmsProjectGit/reset.php?email=' . $email .'&token=' . $token .'">http://localhost:888/cmsProjectGit/reset.php?email=' . $email .'&token=' . $token .'</a></p>';
           $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

           $mail->send();
            //    To be adjustted
           $message = "<h4 class= 'alert alert-success text-center'>Password request has been sent, check your mail</h4>";
        } catch (Exception $e) {
            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }else {
        $message = "<h4 class='alert alert-warning text-center'>Wrong Email Address</h4>";
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
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form action="" id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

