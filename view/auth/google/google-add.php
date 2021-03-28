<?php include 'header.php' ?>

<main>
   <div class="container text-center">
      <p>Načítaj qr kód do aplikácie</p>
      <img src="<?= $qr_url ?>" class="mb-3" alt="google authentificator qr kod">
      <form action="<?= BASE_URL ?>/google-add" method="POST">
         <input type="hidden" name="google_secret" value="<?= $secret ?>">
         <input type="hidden" name="user_id" value="<?= $user_id ?>">

         <button type="submit" class="btn btn-danger">Pokračovať</button>
      </form>
   </div>
</main>



<?php include 'footer.php' ?>