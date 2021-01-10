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


INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Jon", "Snow", "riforon770@nonicamy.com", "pass123");
INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Daenerys", "Targaryen", "magegi4179@cocyo.com", "pass123");
INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Tyrion", "Lannister", "sevaf88517@nonicamy.com", "pass123");
INSERT INTO "users" ("firstname", "lastname", "email", "password") VALUES ("Cersei", "Lannister", "bajijec468@nonicamy.com", "pass123");




-- /* Threads */
INSERT INTO posts ("title", "body", "user") VALUES (
    "We look up at the same stars and see such different things.",
    "Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.",
    1
);

INSERT INTO posts ("title", "body", "user") VALUES (
    "When my dragons are grown, we will take back what was stolen from me and destroy those who wronged me.",
    "Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.",
    2
);

INSERT INTO posts ("title", "body", "user") VALUES (
    "I have to disagree. Death is so final, yet life is full of possibilities.",
    "Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.",
    3
);

INSERT INTO posts ("title", "body", "user") VALUES (
    "The gods have no mercy, that’s why they’re gods",
    "Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.",
    4
);




-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Second post", "This is my second post", 1, 1, "2020-01-01 10:13:48");
-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Third post", "This is my third post", 1, 1, "2020-02-03 10:13:48");
-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Fourth post", "This is my Fouth Post", 1, 1, "2020-03-03 10:13:48");

INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
INSERT INTO votes ("score", "post", "user") VALUES (1, 2, 2);
INSERT INTO votes ("score", "post", "user") VALUES (1, 3, 3);
INSERT INTO votes ("score", "post", "user") VALUES (1, 4, 1);

-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
