<?php

namespace Gufo\Post;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;
use Gufo\Reply\Reply;

class Post extends DatabaseObject
{
    use ValidationTrait;

    protected static $tableName = "posts";

    protected static $dbColumns = ["id", "title", "body", "user", "created"];

    public $id;
    public $title;
    public $body;
    public $user;
    public $created;

    public function __construct($values = [])
    {
        $this->title = $values['title'] ?? '';
        $this->body = $values['body'] ?? '';
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM posts WHERE parent IS NULL";
        return self::findCustom($sql);
    }

    public function replies()
    {
        $sql = "SELECT * FROM posts WHERE parent IS NOT NULL AND parent = ?";
        return Reply::findCustom($sql, [$this->id]);
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
