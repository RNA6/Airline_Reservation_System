<?php
session_start();
include("../flygo_system_sqldb/db.php");

if(isset($_SESSION['passport'])) {
    $passport = $_SESSION['passport'];

    $del_query = "UPDATE user SET access_token = '' WHERE passport = '$passport'";
    $result = mysqli_query($conn, $del_query);

    unset($_SESSION['email']);
    unset($_SESSION['passport']);
    unset($_SESSION['first_name']);
    session_destroy();
}

header("Location: ../home/home.php");
exit;
?>
