<?php 
    include("../flygo_system_sqldb/database.php");
    include("date_util.php");
    include("../flygo_system_sqldb/flights_database.php");
    // if(isset($_POST['from'])){
        $_POST['from'] = "DMM";
        $_POST['to'] = "MED";
    // }

    session_start();
    $_SESSION['booking'] = [];
    $_SESSION['booking']['adults_number'] = 1;
    $_SESSION['booking']['children_number'] =1 ;
    $_SESSION['booking']['infants_number'] =1;
    
    $flights = get_flights_by_cities($connection, $_POST['from'], $_POST['to']);
?>
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
                <?php echo $flights[0]['origin_city_name'];?>   <span class="fa-solid fa-arrow-right" style="color: #000000;"></span>   <?php echo $flights[0]['destination_city_name'];?>
            </h2>
            <div id="date-container">
                <strong><?php echo get_flight_date($flights[0]['departure_time']);?></strong>
            </div>
            
            <?php $next_page = 'flight_arrival.php'?>
            <form id="departure_tickets_form" name="departure_tickets_form" class="tickets" method="POST" action="<?php echo $next_page;?>">
                <span id="flightError" class="common-text error-text">
                    Please select a flight to continue.
                </span>

                <?php foreach($flights as $key => $value){
                    include("trip_card.php");
                }?>

                <div class="action-area flights">
                    <a href="../home/home.php" class="btn-gray-outline">Back</a>

                    <button id="submit" type="submit" name="select" class="btn-blue-outline">Select</button>    
                </div>
                 <script>
                    var form = document.getElementById("departure_tickets_form");
                    var error = document.getElementById("flightError");
                    var submitBtn = document.getElementById("submit");
                    var inputs = form.elements["ticket"];
                    
                    
                    submitBtn.addEventListener("click", function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            error.style.display = "block";

                            var page_header = document.getElementsByTagName("body");
                            window.scrollTo({
                                top: page_header,
                                behavior: 'smooth'
                            });
                        }
                    });

                    inputs.forEach(element => {
                        element.addEventListener("click", function(){
                            error.style.display = "none";
                        })
                    });
                    
                </script>
            </form>
            
            
            
        </main>
    </body>
</html>