<?php
session_start();
require_once('../flygo_system_sqldb/db.php');

if (!isset($_SESSION['passport'])) {
    header("Location: ../SignIn-Page/SignIn-Page.php");
    exit;
}

$currentPassport = $_SESSION['passport'];

/* استلام البيانات */
$first_name  = trim($_POST['first-name']);
$last_name   = trim($_POST['last-name']);
$nationality = $_POST['nationality'];
$newPassport = trim($_POST['passport-number']);
$phone       = trim($_POST['phone-number']);
$email       = trim($_POST['email']);
$birth_date  = $_POST['birth-date'];
$title       = $_POST['title'] ?? null;
$password    = $_POST['password'] ?? '';

$stmt = mysqli_prepare(
    $conn,
    "SELECT passport FROM passenger WHERE passport = ? AND passport != ?"
);
mysqli_stmt_bind_param($stmt, "ss", $newPassport, $currentPassport);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    $_SESSION['Update_error'] = "Passport number already exists.";
    header("Location: Update-Profile.php");
    exit;
}
mysqli_stmt_close($stmt);


$stmt = mysqli_prepare(
    $conn,
    "SELECT email FROM user WHERE email = ? AND passport != ?"
);
mysqli_stmt_bind_param($stmt, "ss", $email, $currentPassport);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    $_SESSION['Update_error'] = "Email already exists.";
    header("Location: Update-Profile.php");
    exit;
}
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare(
    $conn,
    "UPDATE passenger
     SET title=?, first_name=?, last_name=?, nationality=?, passport=?, birth_date=?
     WHERE passport=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "sssssss",
    $title,
    $first_name,
    $last_name,
    $nationality,
    $newPassport,
    $birth_date,
    $currentPassport
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE user
         SET email=?, phone_number=?, password=?, passport=?
         WHERE passport=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $email,
        $phone,
        $hashed,
        $newPassport,
        $currentPassport
    );
}
else {
    $stmt = mysqli_prepare(
        $conn,
        "UPDATE user
         SET email=?, phone_number=?, passport=?
         WHERE passport=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $email,
        $phone,
        $newPassport,
        $currentPassport
    );
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$_SESSION['passport'] = $newPassport;
$_SESSION['Profile_success'] = "Profile Updated Successfully!";

header("Location: Profile.php");
exit;
