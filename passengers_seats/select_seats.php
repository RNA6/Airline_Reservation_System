<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Select Seats</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <main class="common-container" style="padding-bottom: 20px; width: 400px;">
        
        <h1 class="head-title" style="text-align: center;">Select Seats</h1>
        <div class="plane">
            <form class ="seats-form" name="seats-form">
                <div class="small-hall-way">
                    <span class="exit"></span>
                </div>                

                <hr/>
                <h6 class="common-text seats-lable" style="margin-left: 115px;">A</h6>
                <h6 class="common-text seats-lable" style="margin-left: 150px;">B</h6>                
                
                <hr/>
                <?php for($i = 1; $i<=4; $i++){
                    $row = $i;
                    $type = 'business';
                    include("seat-row.php");
                } 
                ?>
                <hr/>

                <h6 class="common-text seats-lable" style="margin-left: 85px;">A</h6>
                <h6 class="common-text seats-lable" style="margin-left: 30px;">B</h6>                
                <h6 class="common-text seats-lable" style="margin-left: 120px;">C</h6>
                <h6 class="common-text seats-lable" style="margin-left: 30px;">D</h6>
                
                <hr/>  
                <?php for($i = 5; $i<=6; $i++){
                    $row = $i;
                    $type = 'economy';
                    include("seat-row.php");
                }?>               
                <hr/>
                
                <div class="small-hall-way">
                    <span class="exit"></span>
                    <span class="wc">WC</span>
                </div>                

                <hr/>
                <h6 class="common-text seats-lable" style="margin-left: 85px;">A</h6>
                <h6 class="common-text seats-lable" style="margin-left: 30px;">B</h6>                
                <h6 class="common-text seats-lable" style="margin-left: 120px;">C</h6>
                <h6 class="common-text seats-lable" style="margin-left: 30px;">D</h6>
                
                <hr/>  
                <?php for($i = 7; $i<=12; $i++){
                    $row = $i;
                    $type = 'economy';
                    include("seat-row.php");
                }?>               
                <hr/>
                
                <div class="small-hall-way">
                    <span class="exit"></span>
                </div>                

                <hr/>
                <h6 class="common-text seats-lable" style="margin-left: 85px;">A</h6>
                <h6 class="common-text seats-lable" style="margin-left: 30px;">B</h6>                
                <h6 class="common-text seats-lable" style="margin-left: 120px;">C</h6>
                <h6 class="common-text seats-lable" style="margin-left: 30px;">D</h6>
                
                <hr/>  
                <?php for($i = 13; $i<=13; $i++){
                    $row = $i;
                    $type = 'economy';
                    include("seat-row.php");
                }?>               
                <hr/>                    
            </form>
        </div>
        <div class="passenger-seat-wrapper">
            <?php include("passenger-seat.php")?>
            <?php include("passenger-seat.php")?>
        </div>
        <div class="action-area seats-actions">            
            <a href="../add_extras/add_extra.php">
                <button class="btn-blue-outline">Add Extra</button>
            </a>
            <a href="../checkout.html">
                <button class="btn-blue-outline">Skip to Payment</button>
            </a>
            <a href="../passengers_details/passengeres_details.php" style="margin-left:150px; margin-top: 20px;">
                <button class="btn-gray-outline">Back</button>
            </a>
        </div>

    </main>
    </body>
</html>