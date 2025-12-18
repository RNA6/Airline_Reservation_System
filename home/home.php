<!Doctype HTML>
<html lang="en">
<head>
<style>

body{background-color: #EBF5FF; margin: 0; padding: 0; height: 1680px; text-align: center; font-family: serif;}
.part1{position: relative; width: 100%; height: 700px; overflow: hidden; text-align: center;}
.back{position: absolute; background-image:url("plain image.jpg"); width:100%; height:100%; margin: 0; padding: 0; filter: blur(2px); background-size: cover;  background-position: center; z-index: -1;}
#t1{ color:white; font-size: 44px; font-weight: bold; margin-top: 150px; text-shadow: 0px 1px 4px rgba(0, 0, 0, 0.75);}
.book{width: 437px; height: 347px; background-color:white; border-radius: 80px; text-align: center; margin: 45px 150px 0 122px; overflow: hidden; float: left; padding: 0; box-shadow: 0px 3px 4px rgba(-2, 4, 4, 0.25);}
.view{width: 437px; height: 347px; background-color:white; border-radius: 80px; text-align: center; margin: 45px 0 122px 0; overflow: hidden; float: left; padding: 0; box-shadow: 0px 3px 4px rgba(-2, 4, 4, 0.25);}
#tbook, #tview {color: black; font-size: 36px; margin-top: 35px; font-weight: 500;}
.button{background-color: #1C75BC; width: 142px; height: 40px; color:white; font-size: 24px; font-weight: 500; padding-bottom: 4px; border-radius: 80px; border: none; margin-bottom: 60px;}
.part1 p{color: #696969; font-size: 22px; margin: 20px 40px 50px; text-align:justify; display: inline-block;}

.part2{ width: 1100px; height: 710px; overflow: visible; text-align: center; background-color:white; border-radius: 80px; box-shadow: 5px -5px 4px rgba(220, 235, 251, 0.50), -5px 5px 4px rgba(220, 235, 251, 1); padding: 0; margin: 100px auto; display:inline-block; padding-bottom: 60px;}
#p2t{color: black; font-size: 44px; margin: 50px 0; font-weight:600;}

.radio-label {margin: 0 40px; display: inline-flex; align-items: center; font-size: 26px; color: black; font-weight:400;}
.radio-btn{transform: scale(1.5); margin-right: 10px;}

.flight-form input, .flight-form select{width:400px; height:53px; border-radius: 10px; border: none; background-color:#EEEEEE; font-size:20px; font-weight:lighter; margin-bottom: 25px; text-align: center;}
.flight-form label{ font-size:20px; text-align:left; display: inline-block; margin:10px 30px;}

.flight-form #from{background-image: url('from.png'); background-position: 350px center; background-size: 24px 24px; background-repeat: no-repeat;}
.flight-form #to{background-image: url('to.png'); background-position: 350px center; background-size: 24px 24px; background-repeat: no-repeat;}


#Search-button{margin-left: 850px; margin-top: -60px;}

span{color:red;}

.error{color: red; font-size: 16px; padding: auto; margin: 0; font-style: italic;}



</style>
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

<body>

<section id="s1">
    <div class="part1">
        <div class="back"></div>
        <h1 id="t1">Exceptional Flights… A Different Travel Experience</h1>

        <div class="book">
            <h1 id="tbook">Book</h1>
            <p>Discover the best flight options and secure your seat with quick, reliable booking.<br></p>
            <a href="#part2"><button class="button"name="book now">Book Now</button></a>
        </div>

        <div class="view">
            <h1 id="tview">View</h1>
            <p>Access your booked ticket details and review all the information for your upcoming trip in one place.</p>
            <a href="#"><button class="button" name="view now">View Now</button></a>
        </div>
    </div>
</section>

<!-- BOOK A FLIGHT -->
<section id="s2">
    <div class="part2">
        
        <h1 id="p2t">Book a Flight</h1>

        <form method="POST" action="">
        
        <div class="radio-label">   
            <label class="radio-label">
                <input type="radio" class="radio-btn" name="flight-type" value="Round Trip" checked onclick="checkFlightType()"/>Round Trip
            </label>

            <label class="radio-label">
                <input type="radio" class="radio-btn" name="flight-type" value="One Way" onclick="checkFlightType()"/>One Way
            </label>
            <br><br>
        </div> 

        <div class="flight-form">
            <label><legend>From<span>*  </span><span class="error" id="vfrom"></span></legend>
                <select name="from" id="from">
                    <option value="" disabled selected>Select City</option>
                    <option value="sa">Saudi Arabia</option>
                    <option value="ua">United Arab Emirates</option>
                </select>
            </label>

            <label><legend>To<span>*  </span><span class="error" id="vto"></span></legend>
                <select name="to" id="to">
                    <option value="" disabled selected>Select City</option>
                    <option value="sa">Saudi Arabia</option>
                    <option value="ua">United Arab Emirates</option>
                </select>
            </label>

            <label><legend>Departing Date<span>*  </span><span class="error" id="vdd"></span></legend>
                <input type="date" name="departingDate"/>
            </label>

            <label><legend>Returning Date<span id="vrd1">* </span><span class="error" id="vrd2"></span></legend>
                <input type="date" name="returningDate"/>
            </label>

            <label><legend>Adult Passenger<span>*  </span><span class="error" id="vap"></span></legend>
                <input type="number" name="Adult-Passenger" min="0"/>
            </label>

            <label><legend>Children Passenger</legend>
                <input type="number" name="Children-Passenger" min="0"/>
            </label>

            <label><legend>Infants Passenger</legend>
                <input type="number" name="Infants-Passenger" min="0"/>
            </label>
        </div>
        <input type="submit" class="button" id="Search-button" name="Search" value="Search" onclick="return validateBook()" />

        

        </form>

        
    </div>
</section>

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
var infantPass = document.getElementsByName("Infants-Passenger")[0]; // انتبهي للاسم

var adultCount = parseInt(AdPass.value) || 0;
var childCount = parseInt(childPass.value) || 0;
var infantCount = parseInt(infantPass.value) || 0;


if (adultCount === 0 && (childCount > 0 || infantCount > 0)) {
    AdPass.style.border = "2px solid red";
    vap.innerHTML = " (Children can't travel without an adult)";
    valid = false;
}



return valid;
}

</script>

</body>

</html>
