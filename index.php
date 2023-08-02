<?php

require_once('helpers.php');
require_once('init.php');
require_once('functions.php');



$sql = "SELECT lots.id, lots.title, lots.price, lots.image, lots.expire_date
FROM lots JOIN categories ON lots.category_id=categories.id 
WHERE lots.expire_date > now()";
$goods = db_get_rows($con, $sql);
	
$sql = "SELECT symbol_code, title FROM categories";
$categories = db_get_rows($con, $sql);

$page_content = include_template('main.php', [
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

?>


	   
