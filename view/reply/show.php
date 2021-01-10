<?php

use Gufo\User\User;

if ($di->get("session")->has("user")) {
    $user = User::findById($di->get("session")->get("user"));
}

$sort = $_GET['sort'] ?? 'popular';



?>

<div class="card">
    <div class="card-header d-flex">
        Replies
    </div>
    <div class="card-body">
        <?php if ($reply->replies()) : ?>    
            <?php $count = 0; ?>
            <?php foreach ($reply->replies($sort) as $reply) : ?>
                <?php require ANAX_INSTALL_PATH . "/view/component/reply.php"; ?>
            <?php endforeach; ?>
        <?php else : ?>
        There are no replies yet...
        <?php endif; ?>
    </div>
</div>
