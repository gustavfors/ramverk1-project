<form action="<?= linkTo("post/create"); ?>" method="POST">
    <label for="title">Title</label>
    <input type="text" name="post[title]" id="title">
    <label for="tags">tags</label>
    <input type="text" name="tags" id="tags">
    <label for="body">body</label>
    <input type="text" name="post[body]" id="body">
    <button type="submit">Post</button>
</form>
