<?php

use Gufo\User\User;

if ($di->get("session")->has("user")) {
    $user = User::findById($di->get("session")->get("user"));
}

require ANAX_INSTALL_PATH . "/view/component/post.php";

$sort = $_GET['sort'] ?? 'popular';

?>

<div class="card">
    <div class="card-header d-flex">
        <p class="mb-0 me-1">Sort by</p>
        <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" id="filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?= htmlspecialchars($sort); ?>
        </a>

        <ul class="dropdown-menu" aria-labelledby="filter">
            <li><a class="dropdown-item" href="?sort=popular">Popular</a></li>
            <li><a class="dropdown-item" href="?sort=controversial">Controversial</a></li>
            <li><a class="dropdown-item" href="?sort=new">New</a></li>
            <li><a class="dropdown-item" href="?sort=old">Old</a></li>
        </ul>
        </div>
    </div>
    <div class="card-body">
        <?php if ($post->replies()) : ?>
            <?php foreach ($post->replies($sort) as $reply) : ?>
                <?php $count = 0; ?>
                <?php require ANAX_INSTALL_PATH . "/view/component/reply.php"; ?>
            <?php endforeach; ?>
        <?php else : ?>
        There are no replies yet...
        <?php endif; ?>
    </div>
</div>
