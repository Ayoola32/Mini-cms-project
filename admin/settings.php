<?php include "includes/admin_header.php"; ?>
<?php
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $query_result = mysqli_query($connection, $query);

        if ($query_result) {
            $row = mysqli_fetch_assoc($query_result);
            $db_password = $row['password'];
        }
    }

    if (isset($_POST['submit'])) {
        $password = $_POST['password'];
        $new_password = $_POST['new_password'];
        $new_confirm_password = $_POST['confirm_password'];

        // Sanitize input
        $password = mysqli_real_escape_string($connection, $password);
        $new_password = mysqli_real_escape_string($connection, $new_password);
        $new_confirm_password = mysqli_real_escape_string($connection, $new_confirm_password);

         // Hash Password
        $randSalt = "alwayskeepchaseYOURgreatness2024tilleternity";

        if (empty($new_password) || empty($new_confirm_password)) {
            $message = "<h4 class='text-center alert alert-danger'>New password fields cannot be empty.</h4>";
        } else {
            if (password_verify($password, $db_password)) {
                if ($new_password === $new_confirm_password) {
                    $hashed_new_password = password_hash($new_confirm_password, PASSWORD_BCRYPT, array($randSalt => 12 ));

                    $query = "UPDATE users SET password = '{$hashed_new_password}' WHERE user_id = $user_id";
                    $query_result = mysqli_query($connection, $query);

                    if ($query_result) {
                        $message = "<h4 class='text-center alert alert-success'>Password updated successfully.</h4>";
                    } else {
                        $message = "<h4 class='text-center alert alert-warning'>Error updating password: " . mysqli_error($connection) . "</h4>";
                    }
                } else {
                    $message = "<h4 class='text-center alert alert-warning'>New passwords do not match.</h4>";
                }
            } else {
                $message = "<h4 class='text-center alert alert-danger'>Current password is incorrect.</h4>";
            }
        }
    } else {
        $message = "";
    }
?>





<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Change Password
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Change password
                        </li>
                    </ol>
                </div>

                <div class="col-xs-4">
                    <h4 class="text-center"><?php echo $message;?></h4>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password"> Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" class="form-control" name="submit" value="Change Password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
