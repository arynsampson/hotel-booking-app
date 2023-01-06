<?php

    // Validate user date input
    function validateDates($date1, $date2) {

        if(empty($date1) | empty($date2)) {
            return 'Please enter both dates.';
        } else {
            if(date("Y-m-d") > $date1) {
                return 'Check-in date cannot be before today.';
            } else {
                if($date1 > $date2) {
                    return 'Check-in date should be before check-out date.';
                } else {
                    return array($date1, $date2);
                }
            }
        }
    }