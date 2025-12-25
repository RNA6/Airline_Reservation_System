<?php
    include "flygo_system_sqldb/database.php";
    include("flygo_system_sqldb/database_utilities.php");

    $result = execute_query("SELECT ticket_number FROM ticket ORDER BY ticket_number DESC LIMIT 1;", $connection);
    $row = mysqli_fetch_assoc($result);
    /* trip details */
    $flight_sql = "
    SELECT 
        t.ticket_number,
        t.travel_class,
        f.origin,
        f.destination,
        f.departure_time,
        f.arrival_time
    FROM ticket t
    JOIN flights f ON t.flight_number = f.flight_number
    WHERE t.ticket_number = ?
    ";

    $stmt = mysqli_prepare($connection, $flight_sql);
    $ticket_number = $row['ticket_number'];
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
    $title ="Payment successful";
    include('header/head.php'); 
?>
</head>
<body>
    <?php include('header/header.php'); ?>
    <main class="confirmation-container">
        
        <h2 class="success-title">Ticket payment successful</h2>

        <div class="ticket-card centered-ticket">

        
            <div class="ticket-header">
                <span class="p-name">
                    <?= $flight['travel_class']; ?> Class
                </span>
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

        <div class="action-area">
            <a href="home/home.php" class="btn-ok">OK</a>
        </div>

    </main>
<?php include('footer/footer.php'); ?>