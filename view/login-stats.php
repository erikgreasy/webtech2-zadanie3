<?php include_once 'header.php' ?>

<main>
    <div class="container">
        <div>
            <h2 class="display-4 text-center mb-5">Moje prihlásenia</h2>
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
                            <?= date( 'd. M. Y, H:i:s',  strtotime( $login->getTime() ) ) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
        <div class="text-center mt-5 mb-3">
            <h2 class="display-4">Celkové štatistiky</h2>
            <script>
                loginsData = <?= json_encode($login_stats) ?>
            </script>
            <canvas id="loginsChart" width="300" height="300"></canvas>
            
        </div>
    </div>
</main>

<?php include_once 'footer.php' ?>
