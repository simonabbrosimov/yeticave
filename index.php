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
        "image" => "img/lot-1.jpg"

    ],

    [
        "title" => "DC Ply Mens 2016/2017 Snowboard",
        "category" => $categories["boards"],
        "price" => 159999,
        "image" => "img/lot-2.jpg"

    ],

    [
        "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "category" => $categories["attachment"],
        "price" => 8000,
        "image" => "img/lot-3.jpg"

    ],

    [
        "title" => "Ботинки для сноуборда DC Mutiny Charocal",
        "category" => $categories["boots"],
        "price" => 10999,
        "image" => "img/lot-4.jpg"

    ],

    [
        "title" => "Куртка для сноуборда DC Mutiny Charocal",
        "category" => $categories["clothing"],
        "price" => 7500,
        "image" => "img/lot-5.jpg"

    ],

    [
        "title" => "Маска Oakley Canopy",
        "category" => $categories["other"],
        "price" => 5400,
        "image" => "img/lot-6.jpg"

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


       
