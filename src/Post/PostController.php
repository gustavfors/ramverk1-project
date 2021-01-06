<?php

namespace Gufo\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Post\Post;

class PostController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet()
    {

        $posts = Post::find_by_id(1);

        die(var_dump($posts));

        $this->di->get("page")->add("post/index");

        return $this->di->get("page")->render(["title" => "index"]);
    }
}
