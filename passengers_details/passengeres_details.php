<?php 
    session_start();
    if(!isset($_POST['ticket']) && !isset($_SESSION['booking']['departure_flight_number'])){
        header("Location: ../home/home.php");
        exit;
    }

    include("../flygo_system_sqldb/database.php");
    include("../flygo_system_sqldb/database_utilities.php");
    include("../flygo_system_sqldb/classes.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['select_arrival'])){
            $arrival_number = $_POST['ticket'];        
            $_SESSION['booking']['arrival_flight_number'] = $arrival_number;
        }
        elseif(isset($_POST['select'])){
            $departure_number = $_POST['ticket'];
            $_SESSION['booking']['departure_flight_number'] = $departure_number;
        }
        header("Location: passengeres_details.php");
        exit;
    }
    
    $user = null;
    $user_contact_setails = [];
    if (isset($_SESSION['passport'])){
        $user = get_user_details($connection, $_SESSION['passport']);
        $user_contact_setails = get_user_contact_details($connection, $_SESSION['passport']);
    }
    //if signed in put information directly
    $title ="Passengeres Details";
    include('../header/head.php'); 
?>
</head>
    <body>        
    <?php include('../header/header.php');?> 
    <body>
        <main class="common-container">
        
            <h2 class="head-title">Passengeres Details</h2>
            <form id="passenger-details-form" name="passenger-details-form" method="POST" action="../passengers_seats/select_seats.php">
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
                    <?php if(!empty($user_contact_setails)){?>
                        <fieldset class="inputs-fieldset">
                            <legend class="common-text">Phone Number</legend>
                            <input class="inputs" type="text" value="<?php echo $user_contact_setails[1] ?>" disabled/>
                            <span class="fa-solid fa-phone"></span>
                        </fieldset>
                        
                        <fieldset class="inputs-fieldset email">
                            <legend class="common-text">Email</legend>
                            <input class="inputs" type="email" value="<?php echo $user_contact_setails[0] ?>" disabled/>
                            <span class="fa-regular fa-envelope"></span>
                        </fieldset>
                    <?php }else{?>
                        <fieldset class="inputs-fieldset">
                            <legend class="common-text">Phone Number</legend>
                            <input class="inputs" type="text" placeholder="Enter ourPhone Number" required/>
                            <span class="fa-solid fa-phone"></span>
                        </fieldset>
                        
                        <fieldset class="inputs-fieldset email">
                            <legend class="common-text">Email</legend>
                            <input class="inputs" type="email" placeholder="Enter Email Address" required/>
                            <span class="fa-regular fa-envelope"></span>
                        </fieldset>                        
                    <?php }?>
                </div>

                <div class="action-area passengers">
                    <a href="../flights/flight_departures.php"  style="margin-right: 20px" class="btn-gray-outline">Edit Search</a>
                    
                    <button id="continue" name="continue" type="sumbit" class="btn-blue-outline">Continue</button>
                </div>
                <script>
                    var form = document.getElementById("passenger-details-form");
                    var submitBtn = document.getElementById("continue");                    
                    
                    submitBtn.addEventListener("click", function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            form.reportValidity();
                            
                            var page_header = document.getElementsByTagName("body");
                            window.scrollTo({
                                top: page_header,
                                behavior: 'smooth'
                            });
                        }
                    });
                    
                </script>
            </form>
        </main>
<?php include('../footer/footer.php'); ?>