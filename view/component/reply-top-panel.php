<div class="top-panel">
    <a href="<?= linkTo("user/show/{$author->id}"); ?>"><?= htmlspecialchars($author->fullName()); ?></a> <span><?= htmlspecialchars($reply->score()); ?> points</span> · <span><?= \Carbon\Carbon::createFromDate(htmlspecialchars($reply->created))->diffForHumans(); ?></span>
    <?php if (isset($user)) : ?>
        <?php if ($user->id == $author->id) : ?>
            <a href="<?= linkTo("reply/update/{$reply->id}"); ?>" class="ms-2 edit"><i class="fas fa-pen me-1"></i>Edit</a>
        <?php endif; ?>
    <?php endif; ?>
</div>