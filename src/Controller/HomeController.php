<?php

namespace Gufo\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Post\Post;

class HomeController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait;

    public function indexActionGet()
    {
        return $this->renderPage("post/index", "index", [
            "posts" => Post::findAll()
        ]);
    }

    public function aboutActionGet()
    {
        return $this->renderPage("page/about", "about");
    }
}
