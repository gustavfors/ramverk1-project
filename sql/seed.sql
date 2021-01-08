--
-- Table Post
--
DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "title" TEXT,
    "body" TEXT,
    "parent" INTEGER,
    "user" INTEGER,
    -- "best" INTEGER,
    "created" DATETIME DEFAULT CURRENT_TIMESTAMP
);

--
-- Table Votes
--
DROP TABLE IF EXISTS votes;
CREATE TABLE votes (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "score" INTEGER,
    "post" INTEGER,
    "user" INTEGER
);

--
-- Table Tags
--
DROP TABLE IF EXISTS tags;
CREATE TABLE tags (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "name" Text UNIQUE,
    "post" INTEGER
);

-- /* posts */
INSERT INTO posts ("title", "body", "user", "created") VALUES ("First post", "This is my first post", 1, "2020-01-03 10:13:48");
INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Second post", "This is my second post", 1, 1, "2020-02-03 10:13:48");
INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Third post", "This is my third post", 1, 1, "2020-03-03 10:13:48");

INSERT INTO posts ("body", "user", "parent", "created") VALUES ("level one reply", 1, 3, "2020-03-03 10:13:48");
INSERT INTO posts ("body", "user", "parent", "created") VALUES ("level two reply", 1, 4, "2020-03-03 10:13:48");
INSERT INTO posts ("body", "user", "parent", "created") VALUES ("level three reply", 1, 5, "2020-03-03 10:13:48");
INSERT INTO posts ("body", "user", "parent", "created") VALUES ("level four reply", 1, 6, "2020-03-03 10:13:48");
INSERT INTO posts ("body", "user", "parent", "created") VALUES ("level one reply", 1, 3, "2020-03-03 10:13:48");

-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
