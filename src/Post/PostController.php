<?php

namespace Gufo\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\RenderPageTrait;
use Gufo\Post\Post;

class PostController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, RenderPageTrait;

    public function indexActionGet()
    {
        return $this->renderPage("post/index", "index", [
            "posts" => Post::findAll()
        ]);
    }

    public function showActionGet($id)
    {
        return $this->renderPage("post/show", "show", [
            "post" => Post::findById($id)
        ]);
    }
}
