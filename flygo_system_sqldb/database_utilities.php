<?php
    function execute_query($query, $connection){
        return mysqli_query($connection, $query);
    }
    function get_flights_by_cities($connection, $departure_city, $arrival_city, $date){
        $min_date = new DateTime($date);
        $max_date = new DateTime($date);
        $max_date->modify('+1 day');
        $result = execute_query(
            "SELECT `flight_number`, `origin`, `co`.`name` AS `origin_name`,
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
        $result = execute_query(
            "SELECT *
                    FROM `flights`
                    WHERE `flight_number` = '$flight_number';", $connection);
       
       $row = mysqli_fetch_assoc($result);
       $departure_flight = array(
            'flight_number'=>$row['flight_number'],            
            'origin_city_name'=>$row['origin'],
            'destination_city_name'=>$row['destination'],
            'origin_city'=>$row['origin'],
            'destination_city'=>$row['destination'],
            'departure_time'=> $row['departure_time'],
            'arrival_time'=>$row['arrival_time']);

        return $departure_flight;
    }

    function get_user_details($connection, $passport){
        $result = execute_query(
            "SELECT * 
                    FROM `passenger` 
                    WHERE `passport` = '$passport'", $connection);
       
        $row = mysqli_fetch_assoc($result);
        $user = new passenger($row['title'],$row['first_name'],
        $row['last_name'],$row['nationality'],
        $row['passport'],$row['birth_date'],
        $row['age_group']);

        return $user;
    }

    function get_user_contact_details($connection, $passport){
        $result = execute_query(
            "SELECT email, phone_number 
                    FROM user u
                    JOIN passenger p ON p.passport = u.passport
                    WHERE p.passport ='$passport'", $connection);
       
        $row = mysqli_fetch_assoc($result);
        $user_contact_detalis = [$row['email'], $row['phone_number']];

        return $user_contact_detalis;
    }

    function insert_all($connection){

        insert_ticket($connection, $_SESSION['booking']['departure_flight_number']);
        
        for($i=0; $i <$_SESSION['booking']['total_passengers']; $i++){
            $p = $_SESSION['booking']['passengers'][$i];
            if(!isset($_SESSION['passport']) || $i != 0){
                insert_passenger($connection, $p);
            }
            insert_extras($connection, $p->getPassport(), $i);
        }
        if(isset($_SESSION['booking']['arrival_flight_number'])){
            insert_ticket($connection, $_SESSION['booking']['arrival_flight_number']);
            for($i=0; $i <$_SESSION['booking']['total_passengers']; $i++){
                $p = $_SESSION['booking']['passengers'][$i];
                insert_extras($connection, $p->getPassport, $i);
            }
        }
        $_SESSION['booking'] = [];
    }

    function insert_passenger($connection, $p){
        $title        = $p->getTitle();
        $firstName    = $p->getFirst_name();
        $lastName     = $p->getLast_name();
        $nationality  = $p->getNationality();
        $passport     = $p->getPassport();
        $birthDate    = $p->getBirth_date();
        $ageGroup     = $p->getAge_group();
        
        $result = execute_query(
            "INSERT INTO `passenger`
            (`title`, `first_name`, `last_name`,
            `nationality`, `passport`, `birth_date`,
            `age_group`) 
            VALUES ('$title','$firstName','$lastName',
            '$nationality','$passport','$birthDate',
            '$ageGroup')", $connection);
        if(!$result){
            echo 'error';
        }
    }

    function insert_ticket($connection, $flight_number){
        $row = (int) substr($_SESSION['booking']['seats'][0], 0, -1);
        $class = ($row <= 4) ? 'Business' : 'Economy';
        
        $adults_number = $_SESSION['booking']['adults_number'];
        $children_number = !empty($_SESSION['booking']['children_number']) ? $_SESSION['booking']['children_number']: 0;
        $infants_number = !empty($_SESSION['booking']['infants_number']) ? $_SESSION['booking']['infants_number']: 0;
        foreach($_SESSION['booking']['seats'] as $s){
            $row = (int) substr($s, 0, -1);
            $temp_class = ($row <= 4) ? 'Business' : 'Economy';
            if($temp_class != $class){
                $class = "Mixed";
                break;
            }            
        }
        $sql = "INSERT INTO `ticket`
            (`flight_number`, `travel_class`, `adults_number`,
              `children_number`, `infants_number`)
               VALUES ('$flight_number', '$class',$adults_number,
               $children_number,$infants_number)";
        $result = execute_query($sql, $connection);
            
        if(!$result){
            echo 'error';
        }
    }
    function insert_extras($connection, $passport, $index){

        $result = execute_query("SELECT ticket_number FROM ticket ORDER BY ticket_number DESC LIMIT 1;", $connection);
        $row = mysqli_fetch_assoc($result);
        $ticket_number = $row['ticket_number'];
        $seat = $_SESSION['booking']['seats'][$index];
        $small_bags = $_SESSION['booking']['extras'.($index+1)][0];
        $medium_bags = $_SESSION['booking']['extras'.($index+1)][1];
        $large_bags = $_SESSION['booking']['extras'.($index+1)][2];
        $meal = $_SESSION['booking']['extras'.($index+1)][3];
        $result = execute_query(
            "INSERT INTO `extra`
            (`ticket_number`, `passport`, `seat`,
            `small_bags`, `medium_bags`, `large_bags`,
            `meal`) 
            VALUES ($ticket_number,'$passport','$seat',
            $small_bags,$medium_bags,$large_bags,
            '$meal')", $connection);
        if(!$result){
            echo 'error';
        }
    }

?>