<?php
    session_start();
    $ticket_number = $_GET['ticket_number'] ?? '';
    $title ="Cancellation Successful";
    include('header/head.php'); 
?>
</head>
<body>
    <?php include('header/header.php'); ?>
<main class="confirmation-container">

    <div class="ticket-card centered-ticket">
        <div class="ticket-header">
            <span class="p-name">Booking Canceled</span>
            <span class="airline-code" style="text-decoration: line-through;">SAR</span>
        </div>

        <div class="ticket-info">
            <small>Ticket #<?= htmlspecialchars($ticket_number); ?></small>
        </div>

        <div class="cancel-msg-box">
            <p>is canceled successfully</p>
            <p>you will get your money back soon</p>
        </div>
    </div>

    <div class="action-area">
        <a href="home/home.php" class="btn-ok">OK</a>
    </div>

</main>

<?php include('footer/footer.php'); ?>
