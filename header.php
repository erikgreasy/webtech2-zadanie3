<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 3 | Erik Masny</title>

    <!-- FONTS -->

    <link rel="stylesheet" href="<?= BASE_URL ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- STYLES -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= BASE_URL ?>">AUTH</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>">Domov</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>/login-stats">Štatistiky prihlásení</a>
            </li>
        
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if( logged_in() ): ?>
                    <li class="navbar-text">
                        <?= get_logged_user()->getFullName() ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" onclick="document.querySelector('#logout-form').submit()" href="#">Odhlásiť</a>
                        <form action="<?= BASE_URL ?>/logout" method="POST" class="d-none" id="logout-form">
                            
                        </form>
                    </li>
            <?php else: ?>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>/login" class="nav-link">Prihlásiť sa</a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>/register" class="nav-link">Registrovať sa</a>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</nav>    
