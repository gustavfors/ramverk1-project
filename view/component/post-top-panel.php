<div class="top-panel">
    <a href="<?= linkTo("user/show/{$author->id}"); ?>"><?= htmlspecialchars($author->fullName()); ?></a> <span><?= htmlspecialchars($post->score()); ?> points</span> · <span><?= \Carbon\Carbon::createFromDate(htmlspecialchars($post->created))->diffForHumans(); ?></span>
</div>