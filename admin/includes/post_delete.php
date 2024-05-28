<?php
// Confirm if the get requset is set
if (isset($_GET['p_id'])) {
    $get_post_id = $_GET['p_id'];
}

$query = "DELETE FROM posts WHERE post_id = '{$get_post_id}'";
$del_query_result = mysqli_query($connection, $query);
if (!$del_query_result) {
    die("Query Failed" . mysqli_error($connection));
}
header("Location: posts.php");

?>