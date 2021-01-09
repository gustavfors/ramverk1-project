<div class="middle-panel">
    <?php if (preg_match("/post\/show\/[0-9]+/", $di->get("request")->getRoute())) : ?>
    <h1><?= htmlspecialchars($reply->title); ?></h1>
    <?php else : ?>
    <h1><a href="<?= linkTo("post/show/{$reply->id}"); ?>"><?= htmlspecialchars($reply->title); ?></a></h1>
    <?php endif; ?>
    <div><?= htmlspecialchars($reply->body); ?></div>
</div>