<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Extra</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <main class="add-extra common-container">
        <h1 class="page-title" style="text-align: center;">Add Extra</h1>

        <div class="select-section">
            <form name="extras-from">
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

                        $id = 'vegan-pasta';
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
                                <button class="btn-blue-outline">-</button>
                                <span class="common-text" id="carry-on-light">0</span>
                                <button class="btn-blue-outline">+</button>
                            </div>
                        </div>

                        <div class="bag" style="margin-left: 15px;">
                            <span class="fa-solid fa-suitcase-rolling medium"></span>
                            <p class="common-text" style="display: block;">14kg</p>
                            <div class="inc-dec">
                                <button class="btn-blue-outline">-</button>
                                <span class="common-text" id="checked-bag-medium">0</span>
                                <button class="btn-blue-outline">+</button>
                            </div>
                        </div>

                        <div class="bag row2">
                            <span class="fa-solid fa-suitcase-rolling large"></span>
                            <p class="common-text" style="display: block;">23kg</p>
                            <div class="inc-dec">
                                <button class="btn-blue-outline">-</button>
                                <span class="common-text" id="checked-bag-large">0</span>
                                <button class="btn-blue-outline">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="summary-card">
            <?php include("summary-row.php")?>
            <?php include("summary-row.php")?>
            <?php include("summary-row.php")?>
            <?php include("summary-row.php")?>
        </div>

        <div class="action-area flights">
            <a href="../passengers_seats/select_seats.php" >
                <button class="btn-gray-outline">Back</button> 
            </a>
            <a href="../checkout.html" >
                <button class="btn-blue-outline">Continue to Payment</button>    
            </a>
        </div>
    </form>
</div>

    </main>
</body>
</html>