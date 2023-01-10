<?php

include_once 'DB.class.php';

    class User {
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;

        public function __construct($firstname, $lastname, $email, $password) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
        }

        public function getName() {
            return $this->firstname . ' ' . $this->lastname;
        }

        public function getEmail() {
            return $this->email;
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