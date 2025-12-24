<?php

$title ="Profile";

session_start();
require_once "../flygo_system_sqldb/database.php"; 

if (!isset($_SESSION['passport'])) {
    header("Location: ../Profile/Profile.php");
    exit;
}

$passport = $_SESSION['passport'];


$sql = "
SELECT 
    p.title,
    p.first_name,
    p.last_name,
    p.nationality,
    p.passport,
    p.`birth_date`,
    u.email,
    u.phone_number
FROM passenger p
JOIN user u ON p.passport = u.passport
WHERE p.passport = ?
";

$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $passport);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();
$stmt->close();


include('../header/head.php');
?>


<body id="update-body">
    <?php include('../header/header.php'); ?>
    <span class="dberror"><?= $_SESSION['Update_error'] ?? '' ?></span>
    <div class="update-background">
        <h1 id="update-title">Update Profile</h1>
        <br>
        <form class="update-form" method="POST" action="update-proccess.php" onsubmit="return validateUpdate()">
        
            <label class="update-label"><legend>First Name<span class="ast">*  </span><span class="errorCom" id="vfname"></span></legend>
                <input class="update-input" type="text" name="first-name" value="<?= htmlspecialchars($user['first_name']) ?>"/>
            </label>
        
            <label class="update-label"><legend>Last Name<span class="ast">*  </span><span class="errorCom" id="vlname"></span></legend>
                <input class="update-input" type="text" name="last-name" value="<?= htmlspecialchars($user['last_name']) ?>"/>
            </label>
        
            <label class="update-label"><legend>Nationality<span class="ast">*  </span><span class="errorCom" id="vnation"></span></legend>
                <select class="update-select" name="nationality">
                    <option value="Saudi Arabian"<?= ($user['nationality'] === 'Saudi Arabian') ? 'selected' : '' ?>>Saudi Arabian</option>
                    <option value="United Arab Emirates"<?= ($user['nationality'] === 'United Arab Emirates') ? 'selected' : '' ?>>United Arab Emirates</option>
                    <option value="Bahraini"<?= ($user['nationality'] === 'Bahraini') ? 'selected' : '' ?>>Bahraini</option>
                    <option value="Kuwaiti"<?= ($user['nationality'] === 'Kuwaiti') ? 'selected' : '' ?>>Kuwaiti</option>
                </select>
            </label>
        
            <label class="update-label"><legend>Passport Number<span class="ast">*  </span><span class="errorCom" id="vpassportnum"></span></legend>
                <input class="update-input" type="text" name="passport-number" value="<?= htmlspecialchars($user['passport']) ?>" placeholder="e.g. P12345678" />
            </label>
        
            <label class="update-label"><legend>Phone Number<span class="ast">*  </span><span class="errorCom" id="phonenum"></span></legend>
                <input class="update-input" type="text" name="phone-number" value="<?= htmlspecialchars($user['phone_number']) ?>" placeholder="+966 5XXXXXXXX"/>
            </label>
        
            <label class="update-label"><legend>Email<span class="ast">*  </span><span class="errorCom" id="vem"></span></legend>
                <input class="update-input" type="email"  name="email" value="<?= htmlspecialchars($user['email']) ?>"/>
            </label>
        
            <label class="update-label"><legend>Birth Date<span class="ast">*  </span><span class="errorCom" id="vbirthDate"></span></legend>
                <input class="update-input" type="date"  name="birth-date" value="<?= htmlspecialchars($user['birth_date']) ?>"/>
            </label>
        
            <label class="update-label"><legend>Title</legend>
                <select class="update-input" name="title" value="<?= htmlspecialchars($user['title']) ?>">
                    <option value="Mr"<?= ($user['title'] === 'Mr') ? 'selected' : '' ?>>Mr</option>
                    <option value="Mrs"<?= ($user['title'] === 'Mrs') ? 'selected' : '' ?>>Mrs</option>
                    <option value="Ms"<?= ($user['title'] === 'Ms') ? 'selected' : '' ?>>Ms</option>
                </select>
            </label>
        
            <label class="update-label"><legend>Password<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
                <input class="update-input" id="pass" type="password" name="password" placeholder="********"/>
            </label>
        
            <label class="update-label"><legend>Confirm Password<span class="errorCom" id="vconpass"></span></legend>
                <input class="update-input" id="conpass" type="password" name="confirm-password"/>
            </label>
        
            <br>
            <a href="../Profile/Profile.php"><button type="button" id="update-back-button" name="back-button">Back</button></a>
            <input type="submit" id="update-button" value="Confirm"/> 
            
        </form>


    </div>
        <script>
        function validateUpdate(){

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

            var em = document.getElementsByName("email")[0]
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
                    vfname.innerText = "(Please enter a valid name)";
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
                valid = false;
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
        if(pass.value.trim() !== ""){
                 if(pass.value.length < 8){
                vpass.innerText = "(Password must be 8 characters)";
                pass.style.border = "2px solid red";
                valid = false;
                }
        }


        //Confirm Password
        if(pass.value.trim() !== ""){
            if(conpass.value !== pass.value){
            conpass.style.border = "2px solid red";
            vconpass.innerHTML = "(Passwords do not match)";
            valid = false;
            }
        }


        return valid;
                
    }
    
    </script>

<?php include('../footer/footer.php'); ?>