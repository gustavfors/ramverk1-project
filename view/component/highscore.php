<div class="card mb-4">
    <div class="card-header">
        <p class="mb-0">User Highscore</p>
    </div>
    <div class="card-body">
        <?php foreach(Gufo\User\User::highscore() as $user) : ?>
        <div class="mb-4 d-flex align-items-center">
            <div><img src="<?= htmlspecialchars($user->get_gravatar()); ?>" alt="#" class="rounded-circle me-3"
                    width="50"></div>
            <div class="d-flex flex-column"><a href="<?= linkTo("user/show/{$user->id}"); ?>"><?= $user->firstname; ?>
                    <?= $user->lastname; ?></a>Score: <?= $user->score; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>