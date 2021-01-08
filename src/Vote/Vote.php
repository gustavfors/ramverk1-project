<?php

namespace Gufo\Vote;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;

class Vote extends DatabaseObject
{
    protected static $tableName = "votes";
    protected static $dbColumns = ["id", "score", "user", "post"];

    public $id;
    public $score;
    public $user;
    public $post;

    public function __construct($values = [])
    {
        $this->score = $values['score'] ?? 1;
        $this->post = $values['post'] ?? '';
        $this->user = $values['user'] ?? '';
        
    }

    public static function findUserVote($post, $user)
    {
        $sql = "SELECT * FROM votes WHERE post = ? AND user = ?";
        $result = self::findCustom($sql, [$post, $user]);

        if ($result) {
            return $result[0];
        }

        return false;
    }
}
