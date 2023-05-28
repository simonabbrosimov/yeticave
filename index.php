<?php

require_once('helpers.php');
require_once('init.php');
require_once('functions.php');

$is_auth = rand(0, 1);
$user_name = 'Simom';



if(!$con){
    print('Connection error: ' . mysqli_connect_error());
}
else {

    $sql = "SELECT lots.id, lots.title, lots.price, lots.image, lots.expire_date
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
    'categories' => $categories,
    'user_name' => $user_name,
    'is_auth' => $is_auth,
    'title' => 'Главная'

]);

print($layout_content);

?>


       
