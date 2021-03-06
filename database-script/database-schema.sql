-- All character data
CREATE TABLE tm_character_data (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     hp INT NOT NULL,
     sp INT NOT NULL,
     defense INT DEFAULT 0,
     accuracy INT DEFAULT 0,
     evasion INT DEFAULT 0,
     critical INT DEFAULT 0,
     PRIMARY KEY (id)
);

-- Character data of each account
CREATE TABLE tm_character (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     money INT NOT NULL DEFAULT 0,
     last_connection_time DATETIME,
     energy INT NOT NULL DEFAULT 0, -- use in every action
     ap INT NOT NULL, -- ability point
     hp INT NOT NULL,
     sp INT NOT NULL,
     max_hp INT NOT NULL,
     max_sp INT NOT NULL,
     character_data_id INT NOT NULL,
     useraccount_id INT NOT NULL,
     win INT DEFAULT 0,
     lose INT DEFAULT 0,
     draw INT DEFAULT 0,
     defense INT DEFAULT 0,
     accuracy INT DEFAULT 0,
     evasion INT DEFAULT 0,
     critical INT DEFAULT 0,
     money INT DEFAULT 0,
     PRIMARY KEY (id)
);

/* -- MAY NOT USE
CREATE TABLE tm_town (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     useraccount_id INT NOT NULL,
     PRIMARY KEY (id)
);
*/

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

-- All skill data
CREATE TABLE tm_skill_data (
     id INT NOT NULL AUTO_INCREMENT,
     name CHAR(30) NOT NULL,
     damage INT NOT NULL,
     upgrade_damage INT NOT NULL,
     accuracy INT NOT NULL,
     critical INT NOT NULL,
     sp_usage INT NOT NULL,
     amount INT NOT NULL,
     upgrade_money INT NOT NULL,
     PRIMARY KEY (id)
);

-- Base skill of each character
CREATE TABLE tm_char_skill_data (
     id INT NOT NULL AUTO_INCREMENT,
     character_data_id INT NOT NULL,
     skill_id INT NOT NULL,
     PRIMARY KEY (id)
);


-- Current skill of each character
CREATE TABLE tm_char_skill (
     id INT NOT NULL AUTO_INCREMENT,
     character_id INT NOT NULL,
     skill_id INT NOT NULL,
     upgrade_count INT NOT NULL,
     PRIMARY KEY (id)
);