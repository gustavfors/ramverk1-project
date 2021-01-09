<form action="<?= linkTo("user/login"); ?>" method="POST">

    <label for="email">Email</label>
    <input type="email" name="email">

    <label for="password">password</label>
    <input type="password" name="password">

    <button type="submit">login</button>

</form>