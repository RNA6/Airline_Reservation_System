<?php 
session_start();
$title ="Sign In";
include('../header/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign In</title>
    <style>
        body{background-color: #EBF5FF; margin: 0; padding: 0; height: 550px; text-align: center;}
        .signIn-background{ width: 550px; height: 510px; overflow: visible; text-align: center; background-color:white; border-radius: 80px; box-shadow: 5px -5px 4px rgba(220, 235, 251, 0.50), -5px 5px 4px rgba(220, 235, 251, 1); padding: 0; margin: 30px auto; display:inline-block; padding-bottom: 60px;}
        #p2t{color: black; font-size: 44px; margin: 35px 0; font-weight:600; font-family: serif;}
        .signIn-form-input{width:328px; height:53px; border-radius: 10px; border: none; background-color:#EEEEEE; font-size:24px; font-weight:lighter; margin-bottom: 25px; padding-left: 70px;}

        h3{font-family:serif; color:#696969; font-size:18px; font-weight:normal; padding:0;}
        #SignIn{font-family:serif; color:#696969; font-size:18px; font-weight:normal;}

        button, #SignIn-button{background-color: #1C75BC; width: 398px; height: 53px; color:white; font-size: 24px; font-weight: 500; padding-bottom: 5px; border-radius: 80px; border: none; margin-bottom: 25px; font-family:serif; }
        #back-button{background-color: #9F9F9F;}

        .signIn-form #email{background-image: url('email-icon-form.png'); background-position: 20px center; background-size: 25px 20px; background-repeat: no-repeat;}
        .signIn-form #pass{background-image: url('password-icon-form.png'); background-position: 20px center; background-size: 20px 25px; background-repeat: no-repeat;}

        .error{color: red; font-family:serif; display: inline-block; width:398px;text-align:left;}

    </style>

</head>
<body>

    <div class="signIn-background">
        <h1 id="p2t">Sign In</h1>

        <form class="signIn-form" method="POST" action="SignIn-Proccess.php">
            <span class="error"><?= $_SESSION['login_email_error'] ?? '' ?></span>

            <input class="signIn-form-input" id="email" type="email" name="user-email" placeholder="Email" required  autocomplete="off"/>
            <span class="error"><?= $_SESSION['login_pass_error'] ?? '' ?></span>

            <input class="signIn-form-input" id="pass" type="password" name="user-password" placeholder="Password" required  autocomplete="off"/>


            <h3>Don't have an account? <a id="SignIn" href="../SignUp-Page/SignUp-Page.php">Sign Up</a></h3>

            <input type="button" id="SignIn-button" value="Sign In" onclick="validateSignIn()">
            <a href="../home/home.php"><button type="button" id="back-button" name="back-button">Back</button></a>
        </form>

        <?php
            unset($_SESSION['login_email_error']);
            unset($_SESSION['login_pass_error']);
        ?>

    </div>

    <script>
        function validateSignIn(){
            
            var em = document.getElementById("email")
            var vem = document.getElementsByClassName("error")[0];

            var pass = document.getElementById("pass");
            var vpass = document.getElementsByClassName("error")[1];

            valid = true;

            vem.innerText = "";
            vpass.innerText = "";
            em.style.border = "none"; /////
            pass.style.border = "none"; ///



            if(em.value.trim() === ""){
                em.style.border = "2px solid red";
                vem.innerText = "This is Required"
                valid = false;
            }
            else{
                regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!regex.test(em.value.trim())) {
                    vem.innerText = "Please Enter valid email";
                    em.style.border = "2px solid red";
                    valid = false; 
                }
            }
            

            
            if(pass.value.trim() === ""){
                pass.style.border = "2px solid red";
                vpass.innerText = "This is Required"
                valid = false;
            }
            else if(pass.value.length < 8){
                vpass.innerText = "Password must be at least 8 characters";
                pass.style.border = "2px solid red";
                valid = false

            }

            if(valid){
            document.querySelector('.signIn-form').submit();
            }

            return valid;
                
        }
    </script>
    
</body>
</html>
<?php include('../footer/footer.php'); ?>
