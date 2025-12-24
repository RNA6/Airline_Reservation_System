<?php
    function execute_query($query, $connection){
        return mysqli_query($connection, $query);
    }
    function get_flights_by_cities($connection, $departure_city, $arrival_city, $date){
        $min_date = new DateTime($date);
        $max_date = new DateTime($date);
        $max_date->modify('+1 day');
        $result = execute_query("SELECT `flight_number`, `origin`, `co`.`name` AS `origin_name`,
        `destination`, `cd`.`name` AS `destenation_name`, `departure_time`, `arrival_time`
        FROM `flights` `f`
        INNER JOIN `cities` `co` ON f.origin = co.short_name
        INNER JOIN `cities` `cd` ON f.destination = cd.short_name
        WHERE f.origin = '$departure_city'
        AND f.destination = '$arrival_city'
        AND f.departure_time BETWEEN '" . $min_date->format('Y-m-d 00:00:00') . "'
                           AND '" . $max_date->format('Y-m-d 00:00:00') . "'", $connection);
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

    function get_user_details($connection, $passport){
        $result = execute_query("SELECT * FROM `passenger` WHERE `passport` = '$passport'", $connection);
       
        $row = mysqli_fetch_assoc($result);
        $user = new passenger($row['title'],$row['first_name'],
        $row['last_name'],$row['nationality'],
        $row['passport'],$row['birth_date'],
        $row['age_group']);

        return $user;
    }

    function get_user_contact_details($connection, $passport){
        $result = execute_query("SELECT email, phone_number FROM user u JOIN passenger p ON p.passport = u.passport WHERE p.passport ='$passport'", $connection);
       
        $row = mysqli_fetch_assoc($result);
        $user_contact_detalis = [$row['email'], $row['phone_number']];

        return $user_contact_detalis;
    }

    function insert_ticket($connection, $flight_number, ){

    }

?>