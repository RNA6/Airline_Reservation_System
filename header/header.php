<?php $title ?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title ?> | FlyGo</title>
	<link rel="shortcut icon" href="../header/title_icon.ico">

    <style>
        body{ margin: 0; padding: 0;  font-family: serif;}
        .divHeader{width:100%; height:75px; background-color: white; margin: 0; padding: 0; box-shadow: -5px 1px 4px 0px rgba(0, 0, 0, 0.25); vertical-align: middle;}
        #logo-img{width:192px; height: 45.19px;}
        .logo-div{display: inline-block; vertical-align: middle; margin-top: 15px; margin-left: 15px;}
        .header-menu ul{list-style-type: none; padding: 0; margin: 0;}
        .header-menu{display: inline-block; vertical-align: middle; margin-top:9px; text-align: center; margin: 9px 170px 0 170px;}
        .header-menu a{display:inline-block; text-decoration: none; width:120px; text-align: center; padding: 10px; color:#1C75BC; font-size:20px; font-weight:normal; font-family:serif; /*background-color: #EBF5FF;*/}
        #htext, #logIn{color:#1C75BC; font-size:18px; font-weight:normal; display: inline-block; margin-top:13px ;}
        #user-img{width:47px; height: 47px;}
        .user-picture, div{margin: 0; padding: 0; display: inline-block; vertical-align: middle;}
        
        #htext{margin-right: 5px;}

        .user-menu-container {
    position: relative;
    display: inline-block;
}

.user-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    cursor: pointer;
}

.user-dropdown {
    position: absolute;
    right: 0;
    background: white;
    padding: 10px 0;
    width: 160px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
    display: none; /* مخفية افتراضيًا */
    text-align: left;
    z-index: 999;
}

.user-dropdown a {
    display: block;
    padding: 10px 15px;
    color: black;
    text-decoration: none;
    font-size: 18px;
}

.user-dropdown a:hover {
    background-color: #F1F1F1;
}

    </style>

<script>
let loggedIn = <?php echo isset($_SESSION['passport']) ? 'true' : 'false'; ?>;


function toggleUserMenu() {
    document.getElementById("userDropdown").style.display =
        document.getElementById("userDropdown").style.display === "block" 
        ? "none" 
        : "block";

    updateUserMenu();
}

function updateUserMenu() {
    const loggedItems = document.querySelectorAll(".only-logged");
    const notLoggedItems = document.querySelectorAll(".only-not-logged");

    if (loggedIn) {
        loggedItems.forEach(el => el.style.display = "block");
        notLoggedItems.forEach(el => el.style.display = "none");
    } else {
        loggedItems.forEach(el => el.style.display = "none");
        notLoggedItems.forEach(el => el.style.display = "block");
    }
}


window.onclick = function(event) {
    if (!event.target.matches('.user-icon')) {
        document.getElementById("userDropdown").style.display = "none";
    }
    let loggedIn = <?php echo isset($_SESSION['passport']) ? 'true' : 'false'; ?>;
updateUserMenu();
}
</script>


</head>
<body>
    <div class="divHeader"> 

        <div class="logo-div">
            <a href="#"><img id="logo-img" src="../header/Logo.png" /></a>
        </div>

        <div class="header-menu">
            <ul>
                <a href="../home/home.php" class="Home on"><li class="Home <?php if($title === "Home") echo "on"; ?>">Home</li></a>
                <a href="#"><li>About Us</li></a>
                <a href="#"><li>Contact</li></a>
            </ul>
        </div>

        <div>
            <h3 id="htext" class="only-not-logged">For faster experience <a id="logIn" href="../SignIn-Page/SignIn-Page.php">Log In</a></h3>
            

            <div class="user-menu-container">
                <img src="../header/userProfile.png" class="user-icon" onclick="toggleUserMenu()">

                 <div class="user-dropdown" id="userDropdown">
                    <!-- لو المستخدم مسجّل دخول -->
                    <a href="../Profile/Profile.php" class="logged-in only-logged">User Info</a>
                    <a href="#" class="logged-in only-logged">My Trips</a>
                    <a href="../LogOut.php" class="logged-in only-logged">Log Out</a>

                    <!-- لو المستخدم غير مسجّل -->
                    <a href="../SignIn-Page/SignIn-Page.php" class="not-logged only-not-logged">Log In</a>
                </div>
            </div>
            <!-- <img Id="user-img" -->
        </div>

    </div>
</body>

</html>