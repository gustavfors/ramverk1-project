<div class="post">
    <?php if (preg_match("/show\/[0-9]+/", $di->get("request")->getRoute())) : ?>
        <h1><?= htmlspecialchars($post->title); ?></h1>
    <?php else : ?>
        <h1><a href="<?= linkTo("post/show/{$post->id}"); ?>"><?= htmlspecialchars($post->title); ?></a></h1>
    <?php endif; ?>
    <p><?= htmlspecialchars($post->body); ?></p>
</div>
