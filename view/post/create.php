<div class="card">

    <div class="card-header">
        Create new thread
    </div>

    <div class="card-body">
        <form action="<?= $di->get("request")->getBaseUrl() . "/post/create"; ?>" method="POST">
            <label for="title">Title:</label>
            <input type="text" name="post[title]" id="title" class="form-control">
            <label for="tags">Tags: (example: #php #anax #dbwebb)</label>
            <input type="text" name="tags" id="tags" class="form-control">
            <label for="body">Body:</label>
            <textarea name="post[body]" id="body" class="form-control" rows="8"></textarea>
            <button type="submit" class="btn btn-primary mt-3">Submit Thread</button>
        </form>
    </div>

</div>



