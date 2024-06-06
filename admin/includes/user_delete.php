<?php
if (isset($_GET['user_id'])) {
    $get_user_id = $_GET['user_id'];


    $query = "DELETE FROM users WHERE user_id = '{$get_user_id}'";
    $query_result = mysqli_query($connection, $query);
    header("Location: ./users.php");
}


?>