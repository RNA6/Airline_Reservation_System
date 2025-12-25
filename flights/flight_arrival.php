<?php 
    include("../flygo_system_sqldb/database.php");
    include("date_util.php");
    include("../flygo_system_sqldb/database_utilities.php");
    
    session_start();
    $flights = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $departure_number = $_POST['ticket'];
        $_SESSION['booking']['departure_flight_number'] = $departure_number;
        header("Location: flight_arrival.php");
        exit;
    }
    $flights = get_flights_by_cities($connection, $_SESSION['booking']['to'], $_SESSION['booking']['from'], $_SESSION['booking']['arrival_date']);
    
    if(empty($flights)){
        header("Location: ../home/home.php");
        exit;
    }

    $title ="Flight Arrival";
    include('../header/head.php'); 
?>
</head>
    <body>        
    <?php include('../header/header.php');?> 
        <main class="common-container">
        
        <h2 class="head-title flights">
                <?php echo $flights[0]['origin_city_name'];?>   <span class="fa-solid fa-arrow-right" style="color: #000000;"></span>   <?php echo $flights[0]['destination_city_name'];?>
            </h2>
            <div id="date-container">
                <strong><?php echo get_flight_date($flights[0]['departure_time']);?></strong>
            </div>
            <form id="arrival_tickets_form" name="arrival_tickets_form" class="tickets" method="POST" action="../passengers_details/passengeres_details.php">
                <span id="flightError" class="common-text error-text">
                    Please select a flight to continue.
                </span>
                <?php foreach($flights as $key => $value){
                    include("trip_card.php");
                }?>

                <div class="action-area flights">
                    <a href="flight_departures.php" class="btn-gray-outline">Back</a>

                    <button id="submit" type="select_arrival" name="select" class="btn-blue-outline">Select</button>  
                </div>
                <script>
                    var form = document.getElementById("arrival_tickets_form");
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
<?php include('../footer/footer.php'); ?>