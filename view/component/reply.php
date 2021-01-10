<?php $author = $reply->author(); ?>

<div class="reply d-flex reply">
    <aside class="position-relative" style="width: 50px;">
        <img src="<?= htmlspecialchars($author->getGravatar()); ?>" alt="" class="img-fluid rounded-circle">
        <div class="thread-line"></div>
    </aside>
    <main class="ms-3" style="flex: 1;">
        <?php require ANAX_INSTALL_PATH . "/view/component/reply-top-panel.php"; ?>
        <?php require ANAX_INSTALL_PATH . "/view/component/reply-middle-panel.php"; ?>
        <?php require ANAX_INSTALL_PATH . "/view/component/reply-bottom-panel.php"; ?>
    </main>
</div>
