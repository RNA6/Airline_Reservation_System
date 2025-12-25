<?php
    
    include("../flygo_system_sqldb/database.php");
    include("../flygo_system_sqldb/database_utilities.php");
    include("../flygo_system_sqldb/classes.php");
    
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $_SESSION['booking']['seats'] = $_POST['selected_seat'];
        
        header("Location: add_extra.php");
        exit;
    }
    $title ="Extras";
    include('../header/head.php'); 
?>
<script>
    class FlightMeals {
        constructor() {
            this.meals = {
                "Chicken Biryani": 25,
                "Kapsa": 28,
                "Chicken Pasta": 22,
                "Vegan Pasta": 20,
                "Salad": 15,
                "Chicken Sandwitch": 18,
                "Omlete": 16
            };
        }

        getMealPrice(mealName) {
            return this.meals[mealName];
        }
    }
    class BaggagePrices {
        constructor() {
            this.bags = {
                "7Kg": 20,     
                "14Kg": 50,
                "23Kg": 80
            };
        }

        getBagPrice(bagType) {
            return this.bags[bagType] ?? null;
        }
    }
</script>
</head>
    <body>        
    <?php include('../header/header.php');?> 

    <main class="add-extra common-container">
        <h1 class="page-title" style="text-align: center;">Add Extra</h1>

        <div class="select-section">
            <form name="extras-from" method="post" action="../checkout.php">
                <div class="extras-from">
                    <div class="add-extra ticket-card black-border">
                        <span class="add-extra common-text">Meal</span>
                        <hr/>

                        <ul class="meal-list">
                            <?php
                            $id = 'chicken-biryani';
                            $meal = 'Chicken Biryani';
                            include("meal-item.php");

                            $id = 'kapsa';
                            $meal = 'Kapsa';
                            include("meal-item.php");

                            $id = 'chicken_pasta';
                            $meal = 'Chicken Pasta';
                            include("meal-item.php");

                            $id = 'vegan_pasta';
                            $meal = 'Vegan Pasta';
                            include("meal-item.php");

                            $id = 'salad';
                            $meal = 'Salad';
                            include("meal-item.php");

                            $id = 'chicken_sandwitch';
                            $meal = 'Chicken Sandwitch';
                            include("meal-item.php");

                            $id = 'omlete';
                            $meal = 'Omlete';
                            include("meal-item.php");
                            ?>
                        </ul>
                    </div>
                    <div class="bags add-extra ticket-card black-border">
                        <span class="add-extra common-text">Baggage</span>
                        <hr/>
                        <div class="bags-selection">
                            <div class="bag">
                                <span class="fa-solid fa-suitcase"></span>
                                <p class="common-text" style="display: block;">7kg</p>
                                <div class="inc-dec">
                                    <button type="button" class="btn-blue-outline">-</button>
                                    <span class="common-text" id="carry-on-light">0</span>
                                    <button type="button" class="btn-blue-outline">+</button>
                                </div>
                            </div>

                            <div class="bag" style="margin-left: 15px;">
                                <span class="fa-solid fa-suitcase-rolling medium"></span>
                                <p class="common-text" style="display: block;">14kg</p>
                                <div class="inc-dec">
                                    <button type="button" class="btn-blue-outline">-</button>
                                    <span class="common-text" id="checked-bag-medium">0</span>
                                    <button type="button" class="btn-blue-outline">+</button>
                                </div>
                            </div>

                            <div class="bag row2">
                                <span class="fa-solid fa-suitcase-rolling large"></span>
                                <p class="common-text" style="display: block;">23kg</p>
                                <div class="inc-dec">
                                    <button type="button" class="btn-blue-outline">-</button>
                                    <span class="common-text" id="checked-bag-large">0</span>
                                    <button type="button" class="btn-blue-outline">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        var buttons = document.querySelectorAll(".inc-dec>button");
                        
                        var suitcaseD = buttons[0];
                        var suitcase = document.getElementById("carry-on-light");
                        var suitcaseU = buttons[1];
                        var suitcase_N = 0;
                        suitcaseD.addEventListener("click", function(){
                            if(suitcase_N!=0){
                                suitcase_N--;
                                suitcase.textContent = suitcase_N;
                            }
                        });
                        suitcaseU.addEventListener("click", function(){
                            if(suitcase_N!=5){
                                suitcase_N++;
                                suitcase.textContent = suitcase_N;
                            }
                        });

                        var suitcase_rooling_MD = buttons[2];
                        var suitcase_rooling_M = document.getElementById("checked-bag-medium");
                        var suitcase_rooling_MU = buttons[3];
                        var suitcase_rooling_MN = 0;

                        suitcase_rooling_MD.addEventListener("click", function(){
                            if(suitcase_rooling_MN!=0){
                                suitcase_rooling_MN--;
                                suitcase_rooling_M.textContent = suitcase_rooling_MN;
                            }
                        });
                        suitcase_rooling_MU.addEventListener("click", function(){
                            if(suitcase_rooling_MN!=5){
                                suitcase_rooling_MN++;
                                suitcase_rooling_M.textContent = suitcase_rooling_MN;
                            }
                        });
                        
                        var suitcase_rooling_LD = buttons[4];
                        var suitcase_rooling_L = document.getElementById("checked-bag-large");
                        var suitcase_rooling_LU = buttons[5];
                        var suitcase_rooling_LN= 0;

                        suitcase_rooling_LD.addEventListener("click", function(){
                            if(suitcase_rooling_LN!=0){
                                suitcase_rooling_LN--;
                                suitcase_rooling_L.textContent = suitcase_rooling_LN;
                            }
                        });
                        suitcase_rooling_LU.addEventListener("click", function(){
                            if(suitcase_rooling_LN!=5){
                                suitcase_rooling_LN++;
                                suitcase_rooling_L.textContent = suitcase_rooling_LN;
                            }
                        });
                    </script>
                </div>
                <div class="summary-card">
                    <?php 
                        for($i = 0; $i< $_SESSION['booking']['total_passengers'] - (int) $_SESSION['booking']['infants_number']; $i++){
                            $passenger = $_SESSION['booking']['passengers'][$i];
                            include("summary-row.php");
                        }
                    ?>
                    <input type="hidden" name="total_baggage" id="total_baggage">
                    <input type="hidden" name="total_meals" id="total_meals">
                    <script>
                                var pCO = document.querySelectorAll("p>.carry-on");
                                var pCOP = document.getElementsByClassName("carry-on-price");
                                var pCBM = document.querySelectorAll("p>.checked-bag14");
                                var pCBMP = document.getElementsByClassName("checked-bag14-price");
                                var pCBL = document.querySelectorAll("p>.checked-bag23");
                                var pCBLP = document.getElementsByClassName("checked-bag23-price");
                                var meal_item = document.getElementsByClassName("meal-item");
                                var meal_item_price = document.getElementsByClassName("meal-item-price");
                                var total_baggage = document.getElementById("total_baggage");
                                var total_baggage_price = 0;
                                var total_meals = document.getElementById("total_meals");
                                var total_meals_price = 0;
                                var form = document.forms[0];
                                var meals = Array.from(form.elements["meal"]);

                                var hidden_bag1 = document.getElementsByClassName('selected_bag1');
                                var hidden_bag2 = document.getElementsByClassName('selected_bag2');
                                var hidden_bag3 = document.getElementsByClassName('selected_bag3');
                                var hidden_meal = document.getElementsByClassName('selected_meal');
                                
                                var passenger_baggage1 = document.getElementsByClassName("carry-on");
                                var passenger_baggage2 = document.getElementsByClassName("checked-bag14");
                                var passenger_baggage3 = document.getElementsByClassName("checked-bag23");
                                var passenger_meal = document.getElementsByClassName("meal-item");
                                
                                var bags_list = new BaggagePrices();
                                var meal_list = new FlightMeals();
                                var passenger_counter = 0;

                                var selected_meal = document.getElementById("selected_meal");
                                meals.forEach(element => {
                                    element.addEventListener("click", function(){
                                        if(element.checked){
                                            
                                            if(suitcase_N != 0){                                        
                                            pCO[passenger_counter].parentElement.style.display = "block";                
                                            pCOP[passenger_counter].style.display = "block";
                                            passenger_baggage1[passenger_counter].textContent = suitcase_N;
                                            var total = Number(suitcase_N) * bags_list.getBagPrice("7Kg");
                                            total_baggage_price += total;
                                            pCOP[passenger_counter].textContent = total+ " SAR";
                                            hidden_bag1[passenger_counter].value = suitcase_N;
                                            }
                                            else{
                                                pCO[passenger_counter].parentElement.style.display = "none";                
                                                pCOP[passenger_counter].style.display = "none";
                                            } 

                                            if(suitcase_rooling_MN != 0){                              
                                            pCBM[passenger_counter].parentElement.style.display = "block";                
                                            pCBMP[passenger_counter].style.display = "block";
                                            passenger_baggage2[passenger_counter].textContent = suitcase_rooling_MN;
                                            var total = Number(suitcase_rooling_MN) * bags_list.getBagPrice("14Kg");
                                            total_baggage_price += total;
                                            pCBMP[passenger_counter].textContent =total+ " SAR";
                                            hidden_bag2[passenger_counter].value = suitcase_rooling_MN;
                                            }
                                            else{
                                                pCBM[passenger_counter].parentElement.style.display = "none";                
                                                pCBMP[passenger_counter].style.display = "none";
                                            } 
                                            
                                            if(suitcase_rooling_LN != 0){                          
                                            pCBL[passenger_counter].parentElement.style.display = "block";                
                                            pCBLP[passenger_counter].style.display = "block";
                                            passenger_baggage3[passenger_counter].textContent = suitcase_rooling_LN;
                                            var total = Number(suitcase_rooling_LN) * bags_list.getBagPrice("23Kg");
                                            total_baggage_price += total;
                                            pCBLP[passenger_counter].textContent = total + " SAR";
                                            hidden_bag3[passenger_counter].value = suitcase_rooling_LN;
                                            }
                                            else{
                                                pCBL[passenger_counter].parentElement.style.display = "none";                
                                                pCBLP[passenger_counter].style.display = "none";
                                            }     
                                            console.log(passenger_meal);
                                            meal_item[passenger_counter].style.display = "block";                
                                            meal_item_price[passenger_counter].style.display = "block";
                                            hidden_meal[passenger_counter].value = element.value;
                                            passenger_meal[passenger_counter].textContent = element.value;
                                            meal_item_price[passenger_counter++].textContent = meal_list.getMealPrice(element.value) + " SAR";
                                            total_meals_price += meal_list.getMealPrice(element.value);
                                            
                                            
                                            if(passenger_counter === <?php echo $_SESSION['booking']['total_passengers'] - (int)$_SESSION['booking']['infants_number'];?>){
                                                Array.from(form.elements).forEach(element => {
                                                    if(element.getAttribute('type')!="hidden")
                                                        element.disabled = true;
                                                });
                                                
                                                submitBtn.disabled = false;
                                                total_baggage.value = total_baggage_price;
                                                total_meals.value = total_meals_price;
                                                return;
                                            }

                                            suitcase.textContent = 0;
                                            suitcase_N = 0;
                                            suitcase_rooling_M.textContent = 0;
                                            suitcase_rooling_MN = 0;
                                            suitcase_rooling_L.textContent = 0;
                                            suitcase_rooling_LN = 0;
                                            element.checked = false;
                                        }
                                        
                                    });
                                });
                            </script>
                </div>
                
                <div class="action-area flights">
                    <a href="../passengers_seats/select_seats.php" >
                        <button type="button" class="btn-gray-outline">Back</button> 
                    </a>
                    <button name="continue" type="submit" id="submit" class="btn-blue-outline">Continue to Payment</button>    
                </div>

                <script>
                    var form = document.forms[0];
                    var submitBtn = document.getElementById("submit");
                    
                    submitBtn.addEventListener("click", function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            form.reportValidity();
                            var page_header = document.getElementsByTagName("body");
                            window.scrollTo({
                                top: page_header,
                                behavior: 'smooth'
                            });
                        }
                        console.log("SUBMITTING");
                    });
                    
                </script>
            </form>
        </div>

        
    </form>
</div>

    </main>
<?php include('../footer/footer.php'); ?>