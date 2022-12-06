<?php

    class User {
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $role;

        public function __construct($firstname, $lastname, $email, $password, $role) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }

        public function getName() {
            echo $this->firstname . $this->lastname;
        }

        public function getEmail() {
            echo $this->email;
        }

        public function setFirstname($firstname) {
            $this->firstname = $firstname;
        }

        public function setLastname($lastname) {
            $this->lastname = $lastname;
        }

        public function setEmail($email) {
            $this->email = $email;
        }
    }
    
?>