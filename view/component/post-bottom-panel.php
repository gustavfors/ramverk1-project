<div class="bottom-panel d-flex align-items-center">
    <div><i class="fas fa-comment-alt me-1"></i><?= $post->repliesCount(); ?> Replies</div>
    <?php require ANAX_INSTALL_PATH . "/view/component/post-vote.php"; ?>
        <div><i class="fas fa-tags me-1 ms-2"></i>Tags: 
        <?php foreach ($post->tags() as $tag) : ?>
            <a href="<?= $di->get("request")->getBaseUrl() . "/tag/show/" . $tag['id']; ?>" class="ms-1"><?= htmlspecialchars($tag['name']); ?></a>
        <?php endforeach; ?>
    </div>
</div>

<?php if (preg_match("/post\/show\/[0-9]+/", $di->get("request")->getRoute())) : ?>
<form action="<?= $di->get("request")->getBaseUrl() . "/reply/create/" . $post->id; ?>" method="POST" class="mt-4">
    <textarea name="body" class="form-control border rounded-0 rounded-top" placeholder="What are your thoughts?" required rows="4"></textarea>
    <div
        class="bg-light border-bottom border-start border-end rounded-bottom p-2  d-flex justify-content-between align-items-center">
        <span>Markdown help</span>
        <button type="submit" class="btn btn-success py-1 px-2">Comment</button>
    </div>
</form>
<?php endif; ?>