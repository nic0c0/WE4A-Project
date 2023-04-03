<?php

    class user{

        private $name;
        private $password;

        public function __construct($name, $password){
                $this->name=$name;
                $this->password=$password;
            }

        public function setPass($password){
                $this->password=$password;
        }

        public function setName($name){
            $this->name=$name;
        }


        public function getPass(){
            return $this->password;
        }

        public function getName(){
            return $this->name;
        }

        public function show(){
            echo "$this->name $this->password";
        }


         
    }

?>