<?php

    class passenger{
        private $title;
        private $first_name;
        private $last_name;
        private $nationality;
        private $passport;
        private $birth_date;
        private $age_group;
        
        public function __construct($title, $first_name, $last_name,
        $nationality, $passport, $birth_date, $age_group){
            $this->title = $title; 
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->nationality = $nationality;
            $this->passport = $passport;
            $this->birth_date = $birth_date;
            $this->age_group = $age_group;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getFirst_name(){
            return $this->first_name;
        }
        public function getLast_name(){
            return $this->last_name;
        }
        public function getNationality(){
            return $this->nationality;
        }
        public function getPassport(){
            return $this->passport;
        }
        public function getBirth_date(){
            return $this->birth_date;
        }
        public function getAge_group(){
            return $this->age_group;
        }
    }
?>