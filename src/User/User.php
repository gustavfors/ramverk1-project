<?php

namespace Gufo\User;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;
use Gufo\Post\Post;

class User extends DatabaseObject
{
    protected static $tableName = "users";
    protected static $dbColumns = ["id", "firstname", "lastname", "email", "password"];

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $score;

    public function __construct($values = [])
    {
        $this->firstname = $values['firstname'] ?? '';
        $this->lastname = $values['lastname'] ?? '';
        $this->email = $values['email'] ?? '';
        // $this->password = $values['password'] ?? '';
        $this->score = $values['score'] ?? 0;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public static function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $result = self::findCustom($sql, [$email]);

        if ($result) {
            return $result[0];
        }

        return false;
    }

    public static function highscore()
    {
        $sql = "SELECT users.id, users.firstname, users.lastname, users.email, (((SELECT COUNT(*) FROM posts WHERE posts.user = users.id) * 10) + SUM(votes.score)) AS `score` FROM users";
        $sql .= " INNER JOIN posts ON posts.user = users.id";
        $sql .= " INNER JOIN votes ON posts.id = votes.post";
        $sql .= " GROUP BY users.firstname";
        $sql .= " ORDER BY `score` DESC";

        $result = self::findCustom($sql);

        return $result;
    }

    public function posts()
    {
        $sql = "SELECT posts.id, posts.title, posts.body, posts.user, posts.created FROM posts ";
        $sql .= "INNER JOIN users ON users.id = posts.user ";
        $sql .= "WHERE posts.parent IS NULL AND posts.user = ?";

        return Post::findCustom($sql, [$this->id]);
    }

    public function stats()
    {
        $sql = "SELECT users.firstname, users.lastname, (SELECT COUNT(posts.id) FROM posts WHERE user = users.id AND parent IS NULL) as `posts`, (SELECT count(posts.id) FROM posts WHERE user = users.id AND parent IS NOT NULL) AS `replies`, (((SELECT COUNT(*) FROM posts WHERE posts.user = users.id) * 10) + SUM(votes.score)) AS `score` FROM users ";
        $sql .= "INNER JOIN posts ON posts.user = users.id ";
        $sql .= "INNER JOIN votes ON posts.id = votes.post ";
        $sql .= "WHERE users.id = ? ";
        $sql .= "GROUP BY users.id ";

        $stmt = static::$database->prepare($sql);
        $stmt->execute([$this->id]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return [
                'score' => 0,
                'posts' => 0,
                'replies' => 0
            ];
        } else {
            return $result;
        }
    }

    public function replies()
    {
        $sql = "SELECT posts.id, posts.title, posts.body, posts.user, posts.created FROM posts ";
        $sql .= "INNER JOIN users ON users.id = posts.user ";
        $sql .= "WHERE posts.parent IS NOT NULL AND posts.user = ?";

        return Post::findCustom($sql, [$this->id]);
    }

    public function fullName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function getGravatar()
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email)));
    }
}
