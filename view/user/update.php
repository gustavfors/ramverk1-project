<form method="POST">

    <label for="firstname">First name</label>
    <input type="text" name="user[firstname]" value="<?= $user->firstname; ?>">

    <label for="lastname">Last name</label>
    <input type="text" name="user[lastname]" value="<?= $user->lastname; ?>">

    <label for="email">Email</label>
    <input type="email" name="user[email]" value="<?= $user->email; ?>">

    <label for="password">Password</label>
    <input type="password" name="password">

    <button type="submit">Create User</button>

</form>