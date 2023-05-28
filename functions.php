<?php
function format_number($initial_number) {
    $number = ceil($initial_number);

    if ($number < 1000) {
        $result = $number;

    }else {
        $result = number_format($number, 0, " ", " "); 
    }

    return $result ." ₽";

};

function get_remaining_time($date){

    $end_date = date_create($date);
    $now_date = date_create("now");
    $date_diff = date_diff($end_date, $now_date);
    $hours_count = date_interval_format($date_diff, "%d-%H-%I");
    $hours_count_arr = explode("-", $hours_count);
    
    $hours = $hours_count_arr[0] * 24 + $hours_count_arr[1];
    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes = intval($hours_count_arr[2]);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

    $result[] = $hours;
    $result[] = $minutes;

    return $result;
};
?>