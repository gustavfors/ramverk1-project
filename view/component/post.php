<div class="card mb-4">
    <div class="card-header">
        Topic
    </div>
    <div class="card-body">
        <section class="d-flex post">
            <aside class="position-relative" style="width: 50px;">
                <img src="https://www.gravatar.com/avatar/1ae9ba088293c6de23ad3ca728859666" alt="#" class="img-fluid rounded-circle">
                <div class="thread-line"></div>
            </aside>
            <main style="flex: 1;" class="ms-3">
                <div class="post-info"><a href="#">Cersei Lannister</a> <?= $post->score(); ?> points · 1 day ago</div>
                <?php if (preg_match("/show\/[0-9]+/", $di->get("request")->getRoute())) : ?>
                    <h1><?= htmlspecialchars($post->title); ?></h1>
                <?php else : ?>
                    <h1><a href="<?= linkTo("post/show/{$post->id}"); ?>"><?= htmlspecialchars($post->title); ?></a></h1>
                <?php endif; ?>
                <div class="post-content my-2"><?= $post->body; ?></div>
                <div class="post-panel d-flex align-items-center">
                    <div><a href="<?= linkTo("post/show/{$post->id}"); ?>"><i class="fas fa-comments me-2"></i><?= $post->repliesCount(); ?> Replies</a></div>
                    

                     <form action="<?= linkTo("vote/up/{$post->id}"); ?>" method="POST">
                        <button type="submit" class="d-flex align-items-center"><i class="fas fa-arrow-up"></i></button>
                    </form>

                    <form action="<?= linkTo("vote/down/{$post->id}"); ?>" method="POST">
                        <button type="submit" class="d-flex align-items-center"><i class="fas fa-arrow-down"></i></button>
                    </form>

                    <div class="ms-2"><i class="fas fa-tags me-2"></i>Tags:
                        
                        <?php foreach ($post->tags() as $tag) : ?>
                            <a href="<?= linkTo("tag/show/{$tag['id']}"); ?>"><?= $tag['name']; ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($di->get("session")->get("user") == $post->user) : ?>
                        <div class="ms-3"><a href="<?= linkTo("post/update/{$post->id}"); ?>"><i class="fas fa-edit me-2"></i>Edit</a></div>
                        <div class="ms-3"><a href="<?= linkTo("post/delete/{$post->id}"); ?>"><i class="fas fa-trash me-2"></i>Remove</a></div>
                    <?php endif; ?>
                </div>
            </main>
        </section>
    </div>
</div>

