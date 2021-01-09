<div class="top-panel">
    <a href="<?= linkTo("user/show/{$author->id}"); ?>"><?= htmlspecialchars($author->fullName()); ?></a> <span><?= htmlspecialchars($post->score()); ?> points</span> · <span><?= \Carbon\Carbon::createFromDate(htmlspecialchars($post->created))->diffForHumans(); ?></span>
    <?php if (isset($user)) : ?>
        <?php if ($user->id == $author->id) : ?>
            <a href="<?= linkTo("post/update/{$post->id}"); ?>" class="ms-2 edit"><i class="fas fa-pen me-1"></i>Edit</a>
        <?php endif; ?>
    <?php endif; ?>
</div>

