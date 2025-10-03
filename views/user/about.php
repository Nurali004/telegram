<div class="container">
    <div class="row">
        <h2 style="text-align: center; margin-top: 15px">Profil Page</h2>
        <p><a href="/user/change" class="btn btn-success">O'zgartirish</a></p>
        <form action="/user/about" method="post">
            <?php if (isset($users)): ?>
            <p><input class="form-control" type="text" value="<?= $users->username ?>" placeholder="Username"></p>
            <p><input class="form-control" type="password" value="<?= $users->password ?>" placeholder="Password"></p>
            <p><input class="form-control" type="email" value="<?= $users->email ?>" placeholder="Email"></p>
            <p><input  class="form-control" type="text" value="<?= $users->phone ?>" placeholder="Phone number"></p>
            <p><input class="form-control" type="number" value="<?= $users->role ?>" placeholder="Role"></p>

            <p><img width="100" src="/<?= $users->image ?>" alt=""></p>



            <?php endif; ?>

        </form>
    </div>
</div>
