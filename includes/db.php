<?php
// Another way to connect to the database instead of mysqli_connect("localhost", "root", "password", "db_name");
// $connection = mysqli_connect("localhost", "root", "", "cms_git");


$db["db_host"] = "localhost";
$db["db_user"] = "root";
$db["db_pass"] = "";
$db["db_name"] = "cms_git";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}