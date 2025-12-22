<?php 
session_start();
$title ="Sign In";
include('../header/head.php'); ?>
</head>
<body id="signIn-body">
    <?php include('../header/header.php');?>
    <div class="signIn-background">
    <h1 id="signIn-title">Sign In</h1>

    <?php if (isset($_SESSION['SignUp_success'])): ?>
        <script>
            alert("<?= $_SESSION['SignUp_success'] ?>");
        </script>
    <?php unset($_SESSION['SignUp_success']); endif; ?>


        <form class="signIn-form" method="POST" action="SignIn-Proccess.php">
            <span class="signIn-errors"><?= $_SESSION['login_email_error'] ?? '' ?></span>

            <input class="signIn-form-input" id="email" type="email" name="user-email" placeholder="Email" required  autocomplete="off"/>
            <span class="signIn-errors"><?= $_SESSION['login_pass_error'] ?? '' ?></span>

            <input class="signIn-form-input" id="pass" type="password" name="user-password" placeholder="Password" required  autocomplete="off"/>


            <h3 id="SignIn-h3">Don't have an account? <a id="SignIn-link" href="../SignUp-Page/SignUp-Page.php">Sign Up</a></h3>

            <input type="button" id="SignIn-button" value="Sign In" onclick=" return validateSignIn()">
            <button type="button" id="signIn-back-button" name="back-button" onclick="window.history.back()">Back</button>
        </form>

        <?php
            unset($_SESSION['login_email_error']);
            unset($_SESSION['login_pass_error']);
        ?>

    </div>

    <script>
        function validateSignIn(){
            
            var em = document.getElementById("email")
            var vem = document.getElementsByClassName("signIn-errors")[0];

            var pass = document.getElementById("pass");
            var vpass = document.getElementsByClassName("signIn-errors")[1];

            valid = true;

            vem.innerText = "";
            vpass.innerText = "";
            em.style.border = "none"; 
            pass.style.border = "none"; 



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

<?php include('../footer/footer.php'); ?>
