<?php

namespace Gufo\Commons;

trait RenderPageTrait
{
    public function renderPage($template, $title, $values)
    {
        $this->di->get("page")->add($template, $values);
        return $this->di->get("page")->render(["title" => $title]);
    }
}
