<?php

namespace Gufo\Tag;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Post\Post;
use Gufo\Tag\Tag;

class TagController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait;

    public function indexActionGet()
    {
        return $this->renderPage("tag/index", "index", [
            "tags" => Tag::findAll()
        ]);
    }

    public function showActionGet($id)
    {
        $tag = Tag::findById($id);

        if (!$tag) {
            return $this->redirectBack();
        }

        $posts = $tag->posts();

        return $this->renderPage("post/index", "index", [
            "posts" => $posts
        ]);
    }
}
