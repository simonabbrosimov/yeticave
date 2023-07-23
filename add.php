<?php
require_once('helpers.php');
require_once('init.php');
require_once('functions.php');

$user_name = 'Simom';

$sql = "SELECT id, title, symbol_code FROM categories";
$res = mysqli_query($con, $sql);
$categories = mysqli_fetch_all($res, MYSQLI_ASSOC);
$categories_id = array_column($categories, 'id');

$page_content = include_template('add-lot_main.php', [
	'categories' => $categories

]);

if($_SERVER['REQUEST_METHOD']== 'POST'){
	$require_fields = ["lot-name", "category", "message",  "lot-rate", "lot-step", "lot-date"];
	$errors = [];

	$rules = [

		"category" => function($value)use ($categories_id){
			return validate_category($value, $categories_id);
		},
		"lot-name" => function($value){
			return validate_length($value, 10, 200);
		},
		"message" => function($value){
			return validate_length($value,10, 3000);
		},
		"lot-rate" => function($value){
			return validate_number($value,0);
		},
		"lot-step" => function($value){
			return validate_number($value,0);
		},
		"lot-date" => function($value){
			return validate_date($value);
		}

	];

	$new_lot = filter_input_array(INPUT_POST, ["lot-name" => FILTER_DEFAULT, "category" => FILTER_DEFAULT, "message" => FILTER_DEFAULT, "lot-rate" => FILTER_DEFAULT, "lot-step" => FILTER_DEFAULT, "lot-date" => FILTER_DEFAULT], true);

	foreach($new_lot as $key => $value){
		if(isset($rules[$key])){
			$rule = $rules[$key];
			$errors[$key] = $rule($value);
		}

		if(in_array($key, $require_fields) && empty($value)){
			$errors[$key] = "Поле надо заполнить";
		}
	}
	
	$errors = array_filter($errors);

	if(!empty($_FILES['lot-img']['name'])){
		$tmp_name = $_FILES['lot-img']['tmp_name'];
		$path = $_FILES['lot-img']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);

		if ($file_type == "image/png") {
			$filename = uniqid() . '.png';
			move_uploaded_file($tmp_name, 'uploads/' . $filename);
			$new_lot['lot-img'] = 'uploads/' . $filename;
		}
		if ($file_type = "image/jpeg") {
			$filename = uniqid() . '.jpeg';
			move_uploaded_file($tmp_name, 'uploads/' . $filename);
			$new_lot['lot-img'] = 'uploads/' . $filename;
		}

		else {
			$errors['lot-img'] = "Допустимые форматы: jpg, jpeg, png";
		}
	}
	else {
		  $errors["lot_img"] = "Вы не загрузили изображение";
	}
				
	if(count($errors)){
		$page_content = include_template('add-lot_main.php', [
			'categories' => $categories,
			'errors' => $errors,
			'new_lot' => $new_lot

		]);
	} 
	else {
		
		$sql = "INSERT INTO lots (title, category_id, description, price, step, expire_date, image, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, 1);";
		$stmt = db_get_prepare_stmt($con, $sql, $new_lot);
		$res = mysqli_stmt_execute($stmt);
		$lot_id = mysqli_insert_id($con);
		header("Location:lot.php?id=" . $lot_id);
		
	} 

}

else {

	$page_content = include_template('add-lot_main.php', [
	'categories' => $categories   
]);

}

$layout_content = include_template('add-lot_layout.php', [
	'content' => $page_content,
	'categories' => $categories,
	'user_name' => $user_name,
	'title' => 'Добавление лота'
]);

print($layout_content);