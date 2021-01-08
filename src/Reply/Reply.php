<?php

namespace Gufo\Reply;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;

class Reply extends DatabaseObject
{
    use ValidationTrait;

    protected static $tableName = "posts";
    protected static $dbColumns = ["id", "body", "user", "parent", "created"];

    public $id;
    public $body;
    public $user;
    public $created;

    public function __construct($values = [])
    {
        $this->body = $values['body'] ?? '';
        $this->user = $values['user'] ?? '';
        $this->parent = $values['parent'] ?? '';
    }

    public function replies()
    {
        $sql = "SELECT * FROM posts WHERE parent IS NOT NULL AND parent = ?";
        return self::findCustom($sql, [$this->id]);
    }

    protected function validate()
    {
        $this->errors = [];

        if ($this->isBlank($this->body)) {
            $this->errors[] = "Body cannot be blank.";
        }

        return $this->errors;
    }
}
