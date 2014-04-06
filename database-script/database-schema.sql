CREATE TABLE tm_character_data (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE tm_character (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     character_data_id INT NOT NULL,
     useraccount_id INT NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE tm_town (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     useraccount_id INT NOT NULL,
     PRIMARY KEY (id)
);

CREATE TABLE tm_useraccount (
     id INT NOT NULL AUTO_INCREMENT,
     username CHAR(100) NOT NULL,
     password CHAR(100) NOT NULL,
     name CHAR(100) NOT NULL,
     win INT DEFAULT 0,
     lose INT DEFAULT 0,
     draw INT DEFAULT 0,
     PRIMARY KEY (id)
);

CREATE TABLE tm_battle_log (
     id INT NOT NULL AUTO_INCREMENT,
     detail CHAR(255) NOT NULL,
     turn INT,
     attacker_id INT NOT NULL,
     defender_id INT NOT NULL,
     time DATETIME,
     PRIMARY KEY (id)
);