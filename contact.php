<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>


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

                                    <h6 class="text-center"><?php //echo $message;?></h6>
                                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                                        <div class="form-group">
                                            <label for="username" class="sr-only">username</label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Name">
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
