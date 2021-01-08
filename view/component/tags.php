<div class="card">
    <div class="card-header">
        <p class="mb-0">Popular Tags</p>
    </div>
    <div class="card-body">
        <?php foreach(Gufo\Tag\Tag::popular() as $tag) : ?>
            <a href="<?= linkTo("tag/show/{$tag['id']}"); ?>"><?= $tag['name']; ?></a>
        <?php endforeach; ?>
    </div>
</div>