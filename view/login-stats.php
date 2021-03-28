<?php include_once 'header.php' ?>

<main>
    <div class="container">
        <div>
            <h2>Moje prihlásenia</h2>
            <table class="table">
                    
                <tr>
                    <th>Typ prihlásenia</th>
                    <th>Dátum</th>
                </tr>
                <?php foreach( $user_logins as $login ): ?>
                    <tr>
                        <td>
                            <?php print_r($login->getType()) ?>
                        </td>
                        <td>
                            <?php print_r($login->getTime()) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
        <div>
            <h2>Štatistiky</h2>
            <table class="table">
                <tr>
                    <th>Typ prihlásenia</th>
                    <th>Počet prihlásení</th>
                </tr>

                <?php foreach( $login_stats as $login ): ?>

                    <tr>
                        <td><?= $login->type ?></td>
                        <td><?= $login->count ?></td>

                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</main>

<?php include_once 'footer.php' ?>
