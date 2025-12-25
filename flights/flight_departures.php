<?php 
    include("../flygo_system_sqldb/database.php");
    include("date_util.php");
    include("../flygo_system_sqldb/database_utilities.php");
    
    session_start();
    $flights = array();

    if(!isset($_POST['Search']) && !isset($_SESSION['booking']['departure_date'])){
        header("Location: ../home/home.php");
        exit;
    }

    $flights = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(isset($_POST['Search'])){
            // if($_POST['departingDate'] > new DateTime("2025-12-31") || $_POST['departingDate'] < new DateTime("2025-12-24")){
            //     header("Location: ../home/home.php");
            //     exit;
            // }
            $_SESSION['booking'] = [];
            $_SESSION['booking']['from'] = $_POST['from'];
            $_SESSION['booking']['to'] = $_POST['to'];
            $_SESSION['booking']['departure_date'] = $_POST['departingDate'];
            if($_POST['flight-type'] === 'Round Trip'){
                $_SESSION['booking']['arrival_date'] = $_POST['returningDate'];
            }
            $_SESSION['booking']['adults_number'] = $_POST['Adult-Passenger'];
            $_SESSION['booking']['children_number'] = $_POST['Children-Passenger'];
            $_SESSION['booking']['infants_number'] = $_POST['Infants-Passenger'];
        }
        header("Location: flight_departures.php");
        exit;
    }
    
    
    $flights = get_flights_by_cities($connection, $_SESSION['booking']['from'], $_SESSION['booking']['to'], $_SESSION['booking']['departure_date']);
    
    if(empty($flights)){
        header("Location: ../home/home.php");
        exit;
    }
    $title ="Flight Departures";
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
            
            <?php 
                $next_page = '../passengers_details/passengeres_details.php';
                if(isset($_SESSION['booking']['arrival_date'])){
                    $next_page = 'flight_arrival.php';
            }?>
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
<?php include('../footer/footer.php'); ?>