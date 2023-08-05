<?php

require_once('helpers.php');
require_once('init.php');
require_once('functions.php');
require_once('data.php');

$sql = "SELECT symbol_code, title FROM categories";
$categories = db_get_rows($con, $sql);

$search = $_GET['search'] ?? '';

if($search){
	$sql = "SELECT lots.id, lots.title, lots.price, lots.image, lots.expire_date
	FROM lots JOIN categories ON lots.category_id=categories.id 
	WHERE  MATCH (lots.title, lots.description) AGAINST (?) AND lots.expire_date > now()";

	$stmt = db_get_prepare_stmt($con, $sql, [$search]);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$goods = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$page_content = include_template('search_main.php', [
	'categories' => $categories,
	'goods' => $goods, 
	'search' => $search

]);

} 
else {
	$page_content = include_template('search_main.php', [
	'categories' => $categories

]);
}

$layout_content = include_template('search_layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'Поиск'

]);

print($layout_content);

?>


	   
