<span class="common-text" style="font-size: 1.5rem;">
    <?php
        if($adult <= $_SESSION['booking']['adults_number'] ){
            echo "Adult ".$adult;
        }
        elseif($child <= $_SESSION['booking']['children_number']){
            echo "Child ".$child;
        }
        elseif($infant <= $_SESSION['booking']['infants_number']){
            echo "Infant ".$infant;
        }
    ?>
</span>
<div class="details-container">    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">#Title</legend>
        <select class="passenger-title inputs">
            <option></option>
            <?php if($adult <= $_SESSION['booking']['adults_number'] ){?>            
                <option>Mr</option>
                <option>Mrs</option>
                <option>Ms</option>
            <?php } else{?>
                <option>Miss</option>
                <option>Mstr</option>
            <?php }?>
        </select>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">First Name</legend>
        <input class="inputs" type="text" placeholder="Enter First Name"/>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">Last Name</legend>
        <input class="inputs" type="text" placeholder="Enter Last Name"/>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">Nationality</legend>
        <input class="inputs" type="text" placeholder="Enter Nationality Number"/>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">Passport</legend>
        <input class="inputs" type="text" placeholder="Enter Passport Number"/>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">Date of Birth</legend>
        <input class="inputs" type="date"/>
    </fieldset>
</div>