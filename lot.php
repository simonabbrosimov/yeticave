<?php

require_once('helpers.php');
require_once('init.php');
require_once('functions.php');
require_once('data.php');

$sql = "SELECT id, title, symbol_code FROM categories";
$categories = db_get_rows($con, $sql);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if($id){
	$sql = "SELECT lots.id, lots.title AS lots_title, lots.description, lots.image, lots.price, lots.expire_date, lots.step, categories.title AS category_title FROM lots JOIN categories ON categories.id=lots.category_id WHERE lots.id=?";
	
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

$history = get_bets_history($con, $id);
$current_price = max($lot["price"], $history[0]["price"]);
$min_bet = $current_price + $lot["step"];

$page_content = include_template('lot_main.php', [
	'categories' => $categories,
	'lot' => $lot,
	'current_price' => $current_price,
	'min_bet' => $min_bet,
	'id' => $id,
	'history' => $history

]);

if($_SERVER['REQUEST_METHOD']== 'POST'){
	$bet = filter_input(INPUT_POST, "cost", FILTER_VALIDATE_INT);

	if ($bet < $min_bet) {
		$error = "Ставка не может быть меньше $min_bet";
	}
	if (empty($bet)) {
		$error = "Ставка должна быть целым числом, болше ноля";
	}

	
	if(($error)){
		$page_content = include_template('lot_main.php', [
			'categories' => $categories,
			'error' => $error,
			'lot' => $lot,
			'current_price' => $current_price,
			'min_bet' => $min_bet,
			'id' => $id,
			'history' => $history

		]);
	} 
	else {
		
		$sql = "INSERT INTO bets (price, user_id, lot_id) VALUES (?, ?, ?);";
		$stmt = db_get_prepare_stmt($con, $sql, [$bet, $_SESSION['id'], $id]);
		$res = mysqli_stmt_execute($stmt);
		
		header("Location:lot.php?id=" . $id);

	} 
   
}

$layout_content = include_template('lot_layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'user_name' => $user_name,
	'title' => $lot['title']
]);

print($layout_content);


