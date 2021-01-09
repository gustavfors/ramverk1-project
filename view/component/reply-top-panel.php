<div class="top-panel">
    <a href="<?= linkTo("user/show/{$author->id}"); ?>"><?= htmlspecialchars($author->fullName()); ?></a> <span><?= htmlspecialchars($reply->score()); ?> points</span> · <span><?= \Carbon\Carbon::createFromDate(htmlspecialchars($reply->created))->diffForHumans(); ?></span>
</div>