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
    <?php if($adult === 1 && $user != null){?>   
        <fieldset class="inputs-fieldset">
            <legend class="common-text">Title</legend>
            <select name="title" class="passenger-title inputs" disabled>
                <option><?php echo $user->getTitle()?></option>
            </select>
        </fieldset>
        
        <fieldset class="inputs-fieldset">
            <legend class="common-text">First Name</legend>
            <input name="first-name" class="inputs" type="text" placeholder="Enter First Name" disabled value="<?php echo $user->getFirst_name()?>"/>
        </fieldset>
        
        <fieldset class="inputs-fieldset">
            <legend class="common-text">Last Name</legend>
            <input name="last-name" class="inputs" type="text" placeholder="Enter Last Name" disabled value="<?php echo $user->getLast_name()?>"/>
        </fieldset>
        
        <fieldset class="inputs-fieldset">
            <legend class="common-text">Nationality</legend>
            <input name="nationality" class="inputs" type="text" placeholder="Enter Nationality" disabled value="<?php echo $user->getNationality()?>"/>
        </fieldset>
        
        <fieldset class="inputs-fieldset">
            <legend class="common-text">Passport</legend>
            <input name="passport" class="inputs" type="text" placeholder="Enter Passport Number" disabled value="<?php echo $user->getPassport()?>"/>
        </fieldset>
        
        <fieldset class="inputs-fieldset">
            <legend class="common-text">Date of Birth</legend>            
            <input name="birth-date" class="inputs" type="date" disabled value="<?php echo htmlspecialchars($user->getBirth_date());?>">
        </fieldset>                 
                
    <?php } else{?>    
    <fieldset class="inputs-fieldset">
        
        <legend class="common-text">Title<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
        <select name="title[]" class="passenger-title inputs" required>
            <option value="" disabled selected></option>
            
            <?php if($adult <= $_SESSION['booking']['adults_number'] ){?>            
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
            <?php } else{?>
                <option value="Miss">Miss</option>
                <option value="Mstr">Mstr</option>
            <?php }?>
        </select>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">First Name<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
        <input name="first-name[]" class="inputs" type="text" placeholder="Enter First Name" required/>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">Last Name<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
        <input name="last-name[]" class="inputs" type="text" placeholder="Enter Last Name" required/>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        
        <legend class="common-text">Nationality<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
        <select name="nationality[]"class="passenger-title inputs" required>
            <option value="" disabled selected>Select Nationality</option>
            <option value="Saudi">Saudi Arabian</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="Bahraini">Bahraini</option>
            <option value="Kuwaiti">Kuwaiti</option>
        </select>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">Passport<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
        <input name="passport[]" class="inputs" type="text" placeholder="Enter Passport Number" required/>
    </fieldset>
    
    <fieldset class="inputs-fieldset">
        <legend class="common-text">Date of Birth<span class="ast">*  </span><span class="errorCom" id="vpass"></span></legend>
        <input name="birth-date[]" class="inputs" type="date" required/>
    </fieldset>
    <?php }?>
</div>