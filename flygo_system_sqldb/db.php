<?php


$host = "localhost";
$username = "root";
$pass = "";
$db = "flygo_system";

$conn = mysqli_connect($host, $username, $pass, $db);

if (!$conn) {
    $_SESSION['SignUp_error'] = "Database connection failed. Please try again later.";
    header("Location: ../SignUp-Page/SignUp-Page.php");
    exit;
}
