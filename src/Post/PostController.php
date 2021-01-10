<?php

namespace Gufo\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Post\Post;
use Gufo\Vote\Vote;
use Gufo\Tag\Tag;
use Gufo\PostTag\PostTag;
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
            return $this->redirect("user/login");
        }

        return $this->renderPage("post/create", "create");
    }

    public function createActionPost()
    {
        if (!$this->loggedIn()) {
            return $this->redirect("user/login");
        }

        $user = $this->getUser();

        $post = new Post($this->getPost("post"));
        $post->user = $user;

        $post->save();

        $vote = new Vote([
            "score" => 1,
            "post" => $post->id,
            "user" => $user
        ]);

        $vote->save();

        PostTag::tag($this->getPost("tags"), $post->id);

        return $this->redirect("post/show/{$post->id}");
    }

    public function updateActionGet($id)
    {
        $post = Post::findById($id);

        if (!$this->owner($post->user)) {
            return "Unauthorized.";
        }

        $tags = array_map(function ($tag) {
            return $tag['name'];
        }, $post->tags());

        $tags = join(" ", $tags);

        return $this->renderPage("post/update", "update", [
            "post" => $post,
            "tags" => $tags
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

        PostTag::tag($this->getPost("tags"), $post->id);

        return $this->redirect("post/show/{$post->id}");
    }

    public function bestActionGet($id)
    {
        $reply = Reply::findById($id);
        
        $post = $reply->post();
        
        if (!$this->owner($post->user)) {
            return "Unauthorized.";
        }

        if ($post->best == $reply->id) {
            $post->best = null;
        } else {
            $post->best = $reply->id;
        }

        $post->save();

        return $this->redirectBack();
        
    }
}
