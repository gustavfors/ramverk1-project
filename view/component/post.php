<?php $author = $post->author(); ?>

<div class="card mb-4">
    <div class="card-header">
        Thread
    </div>
    <div class="card-body d-flex">
        <aside style="width: 50px;">
            <img src="<?= htmlspecialchars($author->getGravatar()); ?>" alt="" class="img-fluid rounded-circle">
        </aside>
        <main class="ms-3" style="flex: 1;">
            <?php require ANAX_INSTALL_PATH . "/view/component/post-top-panel.php"; ?>
            <?php require ANAX_INSTALL_PATH . "/view/component/post-middle-panel.php"; ?>
            <?php require ANAX_INSTALL_PATH . "/view/component/post-bottom-panel.php"; ?>
        </main>
    </div>
</div>