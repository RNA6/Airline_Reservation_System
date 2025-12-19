<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flight Departures</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <main class="common-container">
        
        <h2 class="head-title flights">
            ##Jeddah   <span class="fa-solid fa-arrow-right" style="color: #000000;"></span>   ##Madinah
        </h2>
        <div id="date-container">
            <strong>day, 00, month</strong>
        </div>
        
        <?php include("trip_card.php");?>
        <?php include("trip_card.php");?>

        <div class="action-area flights">
            <a href="../home/home.html" >
                <button href=".html" class="btn-gray-outline">Back</button> 
            </a>
            <?php $next_page = 'flight_arrival.php'?>
            <a href="<?php echo $next_page?>" >
                <button href=".html" class="btn-blue-outline">Select</button>    
            </a>
        </div>

    </main>
    </body>
</html>