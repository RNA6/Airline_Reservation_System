<div class= "header-body">
    <div class="divHeader"> 

        <div class="logo-div">
            <a href="http://localhost/Airline_Reservation_System/home/home.php"><img id="logo-img" src="http://localhost/Airline_Reservation_System/header/Logo.png" /></a>
        </div>

        <div class="header-menu">

            <ul>
                <li class="Home <?php if($title === "Home") echo "on"; ?>"><a href="http://localhost/Airline_Reservation_System/home/home.php">Home</a></li>
                <li class="About Us <?php if($title === "About Us") echo "on"; ?>"><a href="http://localhost/Airline_Reservation_System/about-us.php">About Us</a></li>
                <li class="Contact <?php if($title === "Contact Us") echo "on"; ?>"><a href="http://localhost/Airline_Reservation_System/contact-us.php">Contact</a></li>
            </ul>
        </div>

        <div class="header-h3-div">
            <?php if (!isset($_SESSION['passport'])): ?>
                <h3 id="header-text">For faster experience <a id="logIn" href="http://localhost/Airline_Reservation_System/SignIn-Page/SignIn-Page.php">Log In</a></h3>
            <?php endif; ?>

        </div>

        <div class="header-text-img">
            <div class="user-menu-container">
                <img src="http://localhost/Airline_Reservation_System/header/userProfile.png" class="user-icon" onclick="toggleUserMenu()">

                 <div class="user-dropdown" id="userDropdown">
                    <!-- If user in login -->
                    <a href="http://localhost/Airline_Reservation_System/Profile/Profile.php" class="logged-in only-logged">User Info</a>
                    <a href="#" class="logged-in only-logged">My Trips</a>
                    <a href="http://localhost/Airline_Reservation_System/header/LogOut.php" class="logged-in only-logged">Log Out</a>

                    <!-- If user in logOut -->
                    <a href="http://localhost/Airline_Reservation_System/SignIn-Page/SignIn-Page.php" class="not-logged only-not-logged">Log In</a>
                </div>
            </div>
        </div>

    </div>
</div>