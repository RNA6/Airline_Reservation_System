<!DOCTYPE html>
<html lang="en">
<head>
<?php
    $title = "Contact Us";
    include('header/head.php');
?>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php include('header/header.php'); ?>

<main class="common-container">

    <div class="ticket-card contact-form" style="max-width:600px; margin:0 auto;">

        <h1 class="head-title" style="text-align:center;">Contact Us</h1>

        <form>

            <div class="form-row">
                <span class="form-label">Full Name *</span>
                <input
                    type="text"
                    name="fullname"
                    class="form-input"
                    required
                >
            </div>

            <div class="form-row">
                <span class="form-label">Email *</span>
                <input
                    type="email"
                    name="email"
                    class="form-input"
                    required
                >
            </div>

            <div class="form-row">
                <span class="form-label">Message *</span>
                <textarea
                    name="message"
                    rows="4"
                    class="form-input"
                    required
                ></textarea>
            </div>

            <div class="action-buttons-blue" style="text-align:center;">
                <button type="submit" class="btn-blue-outline">Send</button>
            </div>

        </form>


    </div>

</main>

<?php include('footer/footer.php'); ?>

</body>
</html>
