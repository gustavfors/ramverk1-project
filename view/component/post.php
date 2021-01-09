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
            <?php require component("post-top-panel"); ?>
            <?php require component("post-middle-panel"); ?>
            <?php require component("post-bottom-panel"); ?>
        </main>
    </div>
</div>