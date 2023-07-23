# добавляю категории товаров 
INSERT INTO categories (title, symbol_code)
VALUES
	('Доски и лыжи', 'boards'),
	('Крепления', 'attachment'),
	('Ботинки', 'boots'),
	('Одежда', 'clothing'),
	('Инструменты', 'tools'),
	('Разное', 'other');

#добавляю пользователей
INSERT INTO users (user_email, user_name, password, contact)
VALUES
	('petya@mail.ru', 'petya', '12345TY8', 'г.Москва, Главпочтампт, до востребования'),  
	('vasiya@mail.ru', 'vasiya', 'oo345TY8', 'телефон 88008001000');

#добавляю объявления 
INSERT INTO lots (title, price, image, expire_date,step, category_id, user_id)
VALUES
	('2014 Rossignol District Snowboard', 10999, 'img/lot-1.jpg', '2023-04-01', 1000, 1, 2),
	('DC Ply Mens 2016/2017 Snowboard', 159999,  'img/lot-2.jpg', '2023-03-13', 1000, 1, 2),
	('Крепления Union Contact Pro 2015 года размер L/XL', 8000, 'img/lot-3.jpg','2023-05-07', 1000, 2, 2),
	('Ботинки для сноуборда DC Mutiny Charocal', 10900, 'img/lot-4.jpg', '2023-04-01', 1000, 3, 1),
	('Куртка для сноуборда DC Mutiny Charocal', 5000, 'img/lot-5.jpg', '2023-04-22', 1000, 4, 1),
	('Маска Oakley Canopy', 5000, 'img/lot-6.jpg', '2023-03-25', 1000, 6, 1);

#добавляю ставку
INSERT INTO bets (price, user_id, lot_id)
VALUES
	(6000, 2, 5),
	(11999, 1, 1);
	



#получаю все категории
SELECT title AS Категория FROM categories;

#получаю открытые лоты(но у меня их получаеться нет)
SELECT lots.title AS Название, 
	   lots.price AS "Стартовая цена", 
	   lots.image AS Ссылка, 
	   categories.title AS "Название категории" 
FROM lots JOIN categories ON lots.category_id=categories.id 
WHERE lots.create_date<lots.expire_date;

#показываю лот по id и название его категории
SELECT lots.id AS Идентификатор, 
		lots.create_date AS "Дата создания", 
		lots.title AS Название, 
		lots.price AS "Стартовая цена", 
		lots.image AS Ссылка, 
		lots.expire_date AS "Дата закрытия", 
		lots.step AS  Шаг, 
		categories.title AS "Название категории" 
		FROM lots JOIN categories ON lots.category_id=categories.id;

#обновляю название лота
UPDATE lots SET title= "Куртка для сноуборда из шкуры дракона" WHERE id=5;

#получаю список ставок для лота с сортировкой по дате(у меня сортировать нечего)
SELECT lots.title AS "Название лота", 
		bets.bet_date AS "Дата ставки", 
		bets.price AS "Предложенная цена", 
		users.user_name AS "Имя сделавшего ставку"  
FROM bets 
JOIN lots ON lots.id=bets.lot_id 
JOIN users ON bets.user_id=users.id 
WHERE lots.id=1 
ORDER BY bets.bet_date ASC;


