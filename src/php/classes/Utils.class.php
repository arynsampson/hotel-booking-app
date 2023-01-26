<?php

    require_once 'DB.class.php';

    class Utils extends DB {
        
        // get the difference between two dates
        public function dateDifference($date1, $date2) {
            $dateDifferenceAmount = date_diff(date_create($date1), date_create($date2));
            return $dateDifferenceAmount->format("%a");
        }

        // calculate the total cost of the user stay
        public function totalStayCost($numOfDays, $dailyRate) {
            return $numOfDays * $dailyRate;
        }

        // Validate user date input
        public function validateDates($date1, $date2) {
            $hotelDates = array(
                ['check-in' => '', 'check-out' => '']
            );
            if(empty($date1) | empty($date2)) {
                $hotelDates[1][0] = 'Please enter both dates.';
            } else {
                $hotelDates[1][0] = '';
                if(date("Y-m-d") > $date1) {
                    $hotelDates[1][1] = 'Check-in date cannot be before today.';
                } else {
                    $hotelDates[1][1] = '';
                    if($date1 > $date2) {
                        $hotelDates[1][2] = 'Check-out date should be after check-in date.';
                    } else {
                        $hotelDates[1][2] = '';
                        if(!$hotelDates[1]) {
                            $hotelDates[0]['check-in'] = $date1;
                            $hotelDates[0]['check-out'] = $date2;

                        }
                    }
                }
            }
            return $hotelDates;
        }

        // validate user email
        public function validateEmail($email) {
            if(strlen($email) < 2) {
                return array(
                    'email' => $email, 
                    'error' => 'Cannot be less than 2 characters.'
                );
            } else {
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                return $email;
            }
        }

        // validate user password
        public function validatePassword($password) {
            if(strlen($password) < 5) {
                return array(
                    'password' => '', 
                    'error' => 'Cannot be less than 5 characters.'
                );
            } else {
                return $password;
            }
        }

        // validate user firstname input
        public function validateFirstname($input) {
            if(strlen($input) < 2) {
              return array(
                "firstname" => $input,
                "error" => "Cannot be less than 2 characters."
              );
            } else {
              $input = trim($input);
              $input = stripslashes($input);
              $input = htmlspecialchars($input);
              return $input;
            }
        }

        // validate user lastname input
        public function validateLastname($input) {
            if(strlen($input) < 2) {
              return array(
                "lastname" => $input,
                "error" => "Cannot be less than 2 characters."
              );
            } else {
              $input = trim($input);
              $input = stripslashes($input);
              $input = htmlspecialchars($input);
              return $input;
            }
        }

        // check if user exists in db
        public function checkUserExists($email) {
            $db = new DB;

            $sql = "SELECT * FROM user WHERE user.email = '$email'";
            $result = $db->conn->query($sql);

            if($result->num_rows < 1) {
                return false;
            } else {
                return true;
            }
        }
        
    }
    
?>