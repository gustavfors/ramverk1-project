<div class="bottom-panel d-flex align-items-center">
    <button onclick="replyForm(<?= htmlspecialchars($reply->id); ?>)"><i class="fas fa-comment-alt me-1"></i>Reply</button>
    <button><a href="<?= $di->get("request")->getBaseUrl() . "/reply/show/" . $reply->id; ?>"><i class="fas fa-plus-square me-1"></i>Expand</a></button>
    <?php require ANAX_INSTALL_PATH . "/view/component/reply-vote.php"; ?>
    <button><i class="fas fa-check me-1"></i>Mark Best</button>
</div>

<?php if (preg_match("/post\/show\/[0-9]+/", $di->get("request")->getRoute()) || preg_match("/reply\/show\/[0-9]+/", $di->get("request")->getRoute())) : ?>
<form action="<?= $di->get("request")->getBaseUrl() . "/reply/create/" . $reply->id; ?>" method="POST" class="mt-4 d-none" id="<?= htmlspecialchars($reply->id); ?>"> 
    <textarea name="body" class="form-control border rounded-0 rounded-top" placeholder="What are your thoughts?" required rows="4"></textarea>
    <div
        class="bg-light border-bottom border-start border-end rounded-bottom p-2  d-flex justify-content-between align-items-center">
        <span>Markdown help</span>
        <button type="submit" class="btn btn-success py-1 px-2">Comment</button>
    </div>
</form>
<?php endif; ?>

<?php if (isset($count)) : ?>
<div class="mt-3">

    <?php if ($count < 4) : ?>
        <?php foreach ($reply->replies() as $reply) : ?>
            <?php $count++; ?>
            <?php require ANAX_INSTALL_PATH . "/view/component/reply.php"; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <?php if ($reply->replies()) : ?>
            <a class="continue-thread" href="<?= $di->get("request")->getBaseUrl() . "/reply/show/" . $reply->id; ?>">Continue Thread...</a>
            
        <?php endif; ?>
    <?php endif; ?>
    
</div>
<?php endif; ?>