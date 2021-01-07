<?php

namespace Gufo\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Post\Post;

class PostController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait;

    public function indexActionGet()
    {
        return $this->renderPage("post/index", "index", [
            "posts" => Post::findAll()
        ]);
    }

    public function showActionGet($id)
    {
        $post = new Post([
            'title' => 'Hello World!',
            'body' => 'This is just a test'
        ]);

        $post->save();

        $post->mergeAttributes([
            'title' => 'new title',
            'body' => 'new body'
        ]);

        $post->save();

        

        return $this->renderPage("post/show", "show", [
            "post" => Post::findById($id)
        ]);
    }

    public function createActionGet()
    {
        return $this->renderPage("post/create", "create");
    }

    public function createActionPost()
    {
        $post = new Post($this->getPost("post"));

        $post->save();

        if ($this->hasErrors($post)) {
            return $this->redirectBack();
        }
        return $this->redirect("");
    }
}
