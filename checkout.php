<?php
    include("flygo_system_sqldb/database.php");
    include("flygo_system_sqldb/database_utilities.php");
    include("flygo_system_sqldb/classes.php");
    
    session_start();
    if (!isset($_SESSION['passport'])) {
        header("Location: SignIn-Page/SignIn-Page.php");
        exit;
    }

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['selected_bag1'])
    ) {
        for ($i = 0; $i < $_SESSION['booking']['total_passengers'] - (int)$_SESSION['booking']['infants_number']; $i++) {

            $_SESSION['booking']['extras'.($i+1)] = [];
            $_SESSION['booking']['extras'.($i+1)][0] = $_POST['selected_bag1'][$i];
            $_SESSION['booking']['extras'.($i+1)][1] = $_POST['selected_bag2'][$i];
            $_SESSION['booking']['extras'.($i+1)][2] = $_POST['selected_bag3'][$i];
            $_SESSION['booking']['extras'.($i+1)][3] = $_POST['selected_meal'][$i];
        }

        $_SESSION['booking']['bags_total']  = $_POST['total_baggage'];
        $_SESSION['booking']['meals_total'] = $_POST['total_meals'];

    }

    $title ="Checkout";
    include('header/head.php'); 
?>
</head>
    <body>        
    <?php include('header/header.php');?> 
    <main class="checkout-container">
        <h1 class="page-title">Complete your booking</h1>

        <div class="summary-section">
            
            <div class="ticket-card black-border">
                <div class="ticket-header">
                    <span class="p-name">Title, Name</span>
                    <span class="airline-code">#SAR</span>
                </div>
                
                <div class="ticket-info">
                    <small>#Ticket Number</small>
                    <div class="flight-route">
                        <div class="city">
                            <strong>JED</strong>
                            <span>20:20</span>
                        </div>
                        <div class="path">
                            <span class="duration">Non-Stop 1h 5m</span>
                            <div class="line"><i class="fa-solid fa-plane"></i></div>
                        </div>
                        <div class="city">
                            <strong>MED</strong>
                            <span>21:25</span>
                        </div>
                    </div>
                </div>

                <div class="passenger-details">
    			<strong>passengers details</strong>
    			<ul class="p-list">
        			<li>
            			<span>Ali</span>
            			<span class="p-type">(Adult)</span>
        			</li>
        			<li>
            			<span>Fatimah</span>
            			<span class="p-type">(Child)</span>
        			</li>
        			<li class="empty-line"></li>
    			</ul>
		</div>
            </div>

            <div class="price-card">
                <h3>Price details</h3>
                <div class="price-row">
                    <span>Tickets</span>
                    <span>1200</span>
                </div>
                <div class="price-row">
                    <span>Seats</span>
                    <span>50</span>
                </div>
                <div class="price-row">
                    <span>Extra</span>
                    <span>0</span>
                </div>
                <hr>
                <div class="price-row total">
                    <span>Total</span>
                    <span>1250</span>
                </div>
            </div>
        </div>

        <div class="payment-section">
    <h3>Credit/Debit card details</h3>
    
    <form action="save_card.php" method="POST">
        
        <div class="name-fields">
            <div class="form-group">
                <label>F.Name</label>
                <input type="text" name="first_name" class="input-box" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <label>L.Name</label>
                <input type="text" name="last_name" class="input-box" placeholder="Last Name" required>
            </div>
        </div>

        <div class="form-group">
            <label>Card Number <small>required</small></label>
            <input type="text"
            name="card_number"
            placeholder="0000000000000000"
            class="input-box"
            maxlength="16"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            required>

        </div>

        <div class="expiry-fields">
            <div class="form-group">
                <label>Expires On <small>required</small></label>
                <div class="date-selects">

                    <select name="exp_month" class="input-box" required>
                        <option value="" disabled selected>Month</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>

                    <select name="exp_year" class="input-box" required>
                        <option value="" disabled selected>Year</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group security-code">

            <label>Security Code <small>required</small></label>
            <div class="cvv-box">
                <input type="text"
                name="cvv"
                class="input-box short"
                placeholder="CVV"
                maxlength="3"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                required>
                <i class="fa-regular fa-credit-card"></i>
            </div>
        </div>

        <div class="action-buttons">
            <button type="button" class="btn-back" onclick="window.history.back()">Back</button>
            <button type="submit" class="btn-pay">Pay</button>
        </div>
    </form>
</div>

    </main>
<?php include('footer/footer.php'); ?>