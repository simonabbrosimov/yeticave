<?php

require_once('helpers.php');
require_once('init.php');

$is_auth = rand(0, 1);
$user_name = 'Simom';

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

if(!$con){
    print('Connection error: ' . mysqli_connect_error());
}
else {

    $sql = "SELECT lots.title, lots.price, lots.image, lots.expire_date
    FROM lots JOIN categories ON lots.category_id=categories.id 
    WHERE lots.expire_date > now()";
    $res = mysqli_query($con, $sql);

    if(!$res){
        $error = mysqli_error($con);
        print('MYSQLI error '. $error);
    }
    else{
        $goods = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    
    $sql = "SELECT symbol_code, title FROM categories";
    $res = mysqli_query($con, $sql);

    if(!$res){
        $error = mysqli_error($con);
        print('MYSQLI error '. $error);
    }
    else{
        $categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    
};

$page_content = include_template('main.php', [
    'categories' => $categories,
    'goods' => $goods

]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'title' => $title

]);

print($layout_content);

?>


       
