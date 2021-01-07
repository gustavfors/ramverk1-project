<?php if ($di->get("session")->has("errors")) : ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach($di->get("session")->get("errors") as $error) : ?>
            <?= $error; ?>
        <?php endforeach; ?>
    </div>
    <?php $di->get("session")->delete("errors"); ?>
<?php endif; ?>


