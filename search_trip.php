<?php
include "flygo_system_sqldb/db.php";

$ticket_number = $_POST['ticket_number'];
$last_name = $_POST['last_name'];

$sql = "
SELECT t.ticket_number
FROM ticket t
JOIN extra e ON t.ticket_number = e.ticket_number
JOIN passenger p ON e.passport = p.passport
WHERE t.ticket_number = ?
AND p.last_name = ?
LIMIT 1
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "is", $ticket_number, $last_name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    header("Location: trip_details.php?ticket_number=$ticket_number");
} else {
    echo "No booking found";
}