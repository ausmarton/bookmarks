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
