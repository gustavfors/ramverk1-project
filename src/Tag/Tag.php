<?php

namespace Gufo\Tag;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;

class Tag extends DatabaseObject
{
    protected static $tableName = "tags";
    protected static $dbColumns = ["id", "name", "post"];

    public $id;
    public $name;
    public $post;

    public function __construct($values = [])
    {
        $this->score = $values['name'] ?? '';
        $this->post = $values['post'] ?? '';
    }
}
