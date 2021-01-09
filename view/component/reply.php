<?php $author = $post->author(); ?>


    <div class="card-body d-flex">
        <aside class="position-relative" style="width: 50px;">
            <img src="<?= htmlspecialchars($author->getGravatar()); ?>" alt="" class="img-fluid rounded-circle">
            <div class="thread-line"></div>
        </aside>
        <main class="ms-3" style="flex: 1;">
            <?php require component("reply-top-panel"); ?>
            <?php require component("reply-middle-panel"); ?>
            <?php require component("reply-bottom-panel"); ?>
        </main>
    </div>
