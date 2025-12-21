<!--For Raihanah since I use different port number-->
<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "flygo_system";
    $port = 3307;

    $connection = mysqli_connect($host, $username, $password, $dbname, $port);

    if (mysqli_connect_errno()){
        echo "no connsection: ". mysqli_connect_error();
        exit();
    }
?>