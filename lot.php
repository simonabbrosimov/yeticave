<?php

require_once('helpers.php');
require_once('init.php');
require_once('functions.php');

$is_auth = rand(0, 1);
$user_name = 'Simom';

if(!$con){
	print("Connection error: " . mysqli_connect_error());
}
else{
	$sql = "SELECT title, symbol_code FROM categories";
	$res = mysqli_query($con, $sql);

	if(!$res){
		print("MYSQLI error: " . mysqli_error($con));
	}
	else {
		$categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
	}

}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if($id){
	$sql = "SELECT lots.id, lots.title AS lots_title, lots.description, lots.image, lots.price, lots.expire_date, categories.title AS category_title FROM lots JOIN categories ON categories.id=lots.category_id WHERE lots.id=" . $id;
}
else {
	http_response_code(404);
	die();
}

$res = mysqli_query($con, $sql);

if($res){
	$lot = mysqli_fetch_assoc($res);
}
else{
	print("MYSQLI error: " . mysqli_error($con));
}

if(!$lot){
	http_response_code(404);
	die();
}




$page_content = include_template('lot_main.php', [
    'categories' => $categories,
    'lot' => $lot

]);

$layout_content = include_template('lot_layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'user_name' => $user_name,
    'is_auth' => $is_auth,
    'title' => 'Главная'
]);

print($layout_content);


?>