<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://localhost/Airline_Reservation_System/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="shortcut icon" href="../header/title_icon.ico">
        <title><?php echo $title ?> | FlyGo</title>
        
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
                    notLoggedItems.forEach(el => el.style.display = "inline-block");
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