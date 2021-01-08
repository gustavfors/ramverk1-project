<?php

namespace Gufo\DatabaseObject;

use Gufo\User\User;

class DatabaseObject
{
    protected static $database;
    protected static $tableName = "";
    protected static $columns = [];
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
            $objectArray[] = static::instantiate($record);
        }

        return $objectArray;
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM ". static::$tableName ." ORDER BY created DESC";
        $objectArray = static::findBySql($sql);

        if (!empty($objectArray)) {
            return $objectArray;
        } else {
            return [];
        }
    }

    public function score()
    {
        $sql = "SELECT SUM(score) AS `score` FROM votes WHERE post = ?";
        $stmt = self::$database->prepare($sql);
        $stmt->execute([$this->id]);

        return (int) $stmt->fetch(\PDO::FETCH_ASSOC)['score'] + 0;
    }

    public function repliesCount($count = 0)
    {
        foreach ($this->replies() as $reply) {
            $count = $reply->repliesCount($count + 1);
        }

        return $count;
    }

    public function author()
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        return User::findCustom($sql, [$this->user])[0];
    }

    public function tags()
    {
        $sql =  "SELECT tags.id, tags.name FROM post_tag ";
        $sql .= "INNER JOIN tags ON post_tag.tag = tags.id ";
        $sql .= "INNER JOIN posts ON post_tag.post = posts.id ";
        $sql .= "WHERE posts.id = ?";

        $stmt = self::$database->prepare($sql);
        $stmt->execute([$this->id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findCustom($sql, $values = [])
    {
        $objectArray = static::findBySql($sql, $values);

        if (!empty($objectArray)) {
            return $objectArray;
        } else {
            return [];
        }
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM ". static::$tableName ." WHERE id = ?";
        $objectArray = static::findBySql($sql, [$id]);

        if (!empty($objectArray)) {
            return array_shift($objectArray);
        } else {
            return false;
        }
    }

    protected static function instantiate($record)
    {
        $object = new static;

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

        $sql = "INSERT INTO ". static::$tableName ." (". join(', ', array_keys($attributes)) .") VALUES (". join(', ', array_values($placeholders)) .")";
        $stmt = self::$database->prepare($sql);
        $result = $stmt->execute(array_values($attributes));
        
        if ($result) {
            $this->id = self::$database->lastInsertId();
            if (property_exists($this, "created")) {
                $record = static::findById($this->id);
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

        $sql = "UPDATE ". static::$tableName ." SET ". join(', ', $attributePairs) ." WHERE id = ?";
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

        foreach (static::$dbColumns as $column) {
            if ($column == 'id' || $column == 'created') {
                continue;
            }
            $attributes[$column] = $this->$column;
        }

        return $attributes;
    }

    public function delete()
    {
        $sql = "DELETE FROM ". static::$tableName ." WHERE id = ?";
        $stmt = self::$database->prepare($sql);
        $result = $stmt->execute([$this->id]);

        return $result;
    }
}
