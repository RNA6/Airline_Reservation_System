<?php
include "flygo_system_sqldb/database.php";

/* check ticket number*/
if (!isset($_GET['ticket_number'])) {
    die("No ticket selected");
}

$ticket_number = $_GET['ticket_number'];

/* trip details */
$flight_sql = "
SELECT 
    t.ticket_number,
    t.class,
    f.origin,
    f.destination,
    f.departure_time,
    f.arrival_time
FROM ticket t
JOIN flights f ON t.flight_number = f.flight_number
WHERE t.ticket_number = ?
";

$stmt = mysqli_prepare($connection, $flight_sql);
mysqli_stmt_bind_param($stmt, "i", $ticket_number);
mysqli_stmt_execute($stmt);
$flight = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$flight) {
    die("Trip not found");
}

/*passengers*/
$passengers_sql = "
SELECT 
    p.title,
    p.first_name,
    p.last_name,
    p.age_group,
    e.seat,
    e.meal
FROM passenger p
JOIN extra e ON p.passport = e.passport
WHERE e.ticket_number = ?
";

$stmt2 = mysqli_prepare($connection, $passengers_sql);
mysqli_stmt_bind_param($stmt2, "i", $ticket_number);
mysqli_stmt_execute($stmt2);
$passengers = mysqli_stmt_get_result($stmt2);

    session_start();
        $title ="Trip Details";
    include('header/head.php'); 
?>
</head>
<body>
    <?php 
    include('header/header.php'); ?>
<main class="confirmation-container">

    <h1 class="page-title" style="color:#000">Trip Details</h1>

    <div class="ticket-card centered-ticket">

        
        <div class="ticket-header">
            <span class="p-name">
                <?= $flight['class']; ?> Class
            </span>
            <span class="airline-code">#SAR</span>
        </div>

        <!-- Ticket Info -->
        <div class="ticket-info">
            <small>#<?= $flight['ticket_number']; ?></small>

            <div class="flight-route">

                <div class="city">
                    <strong><?= $flight['origin']; ?></strong>
                    <span><?= date("H:i", strtotime($flight['departure_time'])); ?></span>
                </div>

                <div class="path">
                    <span class="duration">Non-Stop</span>
                    <div class="line">
                        <i class="fa-solid fa-plane"></i>
                    </div>
                </div>

                <div class="city">
                    <strong><?= $flight['destination']; ?></strong>
                    <span><?= date("H:i", strtotime($flight['arrival_time'])); ?></span>
                </div>

            </div>
        </div>

        <!-- Passengers -->
        <div class="passenger-details">
            <strong>Passengers Details</strong>

            <ul class="p-list">
                <?php while ($p = mysqli_fetch_assoc($passengers)): ?>
                    <li>
                        <span>
                            <?= $p['title']; ?>
                            <?= $p['first_name']; ?>
                            <?= $p['last_name']; ?>
                        </span>

                        <span class="p-type">
                            (<?= $p['age_group']; ?>)
                            | Seat: <?= $p['seat']; ?>
                            | Meal: <?= $p['meal']; ?>
                        </span>
                    </li>
                <?php endwhile; ?>

                <li class="empty-line"></li>
            </ul>
        </div>

    </div>

    <!-- Buttons -->
    <div class="action-buttons-blue">
        <a href="cancel_booking.php?ticket_number=<?= $flight['ticket_number']; ?>"
        class="btn-blue-outline"
        onclick="return confirm('Are you sure you want to cancel this booking?');">
        Cancel Booking
        </a>

        <a href="home/home.php" class="btn-blue-outline">
            OK
        </a>
    </div>

</main>

<?php include('footer/footer.php'); ?>