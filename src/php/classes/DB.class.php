<?php

    class DB {
        private $server = 'localhost';
        private $username = 'admin';
        private $password = 'password1234';
        private $db = 'hotel';
        public $conn;

        public function __construct() {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        }

        public function getConn() {
            return $this->conn;
        }
    }