<?php

namespace Gufo\Commons;

trait UtilityTrait
{
    public function renderPage($template, $title, $values = [])
    {
        $this->di->get("page")->add($template, $values);
        return $this->di->get("page")->render(["title" => $title]);
    }

    public function redirect($route)
    {
        return $this->di->get("response")->redirect($route);
    }

    public function redirectBack($fallback = "")
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            return $this->di->get("response")->redirect($_SERVER["HTTP_REFERER"]);
        } else {
            return $this->di->get("response")->redirect($fallback);
        }
    }

    public function getPost($key)
    {
        return $this->di->get("request")->getPost($key);
    }
}
