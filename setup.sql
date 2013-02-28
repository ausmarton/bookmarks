DROP DATABASE IF EXISTS bookmarking;
-- Uncomment the line below when not running the first time.
-- DROP USER 'db_user'@'localhost';

CREATE DATABASE bookmarking;

CREATE USER 'db_user'@'localhost' IDENTIFIED BY 'db_password';

GRANT ALL PRIVILEGES ON bookmarking.* TO 'db_user'@'localhost' IDENTIFIED BY 'db_password';

CREATE TABLE bookmarking.bookmarks (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	url VARCHAR(255) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE bookmarking.tags (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	PRIMARY KEY(id)
);

INSERT INTO bookmarking.bookmarks(name,url) VALUES("First Bookmark","http://www.google.com/search");
INSERT INTO bookmarking.bookmarks(name,url) VALUES("Second Bookmark","http://www.yahoo.com/search");
INSERT INTO bookmarking.bookmarks(name,url) VALUES("Third Bookmark","http://www.bing.com/search");
INSERT INTO bookmarking.bookmarks(name,url) VALUES("Fourth Bookmark","http://www.search.com/search");

INSERT INTO bookmarking.tags(name) VALUES("Java");
INSERT INTO bookmarking.tags(name) VALUES("PHP");
INSERT INTO bookmarking.tags(name) VALUES("Cycling");
INSERT INTO bookmarking.tags(name) VALUES("Database");
