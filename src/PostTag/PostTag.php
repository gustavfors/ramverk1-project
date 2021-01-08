<?php

namespace Gufo\PostTag;

use Gufo\Commons\ValidationTrait;
use Gufo\DatabaseObject\DatabaseObject;
use Gufo\Tag\Tag;

class PostTag extends DatabaseObject
{
    protected static $tableName = "post_tag";
    protected static $dbColumns = ["id", "post", "tag"];

    public $id;
    public $post;
    public $tag;

    public function __construct($values = [])
    {
        $this->post = $values['post'] ?? '';
        $this->tag = $values['tag'] ?? '';
    }

    public static function findPostTag($post, $tag)
    {
        $sql = "SELECT * FROM post_tag WHERE post = ? AND tag = ?";
        $result = self::findCustom($sql, [$post, $tag]);

        if ($result) {
            return $result[0];
        }

        return false;
    }

    public static function removeTags($post)
    {
        $sql = "DELETE FROM post_tag WHERE post = ?";
        $stmt = self::$database->prepare($sql);
        return $stmt->execute([$post]);
    }

    public static function tag($tagString, $post)
    {
        self::removeTags($post);

        $tags = Tag::extract($tagString);

        if ($tags) {
            foreach ($tags as $tagName) {
                $tag = Tag::findByName($tagName);
                if (!$tag) {
                    $tag = new Tag([
                        "name" => $tagName
                    ]);
                    $tag->save();
                }

                $postTag = PostTag::findPostTag($post, $tag->id);

                if (!$postTag) {
                    $postTag = new PostTag([
                        "post" => $post,
                        "tag" => $tag->id
                    ]);
                    $postTag->save();
                }
            }
        }
    }
}
