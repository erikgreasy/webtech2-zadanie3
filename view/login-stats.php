<?php include_once 'header.php' ?>

<main>
    <div class="container">
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
</main>

<?php include_once 'footer.php' ?>
