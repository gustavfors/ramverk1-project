<?php

namespace Gufo\Post;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;
use Gufo\Reply\Reply;
use Gufo\User\User;

class Post extends DatabaseObject
{
    use ValidationTrait;

    protected static $tableName = "posts";

    protected static $dbColumns = ["id", "title", "body", "user", "best", "created"];

    public $id;
    public $title;
    public $body;
    public $user;
    public $best;
    public $created;

    public function __construct($values = [])
    {
        $this->title = $values['title'] ?? '';
        $this->body = $values['body'] ?? '';
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM posts WHERE parent IS NULL ORDER BY created DESC";
        return self::findCustom($sql);
    }

    public function replies($sort = '')
    {

        if ($sort == 'controversial') {
            $sortBy = "score ASC";
        } elseif ($sort == 'new') {
            $sortBy = "created DESC";
        } elseif ($sort == 'old') {
            $sortBy = "created ASC";
        } else {
            $sortBy = 'score DESC';
        }

        $sql = "SELECT *, (SELECT SUM(score) FROM votes WHERE votes.post = posts.id) AS `score` FROM posts WHERE parent = ? ORDER BY {$sortBy}";
        
        $values = [$this->id];

        return Reply::findCustom($sql, $values);
    }

    protected function validate()
    {
        $this->errors = [];

        if ($this->isBlank($this->title)) {
            $this->errors[] = "Title cannot be blank.";
        }

        if ($this->isBlank($this->body)) {
            $this->errors[] = "Body cannot be blank.";
        }

        return $this->errors;
    }
}
