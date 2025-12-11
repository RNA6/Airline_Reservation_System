<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flight Arrival</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <main class="common-container">
        
        <h2 class="head-title flights">
            ##Madinah   <span class="fa-solid fa-arrow-right" style="color: #000000;"></span>   ##Jeddah
        </h2>
        <div id="date-container">
            <strong>day, 00, month</strong>
        </div>
        
        <?php include("trip_card.php");?>
        <?php include("trip_card.php");?>

        <div class="action-area flights">
            <a href="flight_departures.php">
                <button href=".html" class="btn-gray-outline">Back</button> 
            </a>
            <a href="../passengers_details/passengeres_details.php" >
                <button href=".html" class="btn-blue-outline" onclick="<?php $previous_page = 'flight_arrival'?>">Select</button>  
            </a>
        </div>

    </main>
    </body>
</html>