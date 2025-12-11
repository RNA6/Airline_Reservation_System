<?php if($type === 'business'){?>
    <label>
    <input class="inputs" type="checkbox" name="seats" value="A"/>
    <div class="seats business" id="seat-<?php echo $row?>A"></div>
    </label>

    <span class="hall-way"></span>

    <label>
        <input class="inputs" type="checkbox" name="seats" value="B"/>
        <div class="seats business" id="seat-<?php echo $row?>B"></div>
    </label>
<?php } else{?>
    <label>
    <input class="inputs" type="checkbox" name="seats" value="A"/>
    <div class="seats" id="seat-<?php echo $row?>A"></div>
    </label>

    <label style="margin-left: 15px">
        <input class="inputs" type="checkbox" name="seats" value="B"/>
        <div class="seats" id="seat-<?php echo $row?>B"></div>
    </label>

    <span class="hall-way"></span>

    <label>
        <input class="inputs" type="checkbox" name="seats" value="C"/>
        <div class="seats" id="seat-<?php echo $row?>C"></div>
    </label>

    <label style="margin-left: 15px">
        <input class="inputs" type="checkbox" name="seats" value="D"/>
        <div class="seats" id="seat-<?php echo $row?>D"></div>
    </label>
<?php }?>
