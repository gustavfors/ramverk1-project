<?php
if (isset($user)) {
    $vote = $user->hasVoted($reply->id);
}
?>

<?php if (isset($vote) && $vote) : ?>
<form action="<?= linkTo("vote/up/{$reply->id}"); ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-up <?= $vote->score == 1 ? "text-success" : ""; ?>"></i></button>
</form>

<form action="<?= linkTo("vote/down/{$reply->id}"); ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-down <?= $vote->score == -1 ? "text-danger" : ""; ?>"></i></button>
</form>
<?php else : ?>
<form action="<?= linkTo("vote/up/{$post->id}"); ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-up"></i></button>
</form>

<form action="<?= linkTo("vote/down/{$post->id}"); ?>" method="POST">
    <button type="submit"><i class="fas fa-arrow-down"></i></button>
</form>
<?php endif; ?>