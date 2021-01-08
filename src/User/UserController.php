<?php

namespace Gufo\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\User\User;

class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait;

    public function indexActionGet()
    {
        $this->di->get("page")->add("user/index");

        return $this->di->get("page")->render(["title" => "index"]);
    }

    public function showActionGet($id)
    {
        $user = User::findById($id);

        if (!$user) {
            return $this->redirectBack();
        }

        $replies = $user->replies();
    
        $posts = $user->posts();

        return $this->renderPage("user/show", "show", [
            "posts" => $posts,
            "replies" => $replies
        ]);
    }

    public function loginActionGet()
    {
        $this->di->get("session")->set("user", 1);
    }

    public function logoutActionGet()
    {
        $this->di->get("session")->delete("user");
    }
}
