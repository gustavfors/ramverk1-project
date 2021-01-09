<?php

namespace Gufo\Reply;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Reply\Reply;
use Gufo\Post\Post;
use Gufo\Vote\Vote;
use Gufo\Auth\AuthTrait;

class ReplyController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait, AuthTrait;

    public function showActionGet($id)
    {
        return $this->renderPage("reply/show", "show", [
            "reply" => Post::findById($id)
        ]);
    }

    public function createActionPost($id)
    {
        if (!$this->loggedIn()) {
            return $this->redirect("user/login");
        }

        if (!Post::findById($id)) {
            return $this->redirectBack();
        }

        $user = $this->getUser();

        $reply = new Reply([
            "body" => $this->getPost("body"),
            "user" => $user,
            "parent" => $id,
            
        ]);

        $reply->save();

        $vote = new Vote([
            "score" => 1,
            "post" => $reply->id,
            "user" => $user
        ]);

        $vote->save();

        return $this->redirectBack();
    }

    public function updateActionGet($id)
    {
        $reply = Reply::findById($id);

        if (!$this->owner($reply->user)) {
            return "Unauthorized.";
        }

        return $this->renderPage("reply/update", "update", [
            "reply" => $reply,
        ]);
    }

    public function updateActionPost($id)
    {
        $reply = Reply::findById($id);

        if (!$this->owner($reply->user)) {
            return "Unauthorized.";
        }

        $reply->body = $this->getPost("body");

        $reply->save();

        return $this->redirectBack();
    }
}
