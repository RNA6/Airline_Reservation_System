<div class= "header-body">
    <div class="divHeader"> 

        <div class="logo-div">
            <a href="#"><img id="logo-img" src="../header/Logo.png" /></a>
        </div>

        <div class="header-menu">

            <ul>
                <li class="Home <?php if($title === "Home") echo "on"; ?>"><a href="../home/home.php">Home</a></li>
                <li class="About Us <?php if($title === "About Us") echo "on"; ?>"><a href="#">About Us</a></li>
                <li class="Contact <?php if($title === "Contact") echo "on"; ?>"><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="header-text-img">
           <h3 id="htext" class="only-not-logged">For faster experience <a id="logIn" href="../SignIn-Page/SignIn-Page.php">Log In</a></h3> 
            

            <div class="user-menu-container">
                <img src="../header/userProfile.png" class="user-icon" onclick="toggleUserMenu()">

                 <div class="user-dropdown" id="userDropdown">
                    <!-- If user in login -->
                    <a href="../Profile/Profile.php" class="logged-in only-logged">User Info</a>
                    <a href="#" class="logged-in only-logged">My Trips</a>
                    <a href="../header/LogOut.php" class="logged-in only-logged">Log Out</a>

                    <!-- If user in logOut -->
                    <a href="../SignIn-Page/SignIn-Page.php" class="not-logged only-not-logged">Log In</a>
                </div>
            </div>
        </div>

    </div>
</div>