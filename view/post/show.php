<?php

require component("post");

?>

<div class="card">
    <div class="card-header">
        Replies
    </div>
    <div class="card-body">
        <?php foreach ($post->replies() as $reply) : ?>
            <?php require component("reply"); ?>
        <?php endforeach; ?>
    </div>
</div>
