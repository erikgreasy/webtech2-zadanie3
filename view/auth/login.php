<?php include 'header.php' ?>

<main id="login">
    <div class="container">
        <h1 class="display-3 text-center mb-3">Prihláste sa</h1>
        <div class="row">
            <div class="offset-md-3 col-md-6">
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
                        <label for="password">Heslo</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Prihlásiť</button>
                </form>
                <div class="mt-5">
                    <a href="<?= $google_url ?>" class="btn btn-secondary btn-block">Prihlásiť sa cez Google</a>
                    <a href="<?= BASE_URL ?>/ldap" class="btn btn-info btn-block">Prihlásiť sa cez LDAP STU</a>
                </div>
            </div>
        </div>

    </div>
</main>

<?php include 'footer.php' ?>
