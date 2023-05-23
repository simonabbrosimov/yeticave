CREATE DATABASE yeticave
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE yeticave;	

CREATE TABLE categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title CHAR(255),
	symbol_code CHAR(255)


);

CR\EATE TABLE lots (
	id INT AUTO_INCREMENT PRIMARY KEY,
	create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	lot_name CHAR (255)
	description TEXT,
	image CHAR (255),
	initial_price INT,
	end_date DATE,
	step INT,
	user_id INT,
	winner_id INT,
	category_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (winner_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)



);

CREATE TABLE bets (
	id INT AUTO_INCREMENT PRIMARY KEY,
	bet_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	price INT,
	user_id INT,
	lot_id INT,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY  (lot_id) REFERENCES lots(id)


);


CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	registration_date DATETIME  DEFAULT CURRENT_TIMESTAMP,
	user_email CHAR(255) NOT NULL UNIQUE,
	user_name CHAR(255),
	password CHAR(12),
	contact TEXT,
	lot_id INT,
	bet_id INT,
	FOREIGN KEY (lot_id) REFERENCES lots(id),
	FOREIGN KEY (bet_id) REFERENCES bets(id)






);