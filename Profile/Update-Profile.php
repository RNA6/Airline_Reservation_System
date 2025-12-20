<?php

$title ="Profile";

session_start();
require_once "../flygo_system_sqldb/db.php"; 

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

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $passport);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();
$stmt->close();


include('../header/header.php');
?>


<html lang="en">
<head>
    <title>Profile</title>

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
        <h1 id="p2t">Update Profile</h1>
        <br>
        <form class="signUp-form" method="POST" action="">
        
            <label><legend>First Name</legend>
                <input type="text" value="<?= htmlspecialchars($user['first_name']) ?>"/>
            </label>
        
            <label><legend>Last Name</legend>
                <input type="text" value="<?= htmlspecialchars($user['last_name']) ?>"/>
            </label>
        
            <label><legend>Nationality</legend>
                <input type="text" value="<?= htmlspecialchars($user['nationality']) ?>"/>
            </label>
        
            <label><legend>Passport Number</legend>
                <input type="text" value="<?= htmlspecialchars($user['passport']) ?>"/>
            </label>
        
            <label><legend>Phone Number</legend>
                <input type="text" value="<?= htmlspecialchars($user['phone_number']) ?>"/>
            </label>
        
            </label>
        
            <label><legend>Email</legend>
                <input type="text" value="<?= htmlspecialchars($user['email']) ?>"/>
            </label>
        
            <label><legend>Birth Date</legend>
                <input type="date" value="<?= htmlspecialchars($user['birth_date']) ?>"/>
            </label>
        
            <label><legend>Title</legend>
                <input type="text" value="<?= htmlspecialchars($user['title']) ?>"/>
            </label>
        
        
            <label><legend>Password</legend>
                <input type="password" value="<?= htmlspecialchars($user['title']) ?>"/>
            </label>
        
            <label style="visibility: hidden"><legend>Confirm Password</legend>
                <input id="conpass" type="password" name="confirm-password"/>
            </label>

            <a href="../home/home.php"><button type="button" id="back-button" name="back-button">Back</button></a>
            <input type="submit" id="SignIn-button" value="Confirm" onclick="return validateSignIn()"/>
            
        </form>



    </div>
    
</body>
</html>
<?php include('../footer/footer.php'); ?>