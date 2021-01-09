<form action="<?= linkTo("user/create"); ?>" method="POST">

    <label for="firstname">First name</label>
    <input type="text" name="user[firstname]">

    <label for="lastname">Last name</label>
    <input type="text" name="user[lastname]">

    <label for="email">Email</label>
    <input type="email" name="user[email]">

    <label for="password">Password</label>
    <input type="password" name="password">

    <button type="submit">Create User</button>

</form>