<label>
    <input class="inputs" type="radio" name="ticket" value="<?php echo $value['flight_number']?>" id="<?php echo $value['flight_number']?>" required/>

    <div class="ticket-card flights">
        <div class="ticket-info">
            <small><?php echo $value['flight_number']?></small>
            <div class="flight-route">
                <div class="city">
                    <strong><?php echo $value['origin_city']?></strong>
                    <br>
                    <span><?php echo get_flight_time($value['departure_time'])?></span>
                </div>
                <div class="path flights">
                    <?php
                        $trip_time = calculate_flight_time($value['departure_time'], $value['arrival_time']);
                    ?>
                    <span class="duration">Non-Stop <?php echo $trip_time?></span>
                    <div class="line"><i class="fa-solid fa-plane"></i></div>
                </div>
                <div class="city">
                    <strong><?php echo $value['destination_city']?></strong>
                    <br>
                    <span><?php echo get_flight_time($value['arrival_time'])?></span>
                </div>
            </div>
        </div>
    </div>
</label>