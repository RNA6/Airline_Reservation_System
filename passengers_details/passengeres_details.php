<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Passengeres Details</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <main class="common-container">
        
        <h2 class="head-title">Passengeres Details</h2>

        <?php include("passenger.php");?>
        <?php include("passenger.php");?>

        <span class="common-text" style="font-size: 1.5rem;">Contact Details</span>
        <div class="details-container contact-details">
            <form name="passenger-details-form">                
                <fieldset class="inputs-fieldset">
                    <legend class="common-text">Phone Number</legend>
                    <input class="inputs" type="text" placeholder="Enter ourPhone Number"/>
                    <span class="fa-solid fa-phone"></span>
                </fieldset>
                
                <fieldset class="inputs-fieldset email">
                    <legend class="common-text">Email</legend>
                    <input class="inputs" type="email" placeholder="Enter Email Address"/>
                    <span class="fa-regular fa-envelope"></span>
                </fieldset>
            </form>
        </div>

        <div class="action-area passengers">
            <a href="../tickets/flight_departures.php"  style="margin-right: 20px">
                <button class="btn-gray-outline">Edit Search</button>
            </a>
            <a href="../passengers_seats/select_seats.php" >
            <button class="btn-blue-outline" onclick="<?php $previous_page = 'passengers-details.php'?>">Continue</button>
            </a>
        </div>

    </main>
    </body>
</html>