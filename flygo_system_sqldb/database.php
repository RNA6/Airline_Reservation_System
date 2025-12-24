<!--For Raihanah since I use different port number-->
<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "flygo_system";

    $connection = mysqli_connect($host, $username, $password, $dbname);

    if (mysqli_connect_errno()){
        echo "no connsection: ". mysqli_connect_error();
        exit();
    }
    if (!$connection) {
    $_SESSION['SignUp_error'] = "Database connection failed. Please try again later.";
    header("Location: ../SignUp-Page/SignUp-Page.php");
    exit;
}
?>