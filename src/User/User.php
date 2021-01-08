<?php

namespace Gufo\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\User\User;

class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

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

        $posts = $user->posts();

        return $this->renderPage("post/index", "index", [
            "posts" => $posts
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
