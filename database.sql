CREATE DATABASE Condors;
USE Condors;

CREATE TABLE Teams (
	id INT NOT NULL AUTO_INCREMENT,
	city VARCHAR(64),
	name VARCHAR(64),
	logo VARCHAR(255), --Logo URL
	PRIMARY KEY(id)
);

CREATE TABLE Schedule (
	id INT NOT NULL AUTO_INCREMENT,
	home INT, --FK to the Teams table
	away INT, --FK to the Teams table
	game_date DATE NOT NULL,
	game_time TIME NOT NULL,
	home_score INT NOT NULL,
	away_score INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (home) REFERENCES Teams(id),
	FOREIGN KEY (away) REFERENCES Teams(id)
);

CREATE TABLE News (
	id INT NOT NULL AUTO_INCREMENT,
	article_date DATE NOT NULL,
	game_time TIME NOT NULL,
	title VARCHAR(64) NOT NULL,
	description VARCHAR(255) NOT NULL,
	image VARCHAR(255),
	url VARCHAR(255) NOT NULL,
	PRIMARY KEY(id)
);