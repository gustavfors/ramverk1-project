<form method="POST">
    <label for="title">Title</label>
    <input type="text" name="post[title]" id="title" value="<?= htmlspecialchars($post->title); ?>">
    <label for="body">body</label>
    <input type="text" name="post[body]" id="body" value="<?= htmlspecialchars($post->body); ?>">
    <button type="submit">Post</button>
</form>