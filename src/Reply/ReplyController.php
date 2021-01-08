<?php

namespace Gufo\Reply;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Reply\Reply;
use Gufo\Post\Post;
use Gufo\Auth\AuthTrait;

class ReplyController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait, AuthTrait;

    public function createActionPost($id)
    {
        if (!$this->loggedIn()) {
            return $this->redirect("user/login");
        }

        if (!Post::findById($id)) {
            return $this->redirectBack();
        }

        $reply = new Reply([
            "body" => $this->getPost("body"),
            "user" => $this->getUser(),
            "parent" => $id,
            
        ]);

        $reply->save();

        return $this->redirectBack();
    }
}
