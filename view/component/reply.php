<section class="d-flex reply">
    <aside class="position-relative" style="width: 50px;">
        <img src="https://www.gravatar.com/avatar/1ae9ba088293c6de23ad3ca728859666" alt="#" class="img-fluid rounded-circle">
        <div class="thread-line"></div>
    </aside>
    <main style="flex: 1;" class="ms-3">
        <div class="post-info"><a href="#">Cersei Lannister</a> <?= $reply->score(); ?> points · 1 day ago</div>
        <div class="post-content my-2"><?= $reply->body; ?></div>
        <div class="post-panel d-flex align-items-center">
            <div class="d-flex align-items-center"><i class="fas fa-comment me-2"></i>Reply</div>
            <div class="d-flex align-items-center ms-2"><i class="fas fa-plus-square me-2"></i>Expand</div>
            
            <form action="<?= linkTo("vote/up/{$reply->id}"); ?>" method="POST">
                <button type="submit" class="d-flex align-items-center"><i class="fas fa-arrow-up"></i></button>
            </form>

            <form action="<?= linkTo("vote/down/{$reply->id}"); ?>" method="POST">
                <button type="submit" class="d-flex align-items-center"><i class="fas fa-arrow-down"></i></button>
            </form>
            
            <div class="d-flex align-items-center ms-2"><i class="fas fa-check me-2"></i>Mark Best</div>
        </div>
        
        <form action="<?= linkTo("reply/create/{$reply->id}"); ?>" method="POST">
            <textarea name="body" rows="10" placeholder="What are your thoughts?"></textarea>
            <button type="submit">Submit</button>
        </form>

        <?php foreach ($reply->replies() as $reply) : ?>
            <?php require component("reply"); ?>
        <?php endforeach; ?>
    </main>
</section>