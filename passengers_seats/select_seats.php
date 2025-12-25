<?php

    include("../flygo_system_sqldb/database.php");
    include("../flygo_system_sqldb/database_utilities.php");
    include("../flygo_system_sqldb/classes.php");
    session_start();
    if(!isset($_POST['continue']) && !isset($_SESSION['booking']['passengers'])){
        header("Location: ../passengers_details/passengeres_details.php");
        exit;
    }    

    $user = null;
    if (isset($_SESSION['passport'])){
        $user = get_user_details($connection, $_SESSION['passport']);
    }
    $counter = 0;
    $postIndex = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['booking']['passengers'] = [];
        for($adult=1; $adult <= $_SESSION['booking']['adults_number'] ; $adult++){
            if($adult === 1 && $user != null){
                $_SESSION['booking']['passengers'][$counter++] = $user;
            }
            else{
                $passenger = new Passenger($_POST['title'][$postIndex], $_POST['first-name'][$postIndex],
                $_POST['last-name'][$postIndex],$_POST['nationality'][$postIndex],
                $_POST['passport'][$postIndex],$_POST['birth-date'][$postIndex],
                "Adult");
                $_SESSION['booking']['passengers'][$counter++] = $passenger;
                $postIndex++;
            }
        }
        for($child=1; $child <= $_SESSION['booking']['children_number']; $child++){
            $passenger = new Passenger($_POST['title'][$postIndex], $_POST['first-name'][$postIndex],
            $_POST['last-name'][$postIndex],$_POST['nationality'][$postIndex],
            $_POST['passport'][$postIndex],$_POST['birth-date'][$postIndex],
            "Child");
            $_SESSION['booking']['passengers'][$counter++] = $passenger;
            $postIndex++;
        }
        for($infant=1; $infant <= $_SESSION['booking']['infants_number']; $infant++){
            $passenger = new Passenger($_POST['title'][$postIndex], $_POST['first-name'][$postIndex],
            $_POST['last-name'][$postIndex],$_POST['nationality'][$postIndex],
            $_POST['passport'][$postIndex],$_POST['birth-date'][$postIndex],
            "Infant");
            $_SESSION['booking']['passengers'][$counter++] = $passenger;
            $postIndex++;            
        }
        
        $_SESSION['booking']['total_passengers'] = $counter;
        
        header("Location: select_seats.php");
        exit;
    }    
    $title ="Seats";
    include('../header/head.php'); 
?>
</head>
    <body>        
    <?php include('../header/header.php');?> 
        <main class="common-container" style="padding-bottom: 20px; width: 400px;">
        
        <h1 class="head-title" style="text-align: center;">Select Seats</h1>
        
        <form name="seats-form" method="POST">
            <div class="plane">
                <div class ="seats-form">
                    <div class="small-hall-way">
                        <span class="exit"></span>
                    </div>                

                    <hr/>
                    <h6 class="common-text seats-lable" style="margin-left: 115px;">A</h6>
                    <h6 class="common-text seats-lable" style="margin-left: 150px;">B</h6>                
                    
                    <hr/>
                    <?php for($i = 1; $i<=4; $i++){
                        $row = $i;
                        $type = 'business';
                        include("seat-row.php");
                    } 
                    ?>
                    <hr/>

                    <h6 class="common-text seats-lable" style="margin-left: 85px;">A</h6>
                    <h6 class="common-text seats-lable" style="margin-left: 30px;">B</h6>                
                    <h6 class="common-text seats-lable" style="margin-left: 120px;">C</h6>
                    <h6 class="common-text seats-lable" style="margin-left: 30px;">D</h6>
                    
                    <hr/>  
                    <?php for($i = 5; $i<=6; $i++){
                        $row = $i;
                        $type = 'economy';
                        include("seat-row.php");
                    }?>               
                    <hr/>
                    
                    <div class="small-hall-way">
                        <span class="exit"></span>
                        <span class="wc">WC</span>
                    </div>                

                    <hr/>
                    <h6 class="common-text seats-lable" style="margin-left: 85px;">A</h6>
                    <h6 class="common-text seats-lable" style="margin-left: 30px;">B</h6>                
                    <h6 class="common-text seats-lable" style="margin-left: 120px;">C</h6>
                    <h6 class="common-text seats-lable" style="margin-left: 30px;">D</h6>
                    
                    <hr/>  
                    <?php for($i = 7; $i<=12; $i++){
                        $row = $i;
                        $type = 'economy';
                        include("seat-row.php");
                    }?>               
                    <hr/>
                    
                    <div class="small-hall-way">
                        <span class="exit"></span>
                    </div>                

                    <hr/>
                    <h6 class="common-text seats-lable" style="margin-left: 85px;">A</h6>
                    <h6 class="common-text seats-lable" style="margin-left: 30px;">B</h6>                
                    <h6 class="common-text seats-lable" style="margin-left: 120px;">C</h6>
                    <h6 class="common-text seats-lable" style="margin-left: 30px;">D</h6>
                    
                    <hr/>  
                    <?php for($i = 13; $i<=13; $i++){
                        $row = $i;
                        $type = 'economy';
                        include("seat-row.php");
                    }?>               
                    <hr/> 
                    
                    <script>
                        var form = document.forms[0]
                        var seats = form.elements["seats"];
                        var passenger_seats = document.getElementsByClassName("seats passenger");
                        var max = <?php echo $_SESSION['booking']['total_passengers']?>;
                        var passenger_seat_counter = 0;
                        Array.from(seats).forEach(element => {
                            element.addEventListener("click", function(){
                                if(element.checked){
                                    if(passenger_seat_counter === max){
                                        passenger_seat_counter = 0;
                                    }
                                    var previous_seat_text =passenger_seats[passenger_seat_counter].textContent;
                                    
                                    var previous_seat = document.getElementById("seat-" + previous_seat_text);
                                    
                                    previous_seat.disabled = false;
                                    previous_seat.checked = false;
                                    passenger_seats[passenger_seat_counter].textContent = element.value;
                                    selected_seat[passenger_seat_counter++].value = element.value;
                                    
                                    element.disabled = true;
                                    console.log(selected_seat[passenger_seat_counter-1].value);
                                    
                                }
                                
                            });
                        });
                    </script>
                </div>    
            </div>
            <div class="passenger-seat-wrapper">
                <?php
                    function getRandomSeat() {
                        $number = rand(1, 13);

                        if ($number >= 1 && $number <= 4) {
                            $letters = ['A', 'B'];
                        } elseif ($number >= 5 && $number <= 13) {
                            $letters = ['A', 'B', 'C', 'D'];
                        }

                        $letter = $letters[array_rand($letters)];

                        return $number . $letter; 
                    }
                    for($i = 0; $i< $_SESSION['booking']['total_passengers']; $i++){
                        $passenger = $_SESSION['booking']['passengers'][$i];
                        include("passenger-seat.php");
                    }
                ?>
                <?php
                    
                    
                ?>
            </div>
            <div class="action-area seats-actions"> 
                <a href="../passengers_details/passengeres_details.php">
                    <button type="button" class="btn-gray-outline">Back</button>
                </a>           
                <button type="button" class="btn-blue-outline">Add Extra</button>
                <script>
                    var buttons = document.getElementsByClassName('btn-blue-outline');
                    buttons[0].addEventListener("click", function(event){
                        event.preventDefault();
                        form.action = "../add_extras/add_extra.php";
                        form.submit();
                    });
                </script>
                
            </div>  
        </form>
        
        

    </main>
<?php include('../footer/footer.php'); ?>