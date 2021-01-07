<?php

namespace Gufo\Post;

use Gufo\Commons\ValidationTrait;

class Post
{
    use ValidationTrait;

    // ------ START OF ACTIVE RECORD CODE -------
    protected static $database;

    protected static $dbColumns = ["id", "title", "body", "created"];

    public $errors = [];

    public static function setDatabase($database)
    {
        self::$database = $database;
    }

    public static function findBySql($sql, $values = [])
    {
        $stmt = self::$database->prepare($sql);
        $stmt->execute($values);

        if (!$stmt) {
            exit("Database query failed.");
        }

        $objectArray = [];

        while ($record = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $objectArray[] = self::instantiate($record);
        }

        return $objectArray;
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM posts ORDER BY created DESC";
        $objectArray = self::findBySql($sql);

        if (!empty($objectArray)) {
            return $objectArray;
        } else {
            return false;
        }
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM posts WHERE id = ?";
        $objectArray = self::findBySql($sql, [$id]);

        if (!empty($objectArray)) {
            return array_shift($objectArray);
        } else {
            return false;
        }
    }

    protected static function instantiate($record)
    {
        $object = new self;

        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    protected function validate()
    {
        $this->errors = [];

        if($this->isBlank($this->title)) {
            $this->errors[] = "Title cannot be blank.";
        }

        if($this->isBlank($this->body)) {
            $this->errors[] = "Body cannot be blank.";
        }

        return $this->errors;
    }

    protected function create()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->attributes();

        $placeholders = array_map(function ($item) {
            return "?";
        }, $attributes);

        $sql = "INSERT INTO posts (". join(', ', array_keys($attributes)) .") VALUES (". join(', ', array_values($placeholders)) .")";
        $stmt = self::$database->prepare($sql);
        $result = $stmt->execute(array_values($attributes));
        
        if ($result) {
            $this->id = self::$database->lastInsertId();
            if (property_exists($this, "created")) {
                $record = self::findById($this->id);
                if ($record) {
                    $this->created = $record->created;
                }
            }
        }

        return $result;
    }

    public function save()
    {
        if (isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    protected function update()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->attributes();

        $attributePairs = [];
        foreach ($attributes as $key => $value) {
            $attributePairs[] = "{$key} = ?";
        }

        $values = array_values($attributes);
        $values[] = $this->id;

        $sql = "UPDATE posts SET ". join(', ', $attributePairs) ." WHERE id = ?";
        $stmt = self::$database->prepare($sql);
        $result = $stmt->execute($values);

        return $result;
    }

    public function mergeAttributes($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function attributes()
    {
        $attributes = [];

        foreach (self::$dbColumns as $column) {
            if ($column == 'id' || $column == 'created') {
                continue;
            }
            $attributes[$column] = $this->$column;
        }

        return $attributes;
    }

    // ------ END OF ACTIVE RECORD CODE -------

    public $id;
    public $title;
    public $body;
    public $created;

    public function __construct($values = [])
    {
        $this->title = $values['title'] ?? '';
        $this->body = $values['body'] ?? '';
    }
}
