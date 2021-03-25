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
                <a class="nav-link" href="<?= BASE_URL ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>/register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="document.querySelector('#logout-form').submit()" href="#">Logout</a>

                <form action="<?= BASE_URL ?>/logout" method="POST" class="d-none" id="logout-form">
                    
                </form>
            </li>
        
        </ul>
    </div>
</nav>    
