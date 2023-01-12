<?php

include_once 'DB.class.php';

    class User {
        private $id;
        private $firstname;
        private $lastname;
        private $email;

        public function __construct($id, $firstname, $lastname, $email) {
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
        }

        public function getID() {
            return $this->id;
        }

        public function setID($id) {
            $this->id = $id;
        }

        public function getFirstName() {
            return $this->firstname;
        }

        public function getLastName() {
            return $this->lastname;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setFirstName($firstname) {
            $this->firstname = $firstname;
        }

        public function setLastName($lastname) {
            $this->lastname = $lastname;
        }

        public function setEmail($email) {
            $this->email = $email;
        }
    }
    
?>