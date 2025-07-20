-- migrate:up

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)
COMMENT = 'The Users registered to play the game';

CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    start_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    end_date DATETIME NULL,
    score INT UNSIGNED DEFAULT 0,
    CONSTRAINT fk_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)
COMMENT = 'The state of the played games';

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    question TEXT NOT NULL,
    answer TINYINT NULL,
    CONSTRAINT fk_game
        FOREIGN KEY (game_id)
        REFERENCES games(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE 
)
COMMENT = 'The questions asked during the game';

-- migrate:down

DROP TABLE questions;
DROP TABLE games;
DROP TABLE users;