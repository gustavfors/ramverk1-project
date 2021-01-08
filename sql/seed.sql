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
    "name" Text UNIQUE
);

--
-- Table Post_Tag
--
DROP TABLE IF EXISTS post_tag;
CREATE TABLE post_tag (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "tag" INTEGER,
    "post" INTEGER
);

--
-- Table Users
--
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "firstname" TEXT,
    "lastname" TEXT,
    "email" TEXT,
    "password" TEXT
);

INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Jon", "Snow", "riforon770@nonicamy.com", "pass123");
INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Daenerys", "Targaryen", "magegi4179@cocyo.com", "pass123");
INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Tyrion", "Lannister", "sevaf88517@nonicamy.com", "pass123");
INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Cersei", "Lannister", "bajijec468@nonicamy.com", "pass123");




-- /* posts */
INSERT INTO posts ("title", "body", "user", "created") VALUES ("We look up at the same stars and see such different things.", "Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.", 1, "2020-01-03 10:13:48");




-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Second post", "This is my second post", 1, 1, "2020-01-01 10:13:48");
-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Third post", "This is my third post", 1, 1, "2020-02-03 10:13:48");
-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Fourth post", "This is my Fouth Post", 1, 1, "2020-03-03 10:13:48");


-- INSERT INTO votes ("score", "post", "user") VALUES (10, 2, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (24, 3, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (95, 4, 1);

-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
