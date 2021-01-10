<?php

namespace Gufo\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Gufo\Commons\UtilityTrait;
use Gufo\Auth\AuthTrait;
use Gufo\User\User;

class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait, UtilityTrait, AuthTrait;

    public function showActionGet($id)
    {
        $user = User::findById($id);

        $replies = $user->replies();
    
        $posts = $user->posts();

        return $this->renderPage("user/show", "show", [
            "posts" => $posts,
            "replies" => $replies
        ]);
    }

    public function createActionGet()
    {
        return $this->renderPage("user/create", "create");
    }

    public function createActionPost()
    {
        if (User::findByEmail($this->getPost("user")['email'])) {
            return $this->redirectBack();
        }

        $user = new User($this->getPost("user"));

        $user->setPassword($this->getPost("password"));

        $user->save();

        $this->di->get("session")->set("user", $user->id);

        return $this->redirect("user/show/{$user->id}");
    }

    public function updateActionGet($id)
    {
        $user = User::findById($id);

        if (!$this->owner($user->id)) {
            return "Unauthorized.";
        }

        return $this->renderPage("user/update", "update", [
            'user' => $user
        ]);
    }

    public function updateActionPost($id)
    {
        $user = User::findById($id);

        if (!$this->owner($user->id)) {
            return "Unauthorized.";
        }

        $user->mergeAttributes($this->getPost("user"));

        if ($this->getPost("password")) {
            $user->setPassword($this->getPost("password"));
        }

        $user->save();

        return $this->redirect("user/show/{$user->id}");
    }

    public function loginActionGet()
    {
        return $this->renderPage("user/login", "login");
    }

    public function loginActionPost()
    {
        $user = User::findByEmail($this->getPost("email"));
        
        if ($user) {
            password_verify($this->getPost("password"), $user->password);
            $this->di->get("session")->set("user", $user->id);
            return $this->redirect("");
        }

        return $this->redirectBack();
    }

    public function logoutAction()
    {
        $this->di->get("session")->delete("user");

        return $this->redirect("");
    }
}
