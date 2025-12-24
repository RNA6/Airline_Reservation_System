<?php
    session_start();
    $title ="View Trip details";
    include('header/head.php'); 
?>
</head>
<body>
    <?php include('header/header.php'); ?>
    <main class="manage-container">
        
        <div class="user-corner">
            <i class="fa-solid fa-user"></i>
        </div>

        <h1 class="page-title left-align">View Trip details</h1>

        <form action="search_trip.php" method="POST" class="manage-form">

            <div class="form-group">
                <input type="text" name="ticket_number" class="input-box"
                    placeholder="Ticket Number" required>
            </div>

            <div class="form-group">
                <input type="text" name="last_name" class="input-box"
                    placeholder="Last Name" required>
            </div>

            <div class="manage-actions">
                <a href="home/home.php" class="btn-gray-outline">Cancel</a>
                <button type="submit" class="btn-blue-outline">View</button>
            </div>

        </form>



    </main>
<?php include('footer/footer.php'); ?>