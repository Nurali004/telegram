<div class="container mt-5">
    <div class="row">

            <div class="card p-3 mb-3">
                <h2><?= $models->title; ?></h2>
                <p class="text-secondary">👨🏼‍💻: <?= $models->username; ?> 📋: <?= $models->name ?> 🕰️: <?= $models->created_at ?></p>
                <p><?= $models->full_text; ?></p>

            </div>
        <div class="card mt-5 p-4">
            <h4>Kommentarialar</h4>
            <p>
                <h5>Jahongir</h5>
                 <p>Juda ham ajoyib text</p>
            </p>
            <p>
            <h5>Doniyorjon</h5>
            <p>O'rtacha text</p>
            </p>

            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="mb-3 pb-3 border-bottom">
                        <h5><?= ($comment->username) ?></h5>
                        <p><?= ($comment->message) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="col-md-6">

                <form method="post" action="/news/add">

                    <p><input type="text" name="user_id" class="form-control" placeholder="User_id"></p>
                    <p><textarea name="message" id="" cols="30" rows="10" class="form-control" ></textarea></p>
                    <p><input type="submit" name="submit" value="Yuborish" class="btn btn-success"></p>
                </form>
            </div>
        </div>

    </div>
</div>

