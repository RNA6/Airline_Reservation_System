<?php
    session_start();
    include "flygo_system_sqldb/database.php";

if (!isset($_GET['ticket_number'])) {
    die("No ticket selected");
}

$ticket_number = $_GET['ticket_number'];

/* remove*/
$delete_extra = "DELETE FROM extra WHERE ticket_number = ?";
$stmt1 = mysqli_prepare($connection, $delete_extra);
mysqli_stmt_bind_param($stmt1, "i", $ticket_number);
mysqli_stmt_execute($stmt1);

/* ancel ticket*/
$delete_ticket = "DELETE FROM ticket WHERE ticket_number = ?";
$stmt2 = mysqli_prepare($connection, $delete_ticket);
mysqli_stmt_bind_param($stmt2, "i", $ticket_number);
mysqli_stmt_execute($stmt2);


header("Location: cancel_success.php?ticket_number=$ticket_number");
exit;
