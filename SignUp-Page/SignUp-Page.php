<?php 
session_start();
$title ="Sign Up";
include('../header/header.php'); ?>

<body id="SignUp-body">
    <span class="dberror"><?= $_SESSION['SignUp_error'] ?? '' ?></span>
    <div class="signUp-background">
        <h1 id="signUp-title">Sign Up</h1>
        <br>
        <form class="signUp-form" method="POST" action="SignUp-Proccess.php" onsubmit="return validateSignIn()">
        
            <label class="signUp-label"><legend>First Name<span class="ast">*  </span><span class="errorCom" id="vfname"></span></legend>
                <input class="signUp-input" type="text" name="first-name"/>
            </label>
        
            <label class="signUp-label"><legend>Last Name<span class="ast">*  </span><span class="errorCom" id="vlname"></span></legend>
                <input class="signUp-input" type="text" name="last-name" />
            </label>
        
            <label class="signUp-label"><legend>Nationality<span class="ast">*  </span><span class="errorCom" id="vnation"></span></legend>
                <select class="signUp-select" name="nationality">
                    <option value="" disabled selected>Select Nationality</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Brazilian">Brazilian</option>
                </select>
            </label>
        
            <label class="signUp-label"><legend>Passport Number<span class="ast">*  </span><span class="errorCom" id="vpassportnum"></span></legend>
                <input class="signUp-input" type="text" name="passport-number" placeholder="e.g. P12345678"/>
            </label>
        
            <label class="signUp-label"><legend>Phone Number<span class="ast">* </span><span class="errorCom" id="phonenum"></span></legend>
                <input class="signUp-input" type="text" name="phone-number" placeholder="+966 5XXXXXXXX"/>
            </label>
        
            <label class="signUp-label"><legend>Email<span class="ast">* </span><span class="errorCom" id="vem"></span></legend>
                <input class="signUp-input" id="email" type="email" name="email"/>
            </label>
        
            <label class="signUp-label"><legend>Birth Date<span class="ast">*  </span><span class="errorCom" id="vbirthDate"></span></legend>
                <input class="signUp-input" type="date" name="birth-date"/>
            </label>
        
            <label class="signUp-label"><legend>Title  <span class="errorCom" id="vtitle"></span></legend>
                <select class="signUp-select" name="title">
                    <option value="" disabled selected>Select Title</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms</option>
                </select>
            </label>
        
        
            <label class="signUp-label"><legend>Password<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
                <input class="signUp-input" id="pass" type="password" name="password"/>
            </label>
        
            <label class="signUp-label"><legend>Confirm Password<span class="ast">*  </span><span class="errorCom" id="vconpass"></span></legend>
                <input class="signUp-input" id="conpass" type="password" name="confirm-password"/>
            </label>

            <a href="../home/home.php"><button type="button" id="signUp-back-button" name="back-button">Back</button></a>
            <input type="submit" id="SignUp-button" value="Sign Up" /> 
            
        </form>
        <?php
            unset($_SESSION['SignUp_error']);
        ?>


    </div>


    <script>
        function validateSignIn(){

            var valid = true;

            var fname = document.getElementsByName("first-name")[0];
            var vfname = document.getElementById("vfname");

            var lname = document.getElementsByName("last-name")[0];
            var vlname = document.getElementById("vlname");

            var nation = document.getElementsByName("nationality")[0];
            var vnation = document.getElementById("vnation");
           
            var passportnum = document.getElementsByName("passport-number")[0];
            var vpassportnum = document.getElementById("vpassportnum");

            var phonenum = document.getElementsByName("phone-number")[0];
            var vphonenum = document.getElementById("phonenum");

            var birth = document.getElementsByName("birth-date")[0];
            var vbirth = document.getElementById("vbirthDate");

            var em = document.getElementById("email")
            var vem = document.getElementById("vem");

            var pass = document.getElementById("pass");
            var vpass = document.getElementById("vpass");
            
            var conpass = document.getElementById("conpass");
            var vconpass = document.getElementById("vconpass");


            vfname.innerHTML="";
            vlname.innerHTML="";
            vem.innerHTML = "";
            vpass.innerHTML = "";
            vnation.innerHTML = "";
            vpassportnum.innerHTML = "";
            vphonenum.innerHTML = "";
            vbirth.innerHTML = "";
            vconpass.innerHTML = "";

            fname.style.border ="none";
            lname.style.border ="none";
            em.style.border = "none"; 
            pass.style.border = "none"; 
            nation.style.border = "none";
            pass.style.border = "none";
            phonenum.style.border = "none";
            birth.style.border = "none";
            conpass.style.border = "none"


        //First Name validation
            if(fname.value.trim() === ""){
                fname.style.border = "2px solid red";
                vfname.innerHTML = "(Required)";
                valid = false;  
            }
            else{
                nameRegex = /^[A-Za-zأ-يءئؤإآة\s]+$/;
                if(!nameRegex.test(fname.value.trim())){
                    fname.style.border = "2px solid red";
                    vfname.innerText = "(Please enter valid name)";
                    valid = false;
                }
            }


        //Last Name validation
            if(lname.value.trim() === ""){
                lname.style.border = "2px solid red";
                vlname.innerHTML = "(Required)"
                valid = false;  
            }
            else{
                nameRegex = /^[A-Za-zأ-يءئؤإآة\s]+$/;
                if(!nameRegex.test(lname.value.trim())){
                    lname.style.border = "2px solid red";
                    vlname.innerText = "(Please enter a valid name)";
                    valid = false;
                }
            }


        //NATIONALITY VALIDATION
            if(nation.value === ""){
                nation.style.border = "2px solid red";
                vnation.innerHTML = "(Required)";
            }

        //PASSPORT NUMBER VALIDATION
        if(passportnum.value.trim() === ""){
            passportnum.style.border = "2px solid red";
            vpassportnum.innerHTML = "(Required)";
            valid = false;
        }
        else{
            passRegex = /^[A-Za-z][0-9]{8}$/;
            if(!passRegex.test(passportnum.value.trim())) {
                passportnum.style.border = "2px solid red";
                vpassportnum.innerHTML = "(Invalid Passport format)";
                valid = false;
            }
        }

        //PHONE VALIDATION
         if (phonenum.value.trim() === "") {
            phonenum.style.border = "2px solid red";
            vphonenum.innerHTML = "(Required)";
            valid = false;
        } 
        else {
            saPhoneRegex = /^5[0-9]{8}$/;

            if (!saPhoneRegex.test(phonenum.value.trim())) {
                phonenum.style.border = "2px solid red";
                vphonenum.innerHTML = "(Enter a valid Saudi number)";
                valid = false;
            }
        }


        //Birth date
        var today = new Date(); 
        var minAge = new Date();
        minAge.setFullYear(today.getFullYear() - 18); // must be 18+

        var birthDate = new Date(birth.value);

    
        if (birth.value === "") {
            birth.style.border = "2px solid red";
            vbirth.innerHTML = "(Required)";
            valid = false;
        }
        else if (birthDate > today) {
            birth.style.border = "2px solid red";
            vbirth.innerHTML = "(Birth date cannot be in the future)";
            valid = false;
        }
        else if (birthDate > minAge) {
            birth.style.border = "2px solid red";
            vbirth.innerHTML = "(You must be at least 18 years old)";
            valid = false;
        }


        //Email validation
            if(em.value.trim() === ""){
                em.style.border = "2px solid red";
                vem.innerText = "(Required)";
                valid = false;
            }
            else{
                regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!regex.test(em.value.trim())) {
                    vem.innerText = "(Please Enter valid email)";
                    em.style.border = "2px solid red";
                    valid = false; 
                }
            }
            

        //Password
            if(pass.value.trim() === ""){
                pass.style.border = "2px solid red";
                vpass.innerText = "(Required)";
                valid = false;
            }
            else if(pass.value.length !== 8){
                vpass.innerText = "(Password must be 8 characters)";
                pass.style.border = "2px solid red";
                valid = false

            }

        //Confirm Password
        if (conpass.value.trim() === "") {
            conpass.style.border = "2px solid red";
            vconpass.innerHTML = "(Required)";
            valid = false;
        } else if (conpass.value !== pass.value) {
            conpass.style.border = "2px solid red";
            vconpass.innerHTML = "(Passwords do not match)";
            valid = false;
        }

        return valid;
                
    }
    
    </script>
    
</body>

<?php include('../footer/footer.php'); ?>