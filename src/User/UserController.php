<?php

namespace Gufo\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet()
    {
        $this->di->get("page")->add("user/index");

        return $this->di->get("page")->render(["title" => "index"]);
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
