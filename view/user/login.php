<div class="card">

    <div class="card-header">
        Login
    </div>

    <div class="card-body">
        <form action="<?= $di->get("request")->getBaseUrl() . "/user/login"; ?>" method="POST">

            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">

            <label for="password">password</label>
            <input type="password" name="password" class="form-control">

            <button type="submit" class="btn btn-primary mt-3">login</button>

        </form>
    </div>

</div>


