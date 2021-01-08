<?php

namespace Gufo\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Post\Post;
use Gufo\Reply\Reply;
use Gufo\Auth\AuthTrait;

class PostController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait, AuthTrait;

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

    public function createActionGet()
    {
        if (!$this->loggedIn()) {
            return "Unauthorized";
        }

        return $this->renderPage("post/create", "create");
    }

    public function createActionPost()
    {
        if (!$this->loggedIn()) {
            return "Unauthorized";
        }

        $post = new Post($this->getPost("post"));
        $post->user = $this->getUser();

        $post->save();

        return $this->redirect("post/show/{$post->id}");
    }

    public function updateActionGet($id)
    {
        $post = Post::findById($id);

        if (!$this->owner($post->user)) {
            return "Unauthorized.";
        }

        return $this->renderPage("post/update", "update", [
            "post" => $post
        ]);
    }

    public function updateActionPost($id)
    {
        $post = Post::findById($id);

        if (!$this->owner($post->user)) {
            return "Unauthorized.";
        }

        $post->mergeAttributes($this->getPost("post"));

        $post->save();

        return $this->redirect("post/show/{$post->id}");
    }
}
