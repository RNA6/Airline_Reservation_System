<?php
include("flygo_system_sqldb/database.php");
include("flygo_system_sqldb/database_utilities.php");
include("flygo_system_sqldb/classes.php");

session_start();

insert_all($connection);

if (!isset($_SESSION['passport'])) {
    header("Location: SignIn-Page/SignIn-Page.php");
    exit;
}

$cardNumber = $_POST['card_number'];
$firstName  = $_POST['first_name'];
$lastName   = $_POST['last_name'];
$cvv        = $_POST['cvv'];

$expMonth = $_POST['exp_month'];
$expYear  = $_POST['exp_year'];
$expiry   = $expYear . "-" . $expMonth . "-01";

$passport = $_SESSION['passport'];

$sql = "
    INSERT INTO credit_card
    (card_number, passport, first_name, last_name, expairy_date, cvv)
    VALUES (?, ?, ?, ?, ?, ?)
";

$stmt = $connection->prepare($sql);
$stmt->bind_param(
    "ssssss",
    $cardNumber,
    $passport,
    $firstName,
    $lastName,
    $expiry,
    $cvv
);

$stmt->execute();

$stmt->close();
$connection->close();

header("Location: confirmation.php");
exit;
