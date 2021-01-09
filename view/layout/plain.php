<?php

namespace Anax\View;

use Gufo\User\User;
use Gufo\Tag\Tag;

if ($di->get("session")->has("user")) {
    $user = User::findById($di->get("session")->get("user"));
}

/**
 * A very small layout only rendering the content in a main
 * element.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$lang = $lang ?? "sv";
$charset = $charset ?? "utf-8";
$title = ($title ?? "No title");

?><!doctype html>
<html lang="<?= $lang ?>">
<head>

    <meta charset="<?= $charset ?>">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (isset($favicon)) : ?>
    <link rel="icon" href="<?= asset($favicon) ?>">
    <?php endif; ?>

    <?php if (isset($stylesheets)) : ?>
        <?php foreach ($stylesheets as $stylesheet) : ?>
            <link rel="stylesheet" type="text/css" media="all" href="<?= asset($stylesheet) ?>">
        <?php endforeach; ?>
    <?php endif; ?>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light border">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto d-flex align-items-center">
                <a class="nav-link" href="<?= linkTo(""); ?>">Home</a>
                <a class="nav-link" href="<?= linkTo("about"); ?>">About</a>
                <a class="nav-link" href="<?= linkTo("tag"); ?>">Tags</a>
                <?php if (!isset($user)) : ?>
                    <a class="nav-link" href="<?= linkTo("user/login"); ?>">Login</a>
                    <a class="nav-link" href="<?= linkTo("user/create"); ?>">Register</a>
                <?php else : ?>
                    <a class="nav-link" href="<?= linkTo("user/show/{$user->id}"); ?>">Profile</a>
                    <a class="nav-link" href="<?= linkTo("user/logout"); ?>">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<?php if (regionHasContent("main")) : ?>
<main class="container py-5" role="main">
    <div class="row">
        <div class="col-8">
            <?php renderRegion("main") ?>
        </div>
        <div class="col-4">

            <?php if (preg_match("/user\/show\/[0-9]+/", $di->get("request")->getRoute())) : ?>
                    <div class="card">
                        <div class="card-header">
                            <p class="mb-0">Profile Overview</p> 
                        </div>
                        <div class="card-body">
                            <?php $profile = User::findById($di->get("request")->getRouteParts()[2]); ?>
                            <div class="d-flex align-items-start">
                                <div>
                                    <img src="<?= $profile->getGravatar(); ?>" alt="#" class="rounded-circle me-3" width="50">
                                </div>
                                <div class="d-flex flex-column">
                                    
                                    <?php $stats = $profile->stats(); ?>
                                    
                                    <div><a href="#"><?= htmlspecialchars($profile->firstname); ?> <?= htmlspecialchars($profile->lastname); ?></a></div>
                                    <p class="mb-0">Score: <?= $stats['score']; ?></p>
                                    <p class="mb-0">Posts: <?= $stats['posts']; ?></p>
                                    <p class="mb-1">Replies: <?= $stats['replies']; ?></p>
                                    <?php if (isset($user)) : ?>
                                        <?php if ($user->id == $profile->id) : ?>
                                            <a href="<?= $di->get("request")->getBaseUrl() . "/user/update/" . htmlspecialchars($profile->id); ?>"><i class="fas fa-plus-square me-1"></i>Edit</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                             </div>
                        </div>
                    </div>
            <?php else : ?>
                <a href="<?= linkTo("post/create"); ?>" class="btn btn-primary w-100">Create New Thread</a>
            <?php endif; ?>

            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <p class="mb-0">User Highscore</p>
                </div>
                <div class="card-body">
                    <?php foreach (User::highscore() as $user) : ?>
                        <div class="mb-4 d-flex align-items-center">
                            <div>
                                <img src="<?= htmlspecialchars($user->getGravatar()); ?>" alt="#" class="rounded-circle me-3" width="50">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="<?= linkTo("user/show/{$user->id}"); ?>"><?= $user->fullName(); ?></a>
                                Score: <?= $user->score; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <p class="mb-0">Popular Tags</p>
                </div>
                <div class="card-body">
                    <?php foreach (Tag::popular() as $tag) : ?>
                        <a href="<?= $di->get("request")->getBaseUrl() . "/tag/show/" . $tag['id']; ?>" style="font-size: 14px;"><?= $tag['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</main>
<?php endif; ?>



<!-- render javascripts -->
<?php if (isset($javascripts)) : ?>
    <?php foreach ($javascripts as $javascript) : ?>
    <script async src="<?= asset($javascript) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>



<!-- useful for inline javascripts such as google analytics-->
<?php if (regionHasContent("body-end")) : ?>
    <?php renderRegion("body-end") ?>
<?php endif; ?>

<script>

    function replyForm(id) {
        document.getElementById(id).classList.remove("d-none");
    }

</script>

</body>
</html>
