    ALTER TABLE lots ADD FOREIGN KEY (user_id) REFERENCES users(id);
    ALTER TABLE lots ADD FOREIGN KEY (winner_id) REFERENCES users(id);
    ALTER TABLE lots ADD FOREIGN KEY (category_id) REFERENCES categories(id);


    ALTER TABLE bets ADD FOREIGN KEY (user_id) REFERENCES users(id);
    ALTER TABLE bets ADD FOREIGN KEY  (lot_id) REFERENCES lots(id);


    ALTER TABLE users ADD FOREIGN KEY (lot_id) REFERENCES lots(id);
    ALTER TABLE users ADD FOREIGN KEY (bet_id) REFERENCES bets(id);