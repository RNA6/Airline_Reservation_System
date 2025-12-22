<?php
session_start();
require_once "../flygo_system_sqldb/db.php";

//delete previous errors
$_SESSION['login_email_error'] = "";
$_SESSION['login_pass_error'] = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['user-email']);
    $password = $_POST['user-password'];

    //bring user's email
    $sql = "
        SELECT 
            u.passport,
            u.password,
            p.first_name
        FROM user u
        JOIN passenger p ON u.passport = p.passport
        WHERE u.email = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    //if email not found
    if ($result->num_rows === 0) {
        $_SESSION['login_email_error'] = "Email does not exist";
        header("Location: ../SignIn-Page/SignIn-Page.php");
        exit;
    }

    $user = $result->fetch_assoc();

    //if password wrong
    if (!password_verify($password, $user['password'])) {
        $_SESSION['login_pass_error'] = "Incorrect password";
        header("Location: ../SignIn-Page/SignIn-Page.php");
        exit;
    }

    //Successful log in
    $_SESSION['passport']   = $user['passport'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['welcome']    = "Hello {$user['first_name']}, Welcome Back to FlyGo Website";


$auth_code = session_id();

$passport = $user['passport'];

$auth_query = "UPDATE user SET access_token = '$auth_code' WHERE passport = '$passport'";

$result = mysqli_query($conn, $auth_query);

if ($result) {
    header("Location: ../home/home.php");
    exit;
}


    header("Location: ../home/home.php");
    exit;
}


