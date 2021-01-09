<?php

namespace Gufo\Tag;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;
use Gufo\Post\Post;

class Tag extends DatabaseObject
{
    protected static $tableName = "tags";
    protected static $dbColumns = ["id", "name", "created"];

    public $id;
    public $name;

    public function __construct($values = [])
    {
        $this->name = $values['name'] ?? '';
    }

    public static function findByName($name)
    {
        $sql = "SELECT * FROM tags WHERE name = ?";
        $result = self::findCustom($sql, [$name]);

        if ($result) {
            return $result[0];
        }

        return false;
    }

    public static function extract($tagString)
    {
        preg_match_all("/#[a-z0-9]+/", $tagString, $tags);

        return $tags[0];
    }

    public static function popular()
    {
        $sql = "SELECT tags.id, tags.name, (SELECT COUNT(*) FROM post_tag WHERE tag = tags.id) AS `posts` ";
        $sql .= "FROM tags ";
        $sql .= "GROUP BY tags.name";

        $stmt = static::$database->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function posts()
    {
        $sql = "SELECT posts.id, posts.title, posts.body, posts.user, posts.created FROM post_tag ";
        $sql .= "INNER JOIN tags ON post_tag.tag = tags.id ";
        $sql .= "INNER JOIN posts ON post_tag.post = posts.id ";
        $sql .= "WHERE tags.id = ?";

        return Post::findCustom($sql, [$this->id]);
    }
}
