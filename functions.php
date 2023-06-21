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

function validate_category($id, $allowed_list) {
    if (!in_array ($id, $allowed_list)) {
        return "Указана несуществующая категория";
    }

    return null;
};

function validate_length($value, $min, $max) {
    if ($value) {
        $len = strlen($value);
        if ($len < $min or $len > $max) {
            return "Значение должно быть от $min до $max символов";
        }
    }

    return null;
};

function validate_number($value, $min){
    $value = intval($value);
    if (is_int($value) && $value > $min) {
        return null;
    }

     return "Значение должно быть целым числом больше $min";
};

function validate_date($value){
  if(date('Y-m-d', strtotime($value)) === $value){
    $now_date = strtotime("now");
    $end_date = strtotime($value);
    $days_count = (floor(($end_date - $now_date)/60/60/24));
    if($days_count >= 1){
    echo $days_count;
    return null;
    }
    else{
       return "Введенная дата должна быть больше текущей";
    }
    }
  else{
    return "Введенная дата должна быть в формате ГГГГ-ММ-ДД";
  }
};

