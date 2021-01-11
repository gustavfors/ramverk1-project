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




-- thread one and replies 1 - 5
INSERT INTO posts ("title", "user", "created") VALUES (
    "What is something free from the internet everyone should take advantage of?",
    1,
    "2020-04-19 12:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "[https://haveibeenpwned.com](https://haveibeenpwned.com) is a website that checks through a database of breaches to see if any account associated with your email has been compromised.",
    2,
    1,
    "2020-05-01 14:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "Question - once you discover you have been, THEN what? Change email address? Only password? Stop checking and play pretend everything’s fine?",
    1,
    2,
    "2020-05-04 15:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "Atleast change passwords, don't use an account with the same email and password that was pwnd. Ideally, use something like Bitwarden, a password manager and protect it with two factor authentication. So you have a unique long complex password per site.",
    3,
    3,
    "2020-05-11 9:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "I bring to you radio.garden, my friend. Radio stations from around the globe. Just spin it a bit and click where you want to get a list of radio stations from that country. Great for people who like foreign music, language learners, or people looking to reconnect with something back home.",
    4,
    1,
    "2020-05-27 17:56:03"
);

-- thread two and replies 6 - 11
INSERT INTO posts ("title", "user", "created") VALUES (
    'If people used "break up lines" instead of "pick up lines" what would some of them be??',
    2,
    "2020-06-05 11:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    'Raise your hand if you have a boyfriend.

Not so fast',
    1,
    6,
    "2020-06-05 17:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    'Made me laugh out loud',
    4,
    7,
    "2020-06-06 21:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "You remind me of Halley's Comet. I don't wanna see you again for another 74 years",
    4,
    6,
    "2020-07-02 22:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "So you’re telling me there’s a chance?",
    3,
    9,
    "2020-07-03 23:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "I will always cherish my initial misconceptions of you.",
    3,
    6,
    "2020-08-03 23:56:03"
);

-- thread two and replies 12 - something
INSERT INTO posts ("title", "user", "created") VALUES (
    'What mind-blowing (but simple) facts would satisfy a 4-year old daughter’s daily request for 1 fact before bedtime?',
    3,
    "2020-08-01 18:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    'Dogs can tell when your comming home by how much of your scent is left in the house if you have a daily routine',
    1,
    12,
    "2020-08-05 17:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    'Otters have skin pockets for their favorite rocks',
    2,
    12,
    "2020-08-07 17:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    'They are also surprisingly vicious.',
    3,
    14,
    "2020-08-08 17:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "The reason that they're so playful is because they're such efficient killing machines that they have extra time to spend on things besides hunting, but that's a much less 4-year-old friendly fact.",
    4,
    15,
    "2020-08-09 17:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "I think I read that they have to eat like 25% of their weight daily. You’d have to be a killing machine to achieve that.",
    1,
    16,
    "2020-08-08 17:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "Otters are neat.",
    2,
    16,
    "2020-08-08 18:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "I seem to remember that most sea otters are left-handed, too.",
    1,
    14,
    "2020-08-09 18:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "Cashews come from a fruit.",
    4,
    12,
    "2020-08-10 18:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "Most elephants weigh less than a blue whale’s tongue!",
    3,
    12,
    "2020-08-11 18:56:03"
);

INSERT INTO posts ("body", "user", "parent", "created") VALUES (
    "I guess I'm 4, because I'm loving all the fun facts in this thread",
    1,
    21,
    "2020-08-12 18:56:03"
);




INSERT INTO votes ("score", "post", "user") VALUES (576, 1, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (876, 2, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (213, 3, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (41, 4, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (184, 5, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (249, 6, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (434, 7, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (111, 8, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (781, 9, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (1086, 10, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (233, 11, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (642, 12, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (1468, 13, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (879, 14, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (289, 15, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (412, 16, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (86, 17, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (162, 18, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (74, 19, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (598, 20, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (761, 21, 9999);
INSERT INTO votes ("score", "post", "user") VALUES (979, 22, 9999);

-- thread two and replies 6 - somthing

INSERT INTO tags ("name") VALUES ("#advice");
INSERT INTO tags ("name") VALUES ("#internet");
INSERT INTO tags ("name") VALUES ("#funny");
INSERT INTO tags ("name") VALUES ("#facts");
INSERT INTO tags ("name") VALUES ("#2020");

INSERT INTO post_tag ("tag", "post") VALUES (1, 1);
INSERT INTO post_tag ("tag", "post") VALUES (2, 1);

INSERT INTO post_tag ("tag", "post") VALUES (3, 6);
INSERT INTO post_tag ("tag", "post") VALUES (4, 12);
INSERT INTO post_tag ("tag", "post") VALUES (1, 12);
INSERT INTO post_tag ("tag", "post") VALUES (5, 12);


-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Second post", "This is my second post", 1, 1, "2020-01-01 10:13:48");
-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Third post", "This is my third post", 1, 1, "2020-02-03 10:13:48");
-- INSERT INTO posts ("title", "body", "user", "parent", "created") VALUES ("Fourth post", "This is my Fouth Post", 1, 1, "2020-03-03 10:13:48");



-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
-- INSERT INTO votes ("score", "post", "user") VALUES (1, 1, 1);
