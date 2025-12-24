<div class="passenger-seat-container" style="margin-bottom: 10px;">
    <input type="hidden" name="selected_seat[]" class="selected_seat">
    <span class="passenger-name"><?php echo $passenger->getFirst_name()." ".$passenger->getLast_name()?></span>
    <div class="seats passenger"></div>
</div>

<script>
    var seat;
    do {
        seat = '<?php echo getRandomSeat();?>';
        previous_seat = document.getElementById("seat-" + seat);
    } while (previous_seat.checked);
    
    previous_seat.checked = true;
    previous_seat.disabled = true;
    
    passenger_seats[<?php echo $i?>].textContent = seat;
    var selected_seat = document.getElementsByClassName('selected_seat');
    selected_seat[<?php echo $i?>].value = seat;
</script>