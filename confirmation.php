<?php
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
                <span class="p-name">Title, Name</span>
                <span class="airline-code">#SAR</span>
            </div>
            
            <div class="ticket-info">
                <small>#Ticket Number</small>
                <div class="flight-route">
                    <div class="city">
                        <strong>JED</strong>
                        <span>20:20</span>
                    </div>
                    <div class="path">
                        <span class="duration">Non-Stop 1h 5m</span>
                        <div class="line"><i class="fa-solid fa-plane"></i></div>
                    </div>
                    <div class="city">
                        <strong>MED</strong>
                        <span>21:25</span>
                    </div>
                </div>
            </div>

            <div class="passenger-details">
                <strong>passengers details</strong>
                <ul class="p-list">
                    <li>
                        <span>Ali</span>
                        <span class="p-type">(Adult)</span>
                    </li>
                    <li>
                        <span>Fatimah</span>
                        <span class="p-type">(Child)</span>
                    </li>
                    <li class="empty-line"></li>
                </ul>
            </div>
        </div>

        <div class="action-area">
            <a href="home/home.php" class="btn-ok">OK</a>
        </div>

    </main>
<?php include('footer/footer.php'); ?>