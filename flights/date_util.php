<?php
    
    function get_date_time($date_string){
        return new DateTime($date_string);
    }
    
    function get_flight_date($date_string){
        $date_time = get_date_time($date_string);
        $flight_date = $date_time->format("l d, F");
        return($flight_date);
    }

    function get_flight_time($date_string){
        $date_time = get_date_time($date_string);
        $flight_time = $date_time->format("H:i");
        return($flight_time);
    }

    function calculate_flight_time($date_string1, $date_string2){
        $date_time1 = get_date_time($date_string1);
        $date_time2 = get_date_time($date_string2);
        $date_interval = $date_time1->diff($date_time2);        
        $trip_time = $date_interval->h ."h " .$date_interval->i ."m";
        return $trip_time;
    }
?>