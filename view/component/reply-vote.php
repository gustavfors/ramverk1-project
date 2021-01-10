<?php
if (isset($user)) {
    $vote = $user->hasVoted($reply->id);
}
?>

<?php if (isset($vote) && $vote) : ?>
<form action="<?= $di->get("request")->getBaseUrl() . "/vote/up/" . $reply->id; ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-up <?= $vote->score == 1 ? "text-success" : ""; ?>"></i></button>
</form>

<form action="<?= $di->get("request")->getBaseUrl() . "/vote/up/" . $reply->id; ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-down <?= $vote->score == -1 ? "text-danger" : ""; ?>"></i></button>
</form>
<?php else : ?>
<form action="<?= $di->get("request")->getBaseUrl() . "/vote/up/" . $reply->id; ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-up"></i></button>
</form>

<form action="<?= $di->get("request")->getBaseUrl() . "/vote/down/" . $reply->id; ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-down"></i></button>
</form>
<?php endif; ?>