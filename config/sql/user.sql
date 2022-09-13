CREATE TABLE user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(50) UNIQUE,
    email VARCHAR(320) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

ALTER TABLE user
ADD img VARCHAR(50);

ALTER TABLE user
ADD admin VARCHAR(5);

CREATE TABLE password_reset(
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(320) NOT NULL,
    token VARCHAR(100) NOT NULL,
    validity INT NOT NULL
);

alter table user
add bio TEXT;

alter table user
add nbr_duel_game INT;

alter table user
add nbr_win_duel_game INT;
