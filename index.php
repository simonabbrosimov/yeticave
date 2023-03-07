<?php

require_once('helpers.php');

$is_auth = rand(0, 1);

$user_name = 'Simom'; // укажите здесь ваше имя




$categories = [
    "boards" => "Доски и лыжи",
    "attachment" => "Крепления",
    "boots" => "Ботинки",
    "clothing" => "Одежда",
    "tools" => "Инстументы",
    "other" => "Разное"

];

$goods = [

    [
        "title" => "2014 Rossignol District Snowboard",
        "category" => $categories["boards"],
        "price" => 10999,
        "image" => "img/lot-1.jpg",
        "expire_date" => '2023-04-01'

    ],

    [
        "title" => "DC Ply Mens 2016/2017 Snowboard",
        "category" => $categories["boards"],
        "price" => 159999,
        "image" => "img/lot-2.jpg",
        "expire_date" => '2023-05-13'

    ],

    [
        "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "category" => $categories["attachment"],
        "price" => 8000,
        "image" => "img/lot-3.jpg",
        "expire_date" => '2023-05-07'

    ],

    [
        "title" => "Ботинки для сноуборда DC Mutiny Charocal",
        "category" => $categories["boots"],
        "price" => 10999,
        "image" => "img/lot-4.jpg",
        "expire_date" => '2023-04-01'

    ],

    [
        "title" => "Куртка для сноуборда DC Mutiny Charocal",
        "category" => $categories["clothing"],
        "price" => 7500,
        "image" => "img/lot-5.jpg",
        "expire_date" => '2023-04-22'

    ],

    [
        "title" => "Маска Oakley Canopy",
        "category" => $categories["other"],
        "price" => 5400,
        "image" => "img/lot-6.jpg",
        "expire_date" => '2023-03-25'

    ]


];

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
    $now_date = date_create();
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


       
