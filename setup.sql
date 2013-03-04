DROP DATABASE IF EXISTS bookmarking;
-- Uncomment the line below when not running the first time.
DROP USER 'db_user'@'localhost';

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

CREATE TABLE bookmarking.bookmarks_tags(
	bookmark_id INT NOT NULL,
	tag_id INT NOT NULL,
	PRIMARY KEY(bookmark_id,tag_id)
);

INSERT INTO bookmarking.bookmarks(name,url) VALUES("First Bookmark","http://www.google.com/search");
INSERT INTO bookmarking.bookmarks(name,url) VALUES("Second Bookmark","http://www.yahoo.com/search");
INSERT INTO bookmarking.bookmarks(name,url) VALUES("Third Bookmark","http://www.bing.com/search");
INSERT INTO bookmarking.bookmarks(name,url) VALUES("Fourth Bookmark","http://www.search.com/search");

INSERT INTO bookmarking.tags(name) VALUES("java");
INSERT INTO bookmarking.tags(name) VALUES("php");
INSERT INTO bookmarking.tags(name) VALUES("cycling");
INSERT INTO bookmarking.tags(name) VALUES("database");

INSERT INTO bookmarking.bookmarks_tags VALUES(1,1);
INSERT INTO bookmarking.bookmarks_tags VALUES(1,2);
INSERT INTO bookmarking.bookmarks_tags VALUES(1,4);
INSERT INTO bookmarking.bookmarks_tags VALUES(2,1);
INSERT INTO bookmarking.bookmarks_tags VALUES(2,2);
INSERT INTO bookmarking.bookmarks_tags VALUES(2,4);
INSERT INTO bookmarking.bookmarks_tags VALUES(3,1);
INSERT INTO bookmarking.bookmarks_tags VALUES(3,2);
INSERT INTO bookmarking.bookmarks_tags VALUES(4,3);
