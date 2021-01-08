<?php
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

<?php


if ($filter == "replies") {
    foreach ($replies as $reply) {
        require component("reply-single");
    }
} else {
    foreach ($posts as $post) {
        require component("post");
    }
}


