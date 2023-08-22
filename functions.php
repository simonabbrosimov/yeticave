<?php
function format_number($initial_number) {
	$number = ceil($initial_number);

	if ($number < 1000) {
		$result = $number;

	}else {
		$result = number_format($number, 0, " ", " "); 
	}

	return $result ." ₽";

};

function get_remaining_time($date){

	$end_date = date_create($date);
	$now_date = date_create("now");
	$date_diff = date_diff($end_date, $now_date);
	$hours_count = date_interval_format($date_diff, "%d-%H-%I");
	$hours_count_arr = explode("-", $hours_count);
	
	$hours = $hours_count_arr[0] * 24 + $hours_count_arr[1];
	$hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
	$minutes = intval($hours_count_arr[2]);
	$minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

	$result[] = $hours;
	$result[] = $minutes;

	return $result;
};

function validate_category($id, $allowed_list) {
	if (!in_array ($id, $allowed_list)) {
		return "Указана несуществующая категория";
	}

	return null;
};

function validate_length($value, $min, $max) {
	if ($value) {
		$len = strlen($value);
		if ($len < $min or $len > $max) {
			return "Значение должно быть от $min до $max символов";
		}
	}

	return null;
};

function validate_number($value, $min){
	$value = intval($value);
	if (is_int($value) && $value > $min) {
		return null;
	}

	 return "Значение должно быть целым числом больше $min";
};


function get_bets_history ($con, $id_lot) {
	$sql = "SELECT users.user_name, bets.price, DATE_FORMAT(bet_date, '%d.%m.%y %H:%i') AS bet_date
	FROM bets
	JOIN lots ON bets.lot_id=lots.id
	JOIN users ON bets.user_id=users.id
	WHERE lots.id=$id_lot
	ORDER BY bets.bet_date DESC LIMIT 10;";
	$result = mysqli_query($con, $sql);
	$list_bets = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
	return $list_bets;
	}
	



function validate_date($value){
	if(date('Y-m-d', strtotime($value)) === $value){
	$now_date = date('Y-m-d');
	$now_date = strtotime($now_date);
	$end_date = strtotime($value);
	if($now_date < $end_date){
		return null;
	}
	else{
		 return "Введенная дата должна быть больше текущей";
	}
	}
	else{
	return "Введенная дата должна быть в формате ГГГГ-ММ-ДД";
	}
};

function db_get_rows($con, $sql){
	$res = mysqli_query($con, $sql);
	return mysqli_fetch_all($res, MYSQLI_ASSOC); 
	};

function db_get_column($con, $sql, $column){
	$res = mysqli_query($con, $sql);
	$cat = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return array_column($cat, $column); 
	
};


function validate_email($value, $allowed_list) {
	$email = filter_var($value, FILTER_VALIDATE_EMAIL);
	if($email){
		if (in_array ($value, $allowed_list)) {
			return "Пользователь с данным e-mail уже зарегистрирован";
	}	
		else {
			return null;
		}

	}
	else {
		return "Введите правильный e-mail";
	}	
	
};

function check_email($value) {
	$email = filter_var($value, FILTER_VALIDATE_EMAIL);
	if(!$email){
		return "Введите правильный e-mail";
	}	
	else {
		return null;
	}
};

function get_data($con, $email) {
	$sql = "SELECT id, user_email, user_name, password FROM users WHERE user_email=?";
	$stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_bind_param($stmt, 's', $email);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$user_data = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;
	
	return $user_data;
};

function db_get_data($con, $sql, $data) {
	$stmt = db_get_prepare_stmt($con, $sql, $data);
	mysqli_stmt_execute($stmt);
	$res = mysqli_stmt_get_result($stmt);
	$user_data = $res ? mysqli_fetch_all($res, MYSQLI_ASSOC) : null;
	
	return $user_data;
};