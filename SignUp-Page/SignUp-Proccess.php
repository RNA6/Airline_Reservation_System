<?php
session_start();
require_once('../flygo_system_sqldb/database.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../SignUp-Page/SignUp-Page.php");
    exit;
}

$first_name = trim($_POST['first-name']);
$last_name  = trim($_POST['last-name']);
$nationality = $_POST['nationality'];
$passport   = trim($_POST['passport-number']);
$phone      = trim($_POST['phone-number']);
$email      = trim($_POST['email']);
$birth_date = $_POST['birth-date'];
$title      = $_POST['title'] ?? null;
$password   = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//Check for Passport duplication
$stmt = mysqli_prepare($connection, "SELECT passport FROM passenger WHERE passport = ?");
mysqli_stmt_bind_param($stmt, "s", $passport);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    $_SESSION['SignUp_error'] =
        "Passport number already exists. Please sign in or use another passport.";
    header("Location: ../SignUp-Page/SignUp-Page.php");
    exit;
}
mysqli_stmt_close($stmt);

//Check for Email duplication
$stmt = mysqli_prepare($connection, "SELECT email FROM user WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    $_SESSION['SignUp_error'] =
        "Email already exists. Please sign in to continue.";
    header("Location: ../SignUp-Page/SignUp-Page.php");
    exit;
}
mysqli_stmt_close($stmt);

//Pass data to Passenger table
$age_group = "Adult";

$stmt = mysqli_prepare($connection,
    "INSERT INTO passenger (title, first_name, last_name, nationality, passport, birth_date, age_group)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param(
    $stmt,
    "sssssss",
    $title,
    $first_name,
    $last_name,
    $nationality,
    $passport,
    $birth_date,
    $age_group
);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

//Pass data to User table
$stmt = mysqli_prepare($connection,
    "INSERT INTO user (passport, email, password, phone_number)
     VALUES (?, ?, ?, ?)"
);
mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $passport,
    $email,
    $hashedPassword,
    $phone
);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$_SESSION['SignUp_success'] = "Account Created Successfully!, Welcome to FlyGo website";
header("Location: ../SignIn-Page/SignIn-Page.php");
exit;
