<div class="card">
    <div class="card-header">
        Tags
    </div>
    <div class="card-body">
        <?php if (!$tags) : ?>
        No tags yet...
        <?php else : ?>
            <?php foreach ($tags as $tag) : ?>
                <a href="<?= $di->get("request")->getBaseUrl() . "/tag/show/" . $tag->id; ?>"><?= $tag->name; ?></a>
                
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>