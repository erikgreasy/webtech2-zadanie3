<?php include 'header.php' ?>

<main>
    <div class="container text-center">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form action="<?= BASE_URL ?>/google-check" method="POST">
                    <div class="form-group">
                        <label for="google_code">Zadaj heslo z aplikácie:</label>
                        <input type="text" name="google_code" class="form-control" autofocus/>
                    </div>

                    <input type="hidden" name="user_id" value="<?= $user_id ?>" />

                    <button type="submit" class="btn btn-primary btn-block">Overiť</button>
                </form>
                <a href="<?= BASE_URL ?>/google-add">Znovu načítať QR kód</a>
            </div>
        </div>
    </div>
    
</main>

<?php include 'footer.php' ?>