CREATE DATABASE yeticave
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE yeticave;	

CREATE TABLE categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title CHAR(255),
	symbol_code CHAR(255)

);

CREATE TABLE lots (
	id INT AUTO_INCREMENT PRIMARY KEY,
	create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	title CHAR (255),
	description TEXT,
	image CHAR (255),
	price INT,
	expire_date DATE,
	step INT,
	user_id INT,
	winner_id INT,
	category_id INT

);

CREATE TABLE bets (
	id INT AUTO_INCREMENT PRIMARY KEY,
	bet_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	price INT,
	user_id INT,
	lot_id INT

);

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	registration_date DATETIME  DEFAULT CURRENT_TIMESTAMP,
	user_email CHAR(255) NOT NULL UNIQUE,
	user_name CHAR(255),
	password CHAR(12),
	contact TEXT,
	lot_id INT,
	bet_id INT
	
);

ALTER TABLE lots ADD FULLTEXT(title, description);