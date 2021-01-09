<div class="card">
    <div class="card-header">
        Register
    </div>
    <div class="card-body">
        <form action="<?= linkTo("user/create"); ?>" method="POST">
            <label for="firstname">First name</label>
            <input type="text" name="user[firstname]" class="form-control">

            <label for="lastname">Last name</label>
            <input type="text" name="user[lastname]" class="form-control">

            <label for="email">Email</label>
            <input type="email" name="user[email]" class="form-control">

            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">

            <button type="submit" class="btn btn-primary mt-3">Register User</button>
        </form>
    </div>
</div>