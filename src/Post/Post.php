<?php

namespace Gufo\Post;

class Post
{
    // ------ START OF ACTIVE RECORD CODE -------
    protected static $database;

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

        while($record = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $objectArray[] = self::instantiate($record);
        }

        return $objectArray;
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM posts";
        $objectArray = self::findBySql($sql);

        if (!empty($objectArray)) {
            return $objectArray;
        } else {
            return false;
        }
    }

    public static function find_by_id($id)
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

        foreach($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }
    // ------ END OF ACTIVE RECORD CODE -------

    public $id;
    public $title;
    public $body;
}
