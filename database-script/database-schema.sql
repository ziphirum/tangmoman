CREATE TABLE tm_character_data (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     hp INT NOT NULL,
     sp INT NOT NULL,
     attack INT DEFAULT 0,
     defense INT DEFAULT 0,
     accuracy INT DEFAULT 0,
     evasion INT DEFAULT 0,
     critical INT DEFAULT 0,
     PRIMARY KEY (id)
);

CREATE TABLE tm_character (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     hp INT NOT NULL,
     sp INT NOT NULL,
     max_hp INT NOT NULL,
     max_sp INT NOT NULL,
     character_data_id INT NOT NULL,
     useraccount_id INT NOT NULL,
     win INT DEFAULT 0,
     lose INT DEFAULT 0,
     draw INT DEFAULT 0,
     attack INT DEFAULT 0,
     defense INT DEFAULT 0,
     accuracy INT DEFAULT 0,
     evasion INT DEFAULT 0,
     critical INT DEFAULT 0,
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
     PRIMARY KEY (id)
);

CREATE TABLE tm_battle_log (
     id INT NOT NULL AUTO_INCREMENT,
     detail TEXT,
     turn INT NOT NULL,
     attacker_id INT NOT NULL,
     defender_id INT NOT NULL,
     time DATETIME,
     result INT NOT NULL,
     attacker_max_hp INT NOT NULL,
     defender_max_hp INT NOT NULL,
     attacker_max_sp INT NOT NULL,
     defender_max_sp INT NOT NULL,
     attacker_hp INT NOT NULL,
     defender_hp INT NOT NULL,
     attacker_sp INT NOT NULL,
     defender_sp INT NOT NULL,
     PRIMARY KEY (id)
);