<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "includes/db.php";
require "includes/header.php";
require "includes/navigation.php";
require "vendor/autoload.php";
require "classes/config.php";

$message = '';
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<h4 class='alert alert-danger text-center'>Invalid email format</h4>";
    } else {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aabubakarsidiqq@gmail.com';
            $mail->Password = 'ynsq yqtr qyix tbtd';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('aabubakarsidiqq@gmail.com'); //enter you email address

            //Content
            $mail->isHTML(true);
            $mail->Subject = "$email ($subject)" . " From: CMS-BlogSystem";
            $mail->Body = $message;
            $mail->AltBody = strip_tags($message);

            $mail->send();
            $message = "<h4 class='alert alert-success text-center'>Message Sent Successfully</h4>";
        } catch (Exception $e) {
            $message = "<h4 class='alert alert-danger text-center'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</h4>";
        }
    }
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
                                    <h1>Contact Us</h1>
                                    <div class="panel-body">
                                        <h6 class="text-center"><?php echo $message; ?></h6>
                                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                                            <div class="form-group">
                                                <label for="name" class="sr-only">Name</label>
                                                <input type="text" name="name" id="username" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="sr-only">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="text" class="sr-only">Subject</label>
                                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="message" id="message" rows="7" class="form-control" placeholder="Message" style="resize: none;"></textarea>
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
</div>

<?php include "includes/footer.php"; ?>
