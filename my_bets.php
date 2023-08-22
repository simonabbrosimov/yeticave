<?php
require_once('helpers.php');
require_once('init.php');
require_once('functions.php');
require_once('data.php');

$sql = "SELECT id, title, symbol_code FROM categories";
$categories = db_get_rows($con, $sql);

$sql = "SELECT lots.id, lots.image, lots.title, lots.expire_date, categories.title AS category, categories.symbol_code, bets.price, DATE_FORMAT(bets.bet_date, '%d.%m.%y %H:%i') AS dat FROM lots JOIN categories ON lots.category_id=categories.id JOIN bets ON bets.lot_id=lots.id WHERE bets.user_id=?;";
$user_bets = db_get_data($con, $sql, [$author_id]);

$page_content = include_template('my-bets_main.php', [
	'categories' => $categories,
	'user_bets' => $user_bets
]);

$layout_content = include_template('my-bets_layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'user_name' => $user_name,
	'title' => 'Мои ставки'
]);

print($layout_content);