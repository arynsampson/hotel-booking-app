<?php

    // Validate user date input
    function validateDates($date1, $date2) {

        $hotel_dates = array(
            ['check-in' => '', 'check-out' => '']
        );

        if(empty($date1) | empty($date2)) {
            $hotel_dates[1][0] = 'Please enter both dates.';
        } else {
            $hotel_dates[1][0] = '';
            if(date("Y-m-d") > $date1) {
                $hotel_dates[1][1] = 'Check-in date cannot be before today.';
            } else {
                if($date1 > $date2) {
                    $hotel_dates[1][2] = 'Check-out date should be after check-in date.';
                } else {
                    if(!$hotel_dates[1]) {
                        $hotel_dates[0]['check-in'] = $date1;
                        $hotel_dates[0]['check-out'] = $date2;
                    }
                }
            }
        }
        
        return $hotel_dates;
    }