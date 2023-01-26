<?php

    class Hotel {
        private $id;
        private $name;
        private $dailyRate;
        private $thumbnail;
        private $features;
        private $rating;
        private $address;

        public function __construct($id, $name, $dailyRate, $thumbnail, $features, $rating, $address) {
            $this->id = $id;
            $this->name = $name;
            $this->dailyRate = $dailyRate;
            $this->thumbnail = $thumbnail;
            $this->features = $features;
            $this->rating = $rating;
            $this->address = $address;
        }

        public function getID() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getDailyRate() {
            return $this->dailyRate;
        }

        public function getThumbnail() {
            return $this->thumbnail;
        }

        public function getFeatures() {
            return $this->features;
        }

        public function getRating() {
            return $this->rating;
        }

        public function getAddress() {
            return $this->address;
        }
    }