<?php 

session_start();

if (isset($_SESSION['welcome'])): ?>
    <p class="welcome-text">
        <?= htmlspecialchars($_SESSION['welcome']) ?>
    </p>
<?php unset($_SESSION['welcome']); endif; ?>

<?php

$title ="Home";
include('../header/header.php'); 

?>
<head>
    <link rel="stylesheet" href="../style.css" type="text/css">
<script>
    var vrd1 = document.getElementById("vrd1");


    function checkFlightType() {
        var rd = document.forms[0]["flight-type"];  
        var returningInput = document.querySelector('input[name="returningDate"]');
        var vrd1 = document.getElementById("vrd1");
        var vrd2 = document.getElementById("vrd2");

        for (var i = 0; i < rd.length; i++) {
            if (rd[i].checked) {

                if (rd[i].value === "One Way") {
                    returningInput.disabled = true;
                    returningInput.value = "";
                    
                    returningInput.style.border = "none";
                    vrd2.innerHTML = "";

                    vrd1.style.visibility = "hidden";
                
                } 
                else {
                        returningInput.disabled = false;
                        vrd1.style.visibility = "visible";
                }

            }
        }
    }

</script>
</head>
<body id="home-body">


    <div class="part1">
        <div class="back"></div>
        <h1 id="t1">Exceptional Flights… A Different Travel Experience</h1>

        <div class="boxes-container">
            <div class="book">
                <h1 id="tbook">Book</h1>
                <p>Discover the best flight options and secure your seat with quick, reliable booking.</p>
                <button class="home-part1-buttons" name="book now"><a href="#part2">Book Now</a></button>
            </div>

            <div class="view">
                <h1 id="tview">View</h1>
                <p>Access your booked ticket details and review all the information for your upcoming trip in one place.</p>
                <button class="home-part1-buttons" name="view now"><a href="#">View Now</a></button>
            </div>
        </div>
    </div>



<!-- BOOK A FLIGHT -->

    <div id="part2">
        
        <h1 id="home-part2-title">Book a Flight</h1>

        <form method="POST" action="">
        
        <div class="home-radio-label">   
            <label class="home-radio-label">
                <input type="radio" class="home-radio-btn" name="flight-type" value="Round Trip" checked onclick="checkFlightType()"/>Round Trip
            </label>

            <label class="home-radio-label">
                <input type="radio" class="home-radio-btn" name="flight-type" value="One Way" onclick="checkFlightType()"/>One Way
            </label>
            <br><br>
        </div> 

        <div class="flight-form">
            <label><legend>From<span class="ast">*  </span><span class="errorCom" id="vfrom"></span></legend>
                <select name="from" id="from">
                    <option value="" disabled selected>Select City</option>
                    <option value="sa">Saudi Arabia</option>
                    <option value="ua">United Arab Emirates</option>
                </select>
            </label>

            <label><legend>To<span class="ast">*  </span><span class="errorCom" id="vto"></span></legend>
                <select name="to" id="to">
                    <option value="" disabled selected>Select City</option>
                    <option value="sa">Saudi Arabia</option>
                    <option value="ua">United Arab Emirates</option>
                </select>
            </label>

            <label><legend>Departing Date<span class="ast">*  </span><span class="errorCom" id="vdd"></span></legend>
                <input type="date" name="departingDate"/>
            </label>

            <label><legend>Returning Date<span id="vrd1">* </span><span class="errorCom" id="vrd2"></span></legend>
                <input type="date" name="returningDate"/>
            </label>

            <label><legend>Adult Passenger<span class="ast">*  </span><span class="errorCom" id="vap"></span></legend>
                <input type="number" name="Adult-Passenger" min="1"/>
            </label>

            <label><legend>Children Passenger</legend>
                <input type="number" name="Children-Passenger" min="0"/>
            </label>

            <label><legend>Infants Passenger</legend>
                <input type="number" name="Infants-Passenger" min="0"/>
            </label>
        </div>
        <input type="submit" id="Search-button" name="Search" value="Search" onclick="return validateBook()" />

    

        </form>

        
    </div>


<script>
    function validateBook(){

    var valid = true;

    var from = document.getElementsByName("from")[0];
    var vfrom = document.getElementById("vfrom");

    var to = document.getElementsByName("to")[0];
    var vto = document.getElementById("vto");

    var depDate = document.getElementsByName("departingDate")[0];
    var vdd = document.getElementById("vdd");

    var retDate = document.getElementsByName("returningDate")[0];
    var vrd2 = document.getElementById("vrd2");

    var flightType = document.querySelector('input[name="flight-type"]:checked').value;


    var AdPass = document.getElementsByName("Adult-Passenger")[0];
    var vap = document.getElementById("vap");


    vfrom.innerHTML = "";
    vto.innerHTML = "";
    vdd.innerHTML = "";
    vrd2.innerHTML = "";
    vap.innerHTML = "";


    from.style.border ="none";
    to.style.border ="none";
    depDate.style.border ="none";
    retDate.style.border = "none";
    AdPass.style.border ="none";

    //From
    if(from.value === ""){
        from.style.border = "2px solid red";
        vfrom.innerHTML = "  (Required)";
        valid = false;
    }

    //TO
    if(to.value === ""){
        to.style.border = "2px solid red";
        vto.innerHTML = "  (Required)";
        valid = false;
    }

    // Departing Date validation
var today = new Date();
today.setHours(0, 0, 0, 0);

var depDateValue = new Date(depDate.value);

if (depDate.value === "") {
    depDate.style.border = "2px solid red";
    vdd.innerHTML = "  (Required)";
    valid = false;
}
else if (depDateValue < today) {
    depDate.style.border = "2px solid red";
    vdd.innerHTML = "  (Departing date cannot be in the past)";
    valid = false;
}

// Returning Date validation (ONLY for Round Trip)
if (flightType === "Round Trip") {

    var retDateValue = new Date(retDate.value);

    if (retDate.value === "") {
        retDate.style.border = "2px solid red";
        vrd2.innerHTML = " (Required)";
        valid = false;
    }
    else if (retDateValue < depDateValue) {
        retDate.style.border = "2px solid red";
        vrd2.innerHTML = " (Cannot be before departing date)";
        valid = false;
    }
}

var childPass = document.getElementsByName("Children-Passenger")[0];
var infantPass = document.getElementsByName("Infants-Passenger")[0]; 

var adultCount = parseInt(AdPass.value) || 0;
var childCount = parseInt(childPass.value) || 0;
var infantCount = parseInt(infantPass.value) || 0;

//Adult Passenger
if(AdPass.value === "" || AdPass.value === null ){
    AdPass.style.border = "2px solid red";
    vap.innerHTML = " (Required)";
    valid = false;
}
else if (adultCount === 0 && (childCount > 0 || infantCount > 0)) {
    AdPass.style.border = "2px solid red";
    vap.innerHTML = " (Children can't travel without an adult)";
    valid = false;
}



return valid;
}

</script>
</body>

<?php include('../footer/footer.php'); ?>
