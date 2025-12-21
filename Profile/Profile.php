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


include('../header/head.php');

if (isset($_SESSION['Profile_success'])): ?>
<script>
    alert("<?= $_SESSION['Profile_success'] ?>");
</script>
<?php unset($_SESSION['Profile_success']); endif; ?>

<body id="profile-body">
    <?php include('../header/header.php');?>
    <div class="profile-background">
        <h1 id="profile-title">Profile</h1>
        <br>
        <form class="profile-form">
        
            <label class="profile-label"><legend>First Name</legend>
                <input class="profile-input" type="text" value="<?= htmlspecialchars($user['first_name']) ?>" disabled/>
            </label>
        
            <label class="profile-label"><legend>Last Name</legend>
                <input class="profile-input" type="text" value="<?= htmlspecialchars($user['last_name']) ?>" disabled/>
            </label>
        
            <label class="profile-label"><legend>Nationality</legend>
                <input class="profile-input" type="text" value="<?= htmlspecialchars($user['nationality']) ?>" disabled/>
            </label>
        
            <label class="profile-label"><legend>Passport Number</legend>
                <input class="profile-input" type="text" value="<?= htmlspecialchars($user['passport']) ?>" disabled/>
            </label>
        
            <label class="profile-label"><legend>Phone Number</legend>
                <input class="profile-input" type="text" value="<?= htmlspecialchars($user['phone_number']) ?>" disabled/>
            </label>
        
            <label class="profile-label"><legend>Email</legend>
                <input class="profile-input" tupe="text" value="<?= htmlspecialchars($user['email']) ?>" disabled/>
            </label>
        
            <label class="profile-label"><legend>Birth Date</legend>
                <input class="profile-input" type="text" value="<?= htmlspecialchars($user['birth_date']) ?>" disabled/>
            </label>
        
            <label class="profile-label"><legend>Title</legend>
                <input class="profile-input" type="text" value="<?= htmlspecialchars($user['title']) ?>" disabled/>
            </label>
        
        
            <label class="profile-label"><legend>Password</legend>
                <input class="profile-input" type="password" value="********" disabled/>
            </label>
        
            <br>
            <a href="../home/home.php"><button type="button" id="profile-back-button" name="back-button">Back</button></a>
            <a href="../Profile/Update-Profile.php"><button type="button" id="profile-button" name="update-button">Update</button></a>
            
        </form>


    </div>
<?php include('../footer/footer.php'); ?>