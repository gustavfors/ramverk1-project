<?php

namespace Anax\View;

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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#">Login</a>
                <a class="nav-link" href="#">Register</a>
            </div>
        </div>
    </div>
</nav>

<?php if (regionHasContent("main")) : ?>
<main class="container" role="main">
    <div class="row">
        <div class="col-8">
            <?php require component("errors"); ?>
            <?php renderRegion("main") ?>
        </div>
        <div class="col-4">
            <!-- sidebar content -->
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

</body>
</html>
