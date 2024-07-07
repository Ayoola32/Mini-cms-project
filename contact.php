<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>


<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<?php require "./vendor/autoload.php"; ?>
<?php require "./classes/config.php"; ?>

<?php
$message = '';
if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];



    // CONFIGURE PHPMAILER
    $mail = new PHPMailer(true);        
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'aabubakarsidiqq@gmail.com';            // SMTP username
        $mail->Password   = 'Godgrace3022';                         // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption
        //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port       = 465;                                    // TCP port to connect to
        $mail->CharSet    = 'UTF-8';                                // Set Character to UTF-8

        //Recipients
        $mail->setFrom('aabubakarsidiqq@gmail.com', 'Abubakar Sidiq');
        $mail->addAddress($email, $name);                           

        //Content
        $mail->isHTML(true);                                                       // Set email format to HTML
        $mail->Subject = 'Message from contact page'; 
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $message = "<h4 class= 'alert alert-success text-center'> Message Sent </h4>";
    } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    function save_mail($mail)
    {
        //You can change 'Sent Mail' to any other folder or tag
        $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
    
        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
        $imapStream = imap_open($path, $mail->Username, $mail->Password);
    
        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);
    
        return $result;
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

                                    <h6 class="text-center"><?php echo $message;?></h6>
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


        <hr>



<?php include "includes/footer.php";?>
