<?php include "db.php"?>
<?php session_start();?>


<?php
if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];


    //  Help to prevent SQL injection attacks.
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $query_result = mysqli_query($connection, $query);
    if (!$query_result) {
        die("Query Failed" . mysqli_error($connection));
    }



    if($row = mysqli_fetch_assoc($query_result)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['password'];
        $db_user_email = $row['user_email'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        if (password_verify($password, $db_user_password)) {
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_email'] = $db_user_email;
            $_SESSION['user_role'] = $db_user_role;
    
            header("Location: ../admin/index.php");
            exit;
        }else {
            header("Location: ../index.php");
            exit;
        }
    }else {
        header("Location: ../index.php");
        exit;
    }

}

?>