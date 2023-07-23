<?php
require_once('helpers.php');
require_once('init.php');
require_once('functions.php');



$sql = "SELECT id, title, symbol_code FROM categories";
$res = mysqli_query($con, $sql);
$categories = mysqli_fetch_all($res, MYSQLI_ASSOC);

$sql = "SELECT user_email, user_name FROM users";
$res = mysqli_query($con, $sql);
$users = mysqli_fetch_all($res, MYSQLI_ASSOC);
$emails = array_column($users, 'user_email');


$page_content = include_template('reg_main.php', [
	'categories' => $categories
]);

if($_SERVER['REQUEST_METHOD']== 'POST'){
	$require_fields = ["email", "password", "name", "message"];
	$errors = [];

	$rules = [

		"email" => function($value)use ($emails){
			return validate_email($value, $emails);
		},
		"password" => function($value){
			return validate_length($value, 6, 12);
		},
		"message" => function($value){
			return validate_length($value,10, 3000);
		},
		"name" => function($value){
			return validate_length($value,1, 50);
		}

	];

	$new_user = filter_input_array(INPUT_POST, ["email" => FILTER_DEFAULT, "password" => FILTER_DEFAULT, "name" => FILTER_DEFAULT, "message" => FILTER_DEFAULT], true);

	foreach($new_user as $key => $value){
		if(isset($rules[$key])){
			$rule = $rules[$key];
			$errors[$key] = $rule($value);
		}

		if(in_array($key, $require_fields) && empty($value)){
			$errors[$key] = "Поле надо заполнить";
		}
	}
	
	$errors = array_filter($errors);
	
	if(count($errors)){
		$page_content = include_template('reg_main.php', [
			'categories' => $categories,
			'errors' => $errors,
			'new_user' => $new_user

		]);
	} 
	else {
		$new_user['password'] = password_hash($new_user['password'], PASSWORD_DEFAULT);

		$sql = "INSERT INTO users (user_email, password, user_name, contact) VALUES (?, ?, ?, ?);";
		$stmt = db_get_prepare_stmt($con, $sql, $new_user);
		$res = mysqli_stmt_execute($stmt);
		header("Location: pages/login.html");
		
	} 

}

else {

	$page_content = include_template('reg_main.php', [
	'categories' => $categories 
]);

}

$layout_content = include_template('reg_layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'title' => 'Регистрация'
]);

print($layout_content);