<?php
    function execute_query($query, $connection){
        return mysqli_query($connection, $query);
    }
    function get_flights_by_cities($connection, $departure_city, $arrival_city){
        $result = execute_query("SELECT `flight_number`, `origin`, `co`.`name` AS `origin_name`,
         `destination`, `cd`.`name` AS `destenation_name`, `departure_time`, `arrival_time`
          FROM (`flights` `f` INNER JOIN `cities` `co`
           ON '$departure_city' = `co`.`short_name`)
            INNER JOIN `cities` `cd`
             ON '$arrival_city' = `cd`.`short_name`
             WHERE `origin` = '$departure_city' AND `destination` = '$arrival_city';", $connection);
        $counter = 0;

        while($row = mysqli_fetch_assoc($result)){
            $flights[$counter++] = array(
            'flight_number'=>$row['flight_number'],            
            'origin_city_name'=>$row['origin_name'],
            'destination_city_name'=>$row['destenation_name'],
            'origin_city'=>$row['origin'],
            'destination_city'=>$row['destination'],
            'departure_time'=> $row['departure_time'],
            'arrival_time'=>$row['arrival_time']);
        }
        return $flights;
    }

    function get_flight_by_flight_number($connection, $flight_number){
        $result = execute_query("SELECT `flight_number`, `origin`,`destination`
          FROM `flights` WHERE `flight_number` = '$flight_number';", $connection);
       
       $row = mysqli_fetch_assoc($result);
       $departure_flight = array(
            'flight_number'=>$row['flight_number'],        
            'origin_city'=>$row['origin'],
            'destination_city'=>$row['destination']);

        return $departure_flight;
    }

    function insert_ticket($connection, $flight_number, ){

    }

?>