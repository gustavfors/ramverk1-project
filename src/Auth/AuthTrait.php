<?php

namespace Gufo\Auth;

trait AuthTrait
{
    public function owner($id)
    {
        if ($this->loggedIn()) {
            if ($this->getUser() == $id) {
                return true;
            }
        }
        return false;
    }

    public function loggedIn()
    {
        return $this->di->get("session")->has("user");
    }

    public function getUser()
    {
        return $this->di->get("session")->get("user");
    }
}
