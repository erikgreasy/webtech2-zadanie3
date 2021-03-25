<?php include 'header.php' ?>

<main id="register">
    <div class="container">
        <form method="POST" action="<?= BASE_URL ?>/register">
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
                <label for="name">Meno</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= isset( $_POST['name'] ) ? $_POST['name'] : ''  ?>">
            </div>

            <div class="form-group">
                <label for="surname">Priezvisko</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?= isset( $_POST['surname'] ) ? $_POST['surname'] : ''  ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= isset( $_POST['email'] ) ? $_POST['email'] : ''  ?>">
            </div>

            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" id="login" name="login" value="<?= isset( $_POST['login'] ) ? $_POST['login'] : ''  ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Zopakujte heslo</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>

            <button type="submit" class="btn btn-primary">Registrovať</button>
        </form>
    </div>
</main>

<?php include 'footer.php' ?>
