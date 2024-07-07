<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $user_message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($user_message)) {
        $message = "<h4 class='alert alert-warning text-center'>All fields must be filled out.</h4>";
    } else {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aabubakarsidiqq@gmail.com';
            $mail->Password = 'Godgrace3022';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('your_gmail_here', 'Your Name Here');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $user_message;
            $mail->AltBody = strip_tags($user_message);

            $mail->send();
            $message = "<h4 class='alert alert-success text-center'>Message has been sent successfully.</h4>";
        } catch (Exception $e) {
            $message = "<h4 class='alert alert-danger text-center'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</h4>";
        }
    }
}
?>

<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <div class="form-wrap">
                                    <h1>Contact Us</h1>
                                    <div class="panel-body">
                                        <h6 class="text-center"><?php echo $message; ?></h6>
                                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                                            <div class="form-group">
                                                <input type="text" name="name" id="username" class="form-control" placeholder="Name" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="message" id="message" rows="7" class="form-control" placeholder="Message" style="resize: none;" required></textarea>
                                            </div>
                                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
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
</div>

<?php include "includes/footer.php"; ?>
