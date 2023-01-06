<?php

    // get the difference between two dates
    // takes 2 dates as params, returns the difference as a number
    function dateDifference($date1, $date2) {
        $dateDifferenceAmount = date_diff(date_create($date1), date_create($date2));
        return $dateDifferenceAmount->format("%a");
    }