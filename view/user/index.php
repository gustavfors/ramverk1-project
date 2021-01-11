<?php $rank = 1; ?>

<?php foreach ($users as $user) : ?>
    <div class="card mb-4">
        <div class="card-header">
            User Rank: <?= $rank; ?>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <img src="<?= htmlspecialchars($user->getGravatar()); ?>" alt="#" class="rounded-circle me-3" width="50">
                </div>
                <div class="d-flex flex-column">
                    <a href="<?= $di->get("request")->getBaseUrl() . "/user/show/" . $user->id; ?>"><?= htmlspecialchars($user->fullName()); ?></a>
                    Score: <?= $user->score; ?>
                </div>
            </div>
        </div>
    </div>
    <?php $rank++; ?>
<?php endforeach; ?>