<?php 
    session_start();
    if(isset($_POST['ticket'])){
        $arrival_number = $_POST['ticket'];        
        $_SESSION['booking']['arrival_flight_number'] = $arrival_number;
    }

    
    if (isset($_SESSION['welcome'])){
        //Get user info
    }
    //if signed in put information directly
?>
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
            <form name="passenger-details-form" method="POST" action="../passengers_seats/select_seats.php">
                <?php 
                    for($adult=1; $adult <= $_SESSION['booking']['adults_number'] ; $adult++){
                        include("passenger.php");
                    }
                    for($child=1; $child <= $_SESSION['booking']['children_number']; $child++){
                        include("passenger.php");
                    }
                    for($infant=1; $infant <= $_SESSION['booking']['infants_number']; $infant++){
                        include("passenger.php");
                    }
                ?>
                <span class="common-text" style="font-size: 1.5rem;">Contact Details</span>
                <div class="details-container contact-details">
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
                </div>

                <div class="action-area passengers">
                    <a href="../flights/flight_departures.php"  style="margin-right: 20px" class="btn-gray-outline">Edit Search</a>
                    
                    <button type="sumbit" class="btn-blue-outline">Continue</button>
                </div>
            </form>
        </main>
    </body>
</html>