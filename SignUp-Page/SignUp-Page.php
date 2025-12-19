<?php

$title ="Sign Up";

session_start();
include('../header/header.php'); 
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$password = ""; // ضع كلمة المرور إذا كانت موجودة
$dbname = "flygo_system";
$port = 3306;

$conn = new mysqli($host, $user, $password, $dbname, $port);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق إذا تم الضغط على زر Sign Up
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // استلام البيانات من الفورم
    $first_name = trim($_POST['first-name']);
    $last_name = trim($_POST['last-name']);
    $nationality = $_POST['nationality'];
    $passport = trim($_POST['passport-number']);
    $phone = trim($_POST['phone-number']);
    $email = trim($_POST['email']);
    $birth_date = $_POST['birth-date'];

    // الحقول الاختيارية مثل title
    $title = isset($_POST['title']) ? $_POST['title'] : null;

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // تشفير كلمة المرور
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // التحقق من عدم تكرار الباسبورت في جدول passenger
    $stmt = $conn->prepare("SELECT passport FROM passenger WHERE passport = ?");
    $stmt->bind_param("s", $passport);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Passport number already exists."); ///////////////////////////////////////////////////////////////////////////////
    }
    $stmt->close();

    // التحقق من عدم تكرار الإيميل في جدول user
    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Email already exists."); /////////////////////////////////////////////////////////////////////////////////////////
    }
    $stmt->close();

    // حساب age_group تلقائي (Child, Adult, Senior)
    $today = new DateTime();
    $birth = new DateTime($birth_date);
    $age = $today->diff($birth)->y;

    if ($age < 12) {
        $age_group = "Child";
    } elseif ($age < 60) {
        $age_group = "Adult";
    } else {
        $age_group = "Senior";
    }

    // إدخال البيانات في جدول passenger
    $stmt = $conn->prepare("INSERT INTO passenger (title, first_name, last_name, nationality, passport, birth_date, age_group) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $title, $first_name, $last_name, $nationality, $passport, $birth_date, $age_group);

    if (!$stmt->execute()) {
        die("Error inserting into passenger: " . $stmt->error); ///////////////////////////////////////////////////////////////
    }
    $stmt->close();

    // إدخال البيانات في جدول user
    $stmt = $conn->prepare("INSERT INTO user (passport, email, password, phone_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $passport, $email, $hashedPassword, $phone);

    if ($stmt->execute()) {
        echo "Sign Up successful!"; ////////////////////////////////////////////////////////////////////////////////////////
        // هنا يمكن إعادة التوجيه لصفحة تسجيل الدخول
        // header("Location: signIn.php");
        // exit;
    } else {
        die("Error inserting into user: " . $stmt->error); /////////////////////////////////////////////////////////////////
    }

    $stmt->close();
    $conn->close();
}
?>


<html lang="en">
<head>
    <title>Sign Up</title>

    <style>
        body{background-color: #EBF5FF; margin: 0; padding: 0; height: 550px; text-align: center; font-family: serif;}
        .signUp-background{ width: 1100px; height: 890px; overflow: visible; text-align: center; background-color:white; border-radius: 80px; box-shadow: 5px -5px 4px rgba(220, 235, 251, 0.50), -5px 5px 4px rgba(220, 235, 251, 1); padding: 0; margin: 60px auto; display:inline-block; padding-bottom: 60px;}
        #p2t{color: black; font-size: 44px; margin: 50px 0; font-weight:600;}

        .signUp-form input, .signUp-form select{width:400px; height:53px; border-radius: 10px; border: none; background-color:#EEEEEE; font-size:20px; font-weight:lighter; margin-bottom: 25px; text-align:left;}

        .signUp-form select{padding-left: 15px; width:415px;}

        input{padding-left: 15px;}

        .signUp-form label{ font-size:20px; text-align:left; display: inline-block; margin:10px 30px;}

        h3{color:#696969; font-size:18px; font-weight:normal; padding:0;}
        #SignIn{color:#696969; font-size:18px; font-weight:normal;}

        button, #SignIn-button{background-color: #1C75BC; width: 415px; height: 53px; color:white; font-size: 24px; font-weight: 500; padding-bottom: 5px; border-radius: 80px; border: none; margin-bottom:0; margin: 30px; font-family:serif;}
        #back-button{background-color: #9F9F9F;}

        span{color:red; font-family: serif;}

        #SignIn-button{text-align: center;}

        .error{color: red; font-size: 16px; padding: auto; margin: 0; font-style: italic; font-family: sans-serif;}


    </style>

</head>
<body>

    <div class="signUp-background">
        <h1 id="p2t">Sign Up</h1>
        <br>
        <form class="signUp-form" method="POST" action="">
        
            <label><legend>First Name<span>*  </span><span class="error" id="vfname"></span></legend>
                <input type="text" name="first-name"/>
            </label>
        
            <label><legend>Last Name<span>*  </span><span class="error" id="vlname"></span></legend>
                <input type="text" name="last-name" />
            </label>
        
            <label><legend>Nationality<span>*  </span><span class="error" id="vnation"></span></legend>
                <select name="nationality">
                    <option value="" disabled selected>Select Nationality</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Brazilian">Brazilian</option>
                </select>
            </label>
        
            <label><legend>Passport Number<span>*  </span><span class="error" id="vpassportnum"></span></legend>
                <input type="text" name="passport-number" placeholder="e.g. P12345678"/>
            </label>
        
            <label><legend>Phone Number<span>* </span><span class="error" id="phonenum"></span></legend>
                <input type="text" name="phone-number" placeholder="+966 5XXXXXXXX"/>
            </label>
        
            </label>
        
            <label><legend>Email<span>* </span><span class="error" id="vem"></span></legend>
                <input id="email" type="email" name="email"/>
            </label>
        
            <label><legend>Birth Date<span>*  </span><span class="error" id="vbirthDate"></span></legend>
                <input type="date" name="birth-date"/>
            </label>
        
            <label><legend>Title  <span class="error" id="vtitle"></span></legend>
                <select name="title">
                    <option value="" disabled selected>Select Title</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms</option>
                </select>
            </label>
        
        
            <label><legend>Password<span>*  </span><span class="error" id="vpass"></span></legend>
                <input id="pass" type="password" name="password"/>
            </label>
        
            <label><legend>Confirm Password<span>*  </span><span class="error" id="vconpass"></span></legend>
                <input id="conpass" type="password" name="confirm-password"/>
            </label>

            <a href="../home/home.php"><button type="button" id="back-button" name="back-button">Back</button></a>
            <input type="submit" id="SignIn-button" value="Sign Up" onclick="return validateSignIn()"/> 
            
        </form>



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
            else if(pass.value.length < 8){
                vpass.innerText = "(Password must be at least 8 characters)";
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

        if(valid){
            document.querySelector('.signUp-form').submit();
        }

        return valid;
                
    }
    
    </script>
    
</body>
</html>
<?php include('../footer/footer.php'); ?>