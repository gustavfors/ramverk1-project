<div class="card">

    <div class="card-header">
        Update Reply
    </div>

    <div class="card-body">
        <form method="POST">
            <label for="body">Body:</label>
            <textarea name="body" id="body" class="form-control" rows="8"><?= htmlspecialchars($reply->body); ?></textarea>
            <button type="submit" class="btn btn-primary mt-3">Update Reply</button>
        </form>
    </div>

</div>
