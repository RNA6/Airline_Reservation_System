<?php if($type === 'business'){?>
    <label>
    <input id="seat-<?php echo $row?>A" class="inputs" type="checkbox" name="seats" value="<?php echo $row?>A"/>
    <div class="seats business"></div>
    </label>

    <span class="hall-way"></span>

    <label>
        <input id="seat-<?php echo $row?>B" class="inputs" type="checkbox" name="seats" value="<?php echo $row?>B"/>
        <div class="seats business"></div>
    </label>
<?php } else{?>
    <label>
    <input id="seat-<?php echo $row?>A" class="inputs" type="checkbox" name="seats" value="<?php echo $row?>A"/>
    <div class="seats"></div>
    </label>

    <label style="margin-left: 15px">
        <input  id="seat-<?php echo $row?>B" class="inputs" type="checkbox" name="seats" value="<?php echo $row?>B"/>
        <div class="seats" ></div>
    </label>

    <span class="hall-way"></span>

    <label>
        <input id="seat-<?php echo $row?>C" class="inputs" type="checkbox" name="seats" value="<?php echo $row?>C"/>
        <div class="seats" ></div>
    </label>

    <label style="margin-left: 15px">
        <input id="seat-<?php echo $row?>D" class="inputs" type="checkbox" name="seats" value="<?php echo $row?>D"/>
        <div class="seats" ></div>
    </label>
<?php }?>
