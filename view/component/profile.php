<div class="card mb-4">
    <div class="card-header">
        <p class="mb-0">Profile Overview</p> 
    </div>
    <div class="card-body">
        <?php $profile = Gufo\User\User::findById($di->get("request")->getRouteParts()[2]); ?>
        <div class="mb-4 d-flex align-items-start">
            <div>
                <img src="<?= $profile->get_gravatar(); ?>" alt="#" class="rounded-circle me-3" width="50">
            </div>
            <div class="d-flex flex-column">
                
                <?php $stats = $profile->stats(); ?>
                
                <div><a href="#"><?= htmlspecialchars($profile->firstname); ?> <?= htmlspecialchars($profile->lastname); ?></a></div>
                <p class="mb-0">Score: <?= $stats['score']; ?></p>
                <p class="mb-0">Posts: <?= $stats['posts']; ?></p>
                <p class="mb-1">Replies: <?= $stats['replies']; ?></p>
                <a href="<?= $di->get("request")->getBaseUrl() . "/user/update/" . htmlspecialchars($profile->id); ?>"><i class="fas fa-plus-square me-1"></i>Edit</a>
            </div>
            </div>
    </div>
</div>