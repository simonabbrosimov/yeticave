<?php

require_once('helpers.php');
require_once('init.php');
require_once('functions.php');
require_once('data.php');



$sql = "SELECT title, symbol_code FROM categories";
$categories = db_get_rows($con, $sql);
	
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if($id){
	$sql = "SELECT lots.id, lots.title AS lots_title, lots.description, lots.image, lots.price, lots.expire_date, categories.title AS category_title FROM lots JOIN categories ON categories.id=lots.category_id WHERE lots.id=?";
	
}
else {
	http_response_code(404);
	print("Error: ");
	print(http_response_code());
	die();
}

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$lot = mysqli_fetch_assoc($res);

if(!$lot){
	http_response_code(404);
	print("Error: ");
	print(http_response_code());
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
	'title' => 'Главная'
]);

print($layout_content);


