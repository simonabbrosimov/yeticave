<?php

require_once('helpers.php');
require_once('init.php');
require_once('functions.php');
require_once('data.php');

$sql = "SELECT id, symbol_code, title FROM categories";
$categories = db_get_rows($con, $sql);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if($id){
	$sql = "SELECT lots.id, lots.title, lots.price, lots.image, lots.expire_date
FROM lots JOIN categories ON lots.category_id=? 
WHERE lots.expire_date > now()";
	
}
else {
	http_response_code(404);
	print("Error: ");
	print(http_response_code());
	die();
}

$goods = db_get_data($con, $sql, [$id]);
	
$page_content = include_template('category_main.php', [
	'categories' => $categories,
	'goods' => $goods
]);

$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'user_name' => $user_name,
	'title' => 'Главная'
]);

print($layout_content);




	   
