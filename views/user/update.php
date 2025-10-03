<div class="container mt-5 ">
    <div class="row">
        <h2>Update user</h2>
    </div>
    <div class="row">
        <form action="" method="post" enctype="multipart/form-data">
            <p><input type="text" name="username" placeholder="username" class="form-control" value="<?= $user->username; ?>" ></p>
            <p><input type="password" name="password" placeholder="password" class="form-control"value="<?= $user->password; ?>" ></p>
            <p><input type="mail" name="email" placeholder="email" class="form-control"value="<?= $user->email; ?>" ></p>
            <p><input type="phone" name="phone" placeholder="phone" class="form-control" value="<?= $user->phone; ?>"></p>
            <p><input type="number" name="role" placeholder="role" class="form-control" value="<?= $user->role; ?>"></p>
            <p><input type="file" name="image_file" placeholder="Rasim" class="form-control" ></p>
            <p><input type="submit" name="submit" value="save" class="btn btn-success"  ></p>
        </form>
    </div>
</div>