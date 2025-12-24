<div class="summary-row">
    <span class="common-text"><?php echo $passenger->getAge_group(). ": ". $passenger->getFirst_name(). " ". $passenger->getLast_name()?></span>
    <div class="part">
        <div class="header">
            <span class="fa-solid fa-suitcase"></span>
            <span class="common-text">Baggage</span>
        </div>
        
        <input type="hidden" name="selected_bag1[]" class="selected_bag1" value="0">
        <p style="display:none;"><span class="carry-on"></span> Carry On (7kg)</p>
        <p style="display:none;" class="price carry-on-price">$30</p>

        <input type="hidden" name="selected_bag2[]" class="selected_bag2" value="0">
        <p style="display:none;"><span class="checked-bag14"></span> Checked Bag (14kg)</p>
        <p style="display:none;" class="price checked-bag14-price">$30</p>

        <input type="hidden" name="selected_bag3[]" class="selected_bag3" value="0">
        <p style="display:none;"><span class="checked-bag23"></span> Checked Bag (23kg)</p>
        <p style="display:none;" class="price checked-bag23-price">$30</p>
    </div>

    <div class="part">
        <div class="header">
            <i class="fa-solid fa-utensils"></i>
            <span class="common-text">Meal</span>
        </div>
        <input type="hidden" name="selected_meal[]" class="selected_meal" value="">
        <p style="display:none;" class="meal-item">Chicken Soup</p>
        <p style="display:none;" class="price meal-item-price">$12</p>
    </div>
</div>