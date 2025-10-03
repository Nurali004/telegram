<div class="container mt-5 ">
    <div class="row">
        <h2>Update user</h2>
    </div>
    <div class="row">

        <form action="" method="post" enctype="multipart/form-data">
            <?php if (isset($results)): ?>
            <p><input type="text" name="username" placeholder="username" class="form-control" value="<?= $results->username; ?>" ></p>
            <p><input type="password" name="password" placeholder="password" class="form-control" value="<?= $results->password; ?>" ></p>
            <p><input type="email" name="email" placeholder="email" class="form-control" value="<?= $results->email; ?>" ></p>
            <p><input type="text" name="phone" placeholder="phone" class="form-control" value="<?= $results->phone; ?>"></p>
            <p><input type="number" name="role" placeholder="role" class="form-control" value="<?= $results->role; ?>"></p>
            <p><input type="file" name="image_file" value="<?= $results->image ?>" placeholder="Rasim" class="form-control" ></p>
            <p><input type="submit" name="submit" value="save" class="btn btn-success"  ></p>
            <?php endif; ?>
        </form>

    </div>
</div>
