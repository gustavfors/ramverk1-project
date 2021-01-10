DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "title" TEXT,
    "body" TEXT,
    "parent" INTEGER,
    "user" INTEGER,
    "best" INTEGER,
    "created" DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS votes;
CREATE TABLE votes (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "score" INTEGER,
    "post" INTEGER,
    "user" INTEGER
);

DROP TABLE IF EXISTS tags;
CREATE TABLE tags (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "name" Text UNIQUE,
    "created" DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS post_tag;
CREATE TABLE post_tag (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "tag" INTEGER,
    "post" INTEGER
);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "firstname" TEXT,
    "lastname" TEXT,
    "email" TEXT,
    "password" TEXT
);