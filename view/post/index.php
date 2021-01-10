<?php

use Gufo\User\User;

if ($di->get("session")->has("user")) {
    $user = User::findById($di->get("session")->get("user"));
}

foreach ($posts as $post) {
    // $author = $post->author();
    // require component("post");
    require ANAX_INSTALL_PATH . "/view/component/post.php";
}
