<?php include 'header.php' ?>

<main id="login">
    <div class="container">
        <form method="POST" action="<?= BASE_URL ?>/login">
            <?php if( isset($errors) && !empty($errors) ): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach( $errors as $error ): ?>
                            <li>
                                <?= $error ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" value="<?= isset( $_POST['login'] ) ? $_POST['login'] : ''  ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <button type="submit" class="btn btn-primary">Prihlásiť</button>
        </form>
    </div>
</main>

<?php include 'footer.php' ?>
