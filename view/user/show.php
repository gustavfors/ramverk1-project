<?php
use Gufo\User\User;

if ($di->get("session")->has("user")) {
    $user = User::findById($di->get("session")->get("user"));
}

$filter = $_GET['filter'] ?? "posts";
?>

<div class="card mb-4">
     <div class="card-header d-flex">
        <p class="mb-0 me-1">Show</p>
        <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" id="filter" data-bs-toggle="dropdown" aria-expanded="false">
            <?= htmlspecialchars($filter); ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="filter">
            <li><a class="dropdown-item" href="?filter=posts">Posts</a></li>
            <li><a class="dropdown-item" href="?filter=replies">Replies</a></li>
        </ul>
        </div>
    </div>
</div>

<?php if ($filter == "replies") : ?>
    <?php foreach ($replies as $reply) : ?>
        <div class="card mb-4">
            <div class="card-header">
                Reply
            </div>
            <div class="card-body">
                <?php require ANAX_INSTALL_PATH . "/view/component/reply.php"; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <?php foreach ($posts as $post) : ?>
        <?php require ANAX_INSTALL_PATH . "/view/component/post.php"; ?>
    <?php endforeach; ?>
<?php endif; ?>


